<?php

namespace App\Http\Controllers;

use App\Helpers\Bantuan;
use App\Models\User;
use App\Models\UserFiles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class VerifikasiController extends Controller
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

    public function index()
    {
        $greeting = $this->getGreeting();
        $dokumenList = UserFiles::with('userProfile.user')->get();
        $data = User::where('role', 'user')
                    ->whereHas('userFiles', function ($query) {
                        $query->where('status_data', '1');
                    })
                    ->with(['userProfile', 'userFiles', 'userExperiences'])
                    ->orderBy('name')
                    ->get();

        return view('admin.verifikasi', compact('data','dokumenList', 'greeting'));
    }
    public function detailPelamar()
    {
        $greeting = $this->getGreeting();
        $dokumenList = UserFiles::with('userProfile.user')->get();
        $data = User::where('role', 'user')
                    ->whereHas('userFiles', function ($query) {
                        $query->where('status_data', '1');
                    })
                    ->with(['userProfile', 'userFiles', 'userExperiences'])
                    ->orderBy('name')
                    ->get();

        return view('admin.detail-pelamar', compact('data','dokumenList', 'greeting'));
    }

    public function sudahverifikasi()
    {
        $greeting = $this->getGreeting();
        $dokumenList = UserFiles::with('userProfile.user')->get();
        $data = User::where('role', 'user')
                ->whereHas('userFiles', function ($query) {
                    $query->whereIn('administrasi_status', ['memenuhi syarat', 'tidak memenuhi syarat']);
                })

                ->with(['userProfile', 'userFiles'])
                ->get();
        return view('admin.sudahverifikasi', compact('data','dokumenList', 'greeting'));
    }

    public function belumVerifikasi()
{
    $greeting = $this->getGreeting();

    $dokumenList = UserFiles::with('userProfile.user')->get();

    // Hitung jumlah file yang masih menunggu verifikasi
    $belumVerifikasi = DB::table('user_files')
    ->where('status_data', 1)
    ->where('administrasi_status', 'perlu didiskusikan')
    ->count();

// Ambil user yang memiliki file dengan status lulus atau tidak lulus
    $data = User::where('role', 'user')
    ->whereHas('userFiles', function ($query) {
        $query->where('status_data', 1)
              ->whereIn('administrasi_status', ['perlu didiskusikan']);
    })
    ->with(['userProfile', 'userFiles' => function ($query) {
        $query->where('status_data', 1)
              ->whereIn('administrasi_status', ['perlu didiskusikan']);
    }])
    ->get();


    return view('admin.belumverifikasi', compact('data', 'dokumenList', 'greeting', 'belumVerifikasi'));
}

    public function lulusVerifikasi()
{
    $greeting = $this->getGreeting();

    $dokumenList = UserFiles::with('userProfile.user')->get();

    // Hitung jumlah file yang masih menunggu verifikasi
    $belumVerifikasi = DB::table('user_files')
    ->where('status_data', 1)
    ->where('administrasi_status', 'memenuhi syarat')
    ->count();

// Ambil user yang memiliki file dengan status lulus atau tidak lulus
    $data = User::where('role', 'user')
    ->whereHas('userFiles', function ($query) {
        $query->where('status_data', 1)
              ->whereIn('administrasi_status', ['memenuhi syarat']);
    })
    ->with(['userProfile', 'userFiles' => function ($query) {
        $query->where('status_data', 1)
              ->whereIn('administrasi_status', ['memenuhi syarat']);
    }])
    ->get();


    return view('admin.lulusverifikasi', compact('data', 'dokumenList', 'greeting', 'belumVerifikasi'));
}

    public function tidaklulusVerifikasi()
{
    $greeting = $this->getGreeting();

    $dokumenList = UserFiles::with('userProfile.user')->get();

    // Hitung jumlah file yang masih menunggu verifikasi
    $belumVerifikasi = DB::table('user_files')
    ->where('status_data', 1)
    ->where('administrasi_status', 'tidak memenuhi syarat')
    ->count();

// Ambil user yang memiliki file dengan status lulus atau tidak lulus
    $data = User::where('role', 'user')
    ->whereHas('userFiles', function ($query) {
        $query->where('status_data', 1)
              ->whereIn('administrasi_status', ['tidak memenuhi syarat']);
    })
    ->with(['userProfile', 'userFiles' => function ($query) {
        $query->where('status_data', 1)
              ->whereIn('administrasi_status', ['tidak memenuhi syarat']);
    }])
    ->get();


    return view('admin.tidaklulusverifikasi', compact('data', 'dokumenList', 'greeting', 'belumVerifikasi'));
}

    public function update(Request $request, $id){
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'field' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $userFiles = UserFiles::where('user_id', $id)->firstOrFail();

        $statusField = 'status_' . $request->field;
        $userFiles->$statusField = $request->status;
        $userFiles->save();

        return back()->with('success', 'Status verifikasi berhasil diperbarui.');
    }

    public function verifikasi_form(Request $request){
        $user_id = $request->get('userid');

        return view('admin.verifikasiform', compact('user_id'));
    }
    public function statuskahirform(Request $request){
        $user_id = $request->get('userid');

        return view('admin.statuskahirform', compact('user_id'));
    }

    public function verifikasi_saveupdate(Request $request)
{
    /* ---------- 1. Validasi ---------- */
    $request->validate([
        'user_id'           => 'required|exists:user_files,user_id',
        'status_verifikasi' => 'required|in:memenuhi syarat,perlu didiskusikan,tidak memenuhi syarat',
        'catatan_verifikasi'=> 'nullable|string',
    ]);

    /* ---------- 2. Build array status bidang ---------- */
    $statusFields = [
        'status_ktp',
        'status_ijazah_sarjana',
        'status_transkrip_sarjana',
        'status_ijazah_magister',
        'status_transkrip_magister',
        'status_ijazah_doktoral',
        'status_transkrip_doktoral',
        'status_upl_org',
        'status_upl_rek_pakar1',
        'status_upl_rek_pakar2',
        'status_upl_rek_pakar3',
        'status_lamaran',
        'status_rangkap_jabatan',
        'status_cv',
        'status_pidana',
        'status_makalah',
        'status_surat_sehat',
        'status_skck',
        'status_persetujuan',
    ];

    // setiap kolom di‑isi value request atau default “belum diverifikasi”
    $data = collect($statusFields)
        ->mapWithKeys(fn ($field) => [$field => $request->input($field, 'belum diverifikasi')])
        ->toArray();

    /* ---------- 3. Field inti administrasi ---------- */
    $data += [
        'administrasi_status'  => $request->status_verifikasi,
        'administrasi_catatan' => $request->catatan_verifikasi,
        'verified_by'          => auth()->id(),
        'verified_at'          => now(),           // pakai Carbon
    ];

    /* ---------- 4. Propagasi otomatis ---------- */
    if ($request->status_verifikasi === 'tidak memenuhi syarat') {
    $data['assessment_status'] = 'tidak lulus';
    $data['wawancara_status']  = 'tidak lulus';
    } else {
        // biarkan kosong agar tidak override status 'menunggu'
        unset($data['assessment_status'], $data['wawancara_status']);
    }


    /* ---------- 5. Simpan sekali saja ---------- */
    $updated = DB::table('user_files')
        ->where('user_id', $request->user_id)
        ->update($data);

    /* ---------- 6. Ambil nama pelamar untuk notifikasi ---------- */
    $pelamar = User::with('userProfile')->find($request->user_id);
    $namaLengkap = trim(
        ($pelamar->userProfile->gelar_depan ?? '').' '.
        $pelamar->name.' '.
        ($pelamar->userProfile->gelar_belakang ?? '')
    );

    $pesan = $updated
        ? "Verifikasi berkas {$namaLengkap} sukses"
        : "Verifikasi berkas {$namaLengkap} gagal";

    return redirect()->route('verifikasi.index')->with('message', $pesan);
}


    public function statusakhirsave(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:user_files,user_id',
        'status_akhir' => 'required|in:lulus,tidak lulus',
        'catatan_akhir' => 'nullable|string',
    ]);

    // Ambil record berdasarkan user_id
    $userFile = UserFiles::where('user_id', $request->user_id)->first();

    if (!$userFile) {
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    // Simpan data
    $userFile->status_akhir = $request->status_akhir;
    $userFile->catatan_akhir = $request->catatan_akhir;
    $userFile->save();

    return redirect()->back()->with('success', 'Status akhir berhasil disimpan.');
}

}
