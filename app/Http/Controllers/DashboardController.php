<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserFiles;
use App\Models\PengumumanPdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PdfController;
use App\Helpers\Bantuan;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class DashboardController extends Controller
{
    private function getGreeting()
    {
        date_default_timezone_set('Asia/Jakarta');
        $hour = date('H');

        if ($hour >= 5 && $hour < 12) {
            return "Selamat Pagi";
        } elseif ($hour >= 12 && $hour < 15) {
            return "Selamat Siang";
        } elseif ($hour >= 15 && $hour < 18) {
            return "Selamat Sore";
        } else {
            return "Selamat Malam";
        }
    }

    public function adminDashboard()
    {
        $greeting = $this->getGreeting();
        return view('dashboard.admin', compact('greeting'));
    }

    public function verifikatorDashboard()
    {
        $greeting = $this->getGreeting();
        return view('dashboard.verifikator', compact('greeting'));
    }

    public function userDashboard()
    {
        $greeting = $this->getGreeting();
        return view('dashboard.user', compact('greeting'));
    }

    public function updatedata()
    {
    $greeting = $this->getGreeting();
    $user = auth()->user();
    $profile = $user->profile;

    if ($profile) {
        session()->flash('status_updated', 'Anda sudah pernah mengisi data. Silakan perbarui jika ada perubahan.');
    }

    return view('user.datadiri', compact('greeting', 'user', 'profile'));
    }

    public function updateberkas()
    {
    $greeting = $this->getGreeting();
    $userFiles = UserFiles::where('user_id', Auth::id())->first();
   
    return view('user.berkas2', compact('userFiles', 'greeting'));
    }

    public function pengguna()
    {
    $greeting = $this->getGreeting();
    $data = User::get();  
    return view('admin.pengguna', compact('data', 'greeting'));
    }

    public function upl_pengumuman()
    {
        $pengumumanPdfs = PengumumanPdf::all();
        $greeting = $this->getGreeting();

        return view('admin.pengumuman', compact('pengumumanPdfs', 'greeting'));
    }

    public function create()
    {
        echo "ini halaman create";
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:users,username',
                'nik' => 'required|numeric|min:16|unique:users,nik',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required|in:administrator,verifikator,user'
            ]);

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'nik' => $request->nik,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            return redirect()->route('pengguna')->with('success', 'User berhasil ditambahkan');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'nik' => 'required|numeric|digits:16|unique:users,nik,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->nama,
            'username' => $request->username,
            'nik' => $request->nik,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('pengguna')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);
        $pengguna->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }

    public function storeUserProfile(Request $request)
{
    $request->validate([
        'gelar_depan' => 'nullable|string|max:50',
        'gelar_belakang' => 'nullable|string|max:50',
        'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        'alamat' => 'nullable|string',
        'no_handphone' => 'nullable|numeric|digits_between:10,15',
        'pas_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'kalangan' => 'required|in:Akademisi,Industri,Teknologi,Lingkungan Hidup,Konsumen',
        'ktp' => 'nullable|file|mimes:pdf|max:2048'
    ]);

    $data = $request->except(['_token', 'pas_foto', 'ktp']);
    $user = auth()->user();

    // Handle Upload Pas Foto
    if ($request->hasFile('pas_foto')) {
        $file = $request->file('pas_foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/pas_foto'), $filename);
        $data['pas_foto'] = $filename;
    }

    $data['user_id'] = $user->id;

    // Simpan ke tabel user_profiles
    $profile = UserProfile::where('user_id', $user->id)->first();
    if ($profile) {
        $profile->update($data);
        $message = 'Data berhasil diperbarui!';
    } else {
        UserProfile::create($data);
        $message = 'Data berhasil disimpan!';
    }

    // Handle Upload KTP (PDF ke user_files)
    if ($request->hasFile('file_ktp')) {
        $ktp = $request->file('file_ktp');
        $ktpName = 'ktp_' . time() . '.' . $ktp->getClientOriginalExtension();
        $path = $ktp->storeAs('uploads/user_files', $ktpName, 'public');
    
        // Cek apakah sudah ada data user_files untuk user ini
        $userFile = \App\Models\UserFiles::where('user_id', $user->id)->first();
    
        if ($userFile) {
            $userFile->update(['ktp' => $path]);
        } else {
            \App\Models\UserFiles::create([
                'user_id' => $user->id,
                'ktp' => $path
            ]);
        }
    }
    

    return redirect()->back()->with('success', $message);
}


public function daftarpelamar__()
{
    $greeting = $this->getGreeting();
    $data = User::where('role', 'user')
            ->with(['userProfile', 'userFiles']) // Pastikan relasi di-load
            ->get();
    
    return view('admin.daftarpelamar', compact('data', 'greeting'));
}

public function daftarpelamar()
{
    $greeting = $this->getGreeting();
    $data = User::where('role', 'user')
            ->with(['userProfile', 'userFiles']) // Pastikan relasi di-load
            ->get();
    $pelamar = DB::table('users as us')
               ->join('user_profiles as pr', 'us.id', '=', 'pr.user_id');
    
    return view('admin.daftarpelamar', compact('data', 'pelamar', 'greeting'));
}

public function pelamardetail(Request $req){
    $user_id = $req->get('userid');

    $files_check = DB::table('user_files')->where('user_id', $user_id)->count();

    if ($files_check == 0){
        $pelamar = DB::table('users as us')
                   ->join('user_profiles as pr', 'us.id', '=', 'pr.user_id')
                   ->where('us.id', $user_id)->first();
    }else{
        $pelamar = DB::table('users as us')
                   ->join('user_profiles as pr', 'us.id', '=', 'pr.user_id')
                   ->join('user_files as fi', 'us.id', '=', 'fi.user_id')
                   ->where('us.id', $user_id)->first();
    }

    return view('admin.pelamardetail', compact('files_check', 'pelamar'));
}

public function pelamardetail_pdf(Request $req){
    $user_id = $req->get('userid');

    $files_check = DB::table('user_files')->where('user_id', $user_id)->count();

    if ($files_check == 0){
        $pelamar = DB::table('users as us')
                   ->join('user_profiles as pr', 'us.id', '=', 'pr.user_id')
                   ->where('us.id', $user_id)->first();
    }else{
        $pelamar = DB::table('users as us')
                   ->join('user_profiles as pr', 'us.id', '=', 'pr.user_id')
                   ->join('user_files as fi', 'us.id', '=', 'fi.user_id')
                   ->where('us.id', $user_id)->first();
    }

    // return view('admin.pelamardetail_pdf', compact('files_check', 'pelamar'));

    $pdf = PDF::loadView('admin.pelamardetail_pdf', compact('files_check', 'pelamar'))->setPaper('a4', 'portrait');
    return $pdf->stream('detailpelamar.pdf');
}

public function password()
{
    $greeting = $this->getGreeting();
    return view('admin.password', compact('greeting'));
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Password saat ini salah.');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password berhasil diperbarui.');
}

public function download($type)
{
    $fileMap = [
        'pengusul' => public_path('templates/template_pengusul.docx'),
        'pakar'    => public_path('templates/template_rekomendasi_pakar.docx'),
    ];

    if (!array_key_exists($type, $fileMap) || !file_exists($fileMap[$type])) {
        abort(404, 'File tidak ditemukan.');
    }

    $filename = 'Template_' . ucfirst($type) . '.docx';
    return response()->download($fileMap[$type], $filename);
}


}
