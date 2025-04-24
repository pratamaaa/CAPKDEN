<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserFiles;
use App\Models\UserExperience;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserFilesController extends Controller
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

    public function store(Request $request)
{
    $tab = $request->input('tab'); 

    $rules = [];
    $userFiles = UserFiles::where('user_id', Auth::id())->first();
    
    switch ($tab) {
    

        case 'pendidikan':
            $rules = [
                'universitas_sarjana' => 'required|string|max:255',
                'jurusan_sarjana' => 'required|string|max:255',
                'lulus_sarjana' => 'required|string|max:255',
                'ijazah_sarjana' => (($userFiles != null && $userFiles->ijazah_sarjana == null)?'required':'nullable').'|file|mimes:pdf|max:2048',
                'transkrip_sarjana' => (($userFiles != null && $userFiles->transkrip_sarjana == null)?'required':'nullable').'|file|mimes:pdf|max:2048',

                'universitas_magister' => 'nullable|string|max:255',
                'jurusan_magister' => 'nullable|string|max:255',
                'lulus_magister' => 'nullable|string|max:255',
                'ijazah_magister' => 'nullable|file|mimes:pdf|max:2048',
                'transkrip_magister' => 'nullable|file|mimes:pdf|max:2048',

                'universitas_doktoral' => 'nullable|string|max:255',
                'jurusan_doktoral' => 'nullable|string|max:255',
                'lulus_doktoral' => 'nullable|string|max:255',
                'ijazah_doktoral' => 'nullable|file|mimes:pdf|max:2048',
                'transkrip_doktoral' => 'nullable|file|mimes:pdf|max:2048',
            ];
            break;

            case 'pengalaman':
                $rules = [
                    'nama_jabatan' => 'required|string|max:255',
                    'unit_kerja' => 'required|string|max:255',
                    'tmt_jabatan' => 'required|date',
                    'uraian_jabatan' => 'required|string',
                ];
            
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput()->with('tab', $tab);
                }
            
                if ($request->tab === 'pengalaman') {
                    foreach ($request->nama_jabatan as $i => $jabatan) {
                        UserExperience::create([
                            'user_id'        => auth()->id(),
                            'nama_jabatan'   => $jabatan,
                            'unit_kerja'     => $request->unit_kerja[$i],
                            'tmt_jabatan'    => $request->tmt_jabatan[$i],
                            'uraian_jabatan' => $request->uraian_jabatan[$i],
                        ]);
                    }
                }
                
                return redirect()->route('statusberkas')->with([
                    'success' => "Data pengalaman berhasil disimpan.",
                    'active_tab' => $tab
                ]);
            
            break;
            
        case 'pengusul':
            $rules = [
                'org_pengusul' => 'nullable|string|max:255',
                'upl_org' => 'nullable|file|mimes:pdf|max:2048',
                'rek_pakar1' => 'nullable|string|max:255',
                'upl_rek_pakar1' => 'nullable|file|mimes:pdf|max:2048',
                'rek_pakar2' => 'nullable|string|max:255',
                'upl_rek_pakar2' => 'nullable|file|mimes:pdf|max:2048',
                'rek_pakar3' => 'nullable|string|max:255',
                'upl_rek_pakar3' => 'nullable|file|mimes:pdf|max:2048',
            ];
            break;

        case 'pendukung':
            $rules = [
                'lamaran' => 'nullable|file|mimes:pdf|max:2048',
                'cv' => 'nullable|file|mimes:pdf|max:2048',
                'rangkap_jabatan' => 'nullable|file|mimes:pdf|max:2048',
                'pidana' => 'nullable|file|mimes:pdf|max:2048',
                'surat_sehat' => 'nullable|file|mimes:pdf|max:2048',
                'skck' => 'nullable|file|mimes:pdf|max:2048',
                'persetujuan' => 'nullable|file|mimes:pdf|max:2048',
            ];
            break;

        default:
            return back()->with('error', 'Tab tidak dikenal.');
    }
    
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput()
            ->with('tab', $tab);
    }

    $uploadedFiles = [];
    foreach ($request->allFiles() as $field => $file) {
        if ($file->isValid()) {
            $uploadedFiles[$field] = $file->store('uploads/user_files', 'public');
        } else {
            return back()->with('error', "File $field tidak valid.");
        }
    }

    $inputText = $request->except(array_merge(['_token', 'tab'], array_keys($uploadedFiles)));
    $data = array_merge($uploadedFiles, $inputText);

    UserFiles::updateOrCreate(
        ['user_id' => auth()->id()],
        $data
    );

    return redirect()->route('statusberkas')->with([
        'success' => "Data pada tab '$tab' berhasil disimpan.",
        'active_tab' => $tab
    ]);
    
}

    public function index()
{
    $greeting = $this->getGreeting();
    $userFiles = UserFiles::where('user_id', Auth::id())->first();
    return view('user.berkas', compact('userFiles', 'greeting'));
}

public function status()
{
    $greeting = $this->getGreeting();
    $userFiles = UserFiles::where('user_id', auth()->id())->first();

if (!$userFiles) {
    return redirect()->route('updateberkas')->with('warning', 'Silakan lengkapi data terlebih dahulu.');
}


    
    $success = session('success');
    return view('user.statusberkas', compact('userFiles', 'greeting', 'success'));
}
public function updatestatus(Request $request, $field)
{
    $userFiles = UserFiles::where('user_id', Auth::id())->first();
    $userFiles->status_data = 1;
    $userFiles->save();
    return redirect()->route('statusberkas')->with('success', 'Status Berkas berhasil diperbarui.');

}
public function update(Request $request, $field)
{
    $request->validate([
        'dokumen' => 'required|file|mimes:pdf|max:1024',
    ]);

    $userFiles = UserFiles::where('user_id', Auth::id())->firstOrFail();

    // Hapus file lama jika ada
    if (!empty($userFiles->$field)) {
        Storage::disk('public')->delete($userFiles->$field);
    }

    // Simpan file baru
    $path = $request->file('dokumen')->store('uploads/user_files', 'public');
    $userFiles->$field = $path;
    $userFiles->save();

    return redirect()->route('statusberkas')->with('success', 'Dokumen berhasil diperbarui.');
}

public function destroy($field)
{
    $userFiles = UserFiles::where('user_id', Auth::id())->firstOrFail();

    if ($userFiles->$field && Storage::disk('public')->exists($userFiles->$field)) {
        Storage::disk('public')->delete($userFiles->$field);
        $userFiles->$field = null;
        $userFiles->save();
    }

    return redirect()->route('statusberkas')->with('success', 'Dokumen berhasil dihapus.');
}

public function uploadMakalah()
{
    $greeting = $this->getGreeting();
    $userFiles = UserFiles::where('user_id', auth()->id())->first();

    if ($userFiles->administrasi_status !== 'lulus') {
        return redirect()->route('dashboard.user')->with('error', 'Anda belum lulus tahap administrasi.');
    }

    return view('user.makalah', compact('userFiles','greeting'));
}
public function storeMakalah(Request $request)
{
    $request->validate([
        'judul_makalah' => 'required|string|max:255',
        'makalah' => 'required|mimes:pdf|max:10048',
    ]);

    $userfiles = UserFiles::where('user_id', auth()->id())->sole();

    // Simpan file makalah
    $path = $request->file('makalah')->store('uploads/makalah', 'public');

    // Simpan path dan judul ke DB
    $userfiles->update([
        'makalah' => $path,
        'judul_makalah' => $request->input('judul_makalah'),
    ]);

    return redirect()->back()->with('success', 'Makalah berhasil diupload.');
}


public function deleteMakalah($id)
{
    $makalah = UserFiles::where('id', $id)
        ->where('user_id', auth()->id())
        ->whereNotNull('judul_makalah')
        ->firstOrFail();

    // Hapus file dari storage kalau ada
    if ($makalah->makalah && \Storage::disk('public')->exists($makalah->makalah)) {
        \Storage::disk('public')->delete($makalah->makalah);
    }

    $makalah->delete();

    return redirect()->back()->with('success', 'Makalah berhasil dihapus.');
}


}


