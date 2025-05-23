<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFiles;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Session;
use App\Helpers\Bantuan;
use Illuminate\Support\Facades\DB;


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
                ->with(['userProfile', 'userFiles'])
                ->get();
        return view('admin.verifikasi', compact('data','dokumenList', 'greeting'));
    }

    public function sudahverifikasi()
    {
        $greeting = $this->getGreeting();
        $dokumenList = UserFiles::with('userProfile.user')->get();
        $data = User::where('role', 'user')
                ->whereHas('userFiles', function ($query) {
                    $query->whereIn('administrasi_status', ['lulus', 'tidak lulus']);
                })

                ->with(['userProfile', 'userFiles'])
                ->get();
        return view('admin.sudahverifikasi', compact('data','dokumenList', 'greeting'));
    }

    public function belumVerifikasi()
{
    $greeting = $this->getGreeting();

    $dokumenList = UserFiles::with('userProfile.user')->get();

    $data = User::where('role', 'user')
        ->whereHas('userFiles', function ($query) {
            $query->where('status_data', 1)
                  ->whereIn('administrasi_status', ['menunggu']);
        })
        ->with(['userProfile', 'userFiles'])
        ->get();

    return view('admin.belumverifikasi', compact('data', 'dokumenList', 'greeting'));
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

    public function verifikasi_saveupdate(Request $request){
        $status_ktp = ($request->post('status_ktp') == '' ? 'belum diverifikasi' : $request->post('status_ktp'));
        $status_ijazah_sarjana = ($request->post('status_ijazah_sarjana') == '' ? 'belum diverifikasi' : $request->post('status_ijazah_sarjana'));
        $status_transkrip_sarjana = ($request->post('status_transkrip_sarjana') == '' ? 'belum diverifikasi' : $request->post('status_transkrip_sarjana'));
        $status_ijazah_magister = ($request->post('status_ijazah_magister') == '' ? 'belum diverifikasi' : $request->post('status_ijazah_magister'));
        $status_transkrip_magister = ($request->post('status_transkrip_magister') == '' ? 'belum diverifikasi' : $request->post('status_transkrip_magister'));
        $status_ijazah_doktoral = ($request->post('status_ijazah_doktoral') == '' ? 'belum diverifikasi' : $request->post('status_ijazah_doktoral'));
        $status_transkrip_doktoral = ($request->post('status_transkrip_doktoral') == '' ? 'belum diverifikasi' : $request->post('status_transkrip_doktoral'));
        $status_upl_org = ($request->post('status_upl_org') == '' ? 'belum diverifikasi' : $request->post('status_upl_org'));
        $status_upl_rek_pakar1 = ($request->post('status_upl_rek_pakar1') == '' ? 'belum diverifikasi' : $request->post('status_upl_rek_pakar1'));
        $status_upl_rek_pakar2 = ($request->post('status_upl_rek_pakar2') == '' ? 'belum diverifikasi' : $request->post('status_upl_rek_pakar2'));
        $status_upl_rek_pakar3 = ($request->post('status_upl_rek_pakar3') == '' ? 'belum diverifikasi' : $request->post('status_upl_rek_pakar3'));
        $status_lamaran = ($request->post('status_lamaran') == '' ? 'belum diverifikasi' : $request->post('status_lamaran'));
        $status_rangkap_jabatan = ($request->post('status_rangkap_jabatan') == '' ? 'belum diverifikasi' : $request->post('status_rangkap_jabatan'));
        $status_cv = ($request->post('status_cv') == '' ? 'belum diverifikasi' : $request->post('status_cv'));
        $status_pidana = ($request->post('status_pidana') == '' ? 'belum diverifikasi' : $request->post('status_pidana'));
        $status_makalah = ($request->post('status_makalah') == '' ? 'belum diverifikasi' : $request->post('status_makalah'));
        $status_surat_sehat = ($request->post('status_surat_sehat') == '' ? 'belum diverifikasi' : $request->post('status_surat_sehat'));
        $status_skck = ($request->post('status_skck') == '' ? 'belum diverifikasi' : $request->post('status_skck'));
        $status_persetujuan = ($request->post('status_persetujuan') == '' ? 'belum diverifikasi' : $request->post('status_persetujuan'));
        $status_verifikasi = $request->post('status_verifikasi');
        $catatan_verifikasi = $request->post('catatan_verifikasi');
        $user_id = $request->post('user_id');

        $data = ['status_ktp' => $status_ktp,
                 'status_ijazah_sarjana' => $status_ijazah_sarjana,
                 'status_transkrip_sarjana' => $status_transkrip_sarjana,
                 'status_ijazah_magister' => $status_ijazah_magister,
                 'status_transkrip_magister' => $status_transkrip_magister,
                 'status_ijazah_doktoral' => $status_ijazah_doktoral,
                 'status_transkrip_doktoral' => $status_transkrip_doktoral,
                 'status_upl_org' => $status_upl_org,
                 'status_upl_rek_pakar1' => $status_upl_rek_pakar1,
                 'status_upl_rek_pakar2' => $status_upl_rek_pakar2,
                 'status_upl_rek_pakar3' => $status_upl_rek_pakar3,
                 'status_lamaran' => $status_lamaran,
                 'status_rangkap_jabatan' => $status_rangkap_jabatan,
                 'status_cv' => $status_cv,
                 'status_pidana' => $status_pidana,
                 'status_makalah' => $status_makalah,
                 'status_surat_sehat' => $status_surat_sehat,
                 'status_skck' => $status_skck,
                 'status_persetujuan' => $status_persetujuan,
                 'verified_by' => auth()->user()->id,
                 'verified_at' => date('Y-m-d H:i:s'),
                 'administrasi_status' => $status_verifikasi,
                 'administrasi_catatan' => $catatan_verifikasi,
                ];
        
        $pelamar = DB::table('users as us')
                   ->join('user_profiles as pro', 'us.id', '=', 'pro.user_id')
                   ->where('us.id', $user_id)->first();
        $depan = ($pelamar->gelar_depan != '' ? $pelamar->gelar_depan : '');
        $nama = $pelamar->name;
        $belakang = ($pelamar->gelar_belakang != '' ? $pelamar->gelar_belakang : '');
        $namalengkap_pelamar = str_replace('-', '', $depan.$nama.','. $belakang);

        $simpan = DB::table('user_files')->where('user_id', $user_id)->update($data);
        if ($simpan){
            $pesan = 'Verifikasi berkas <b>'.$namalengkap_pelamar.'</b> sukses';
        }else{
            $pesan = 'Verifikasi berkas <b>'.$namalengkap_pelamar.'</b> gagal';
        }

        return redirect()->route('verifikasi.index')->with('message', $pesan);
    }

}
