<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserFiles;
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

    $step = $request->input('step');

    $rules = [];

    if ($step == 1) {
        $rules = [
            'ktp' => 'required|file|mimes:pdf|max:1024',
        ];
    } elseif ($step == 2) {
        $rules = [
            // Wajib S1
            'universitas_sarjana' => 'required|string|max:255',
            'jurusan_sarjana' => 'required|string|max:255',
            'lulus_sarjana' => 'required|string|max:255',
            'ijazah_sarjana' => 'required|file|mimes:pdf|max:1024',
            'transkrip_sarjana' => 'required|file|mimes:pdf|max:1024',
    
            // Opsional S2
            'universitas_magister' => 'nullable|string|max:255',
            'jurusan_magister' => 'nullable|string|max:255',
            'lulus_magister' => 'nullable|string|max:255',
            'ijazah_magister' => 'nullable|file|mimes:pdf|max:1024',
            'transkrip_magister' => 'nullable|file|mimes:pdf|max:1024',
    
            // Opsional S3
            'universitas_doktoral' => 'nullable|string|max:255',
            'jurusan_doktoral' => 'nullable|string|max:255',
            'lulus_doktoral' => 'nullable|string|max:255',
            'ijazah_doktoral' => 'nullable|file|mimes:pdf|max:1024',
            'transkrip_doktoral' => 'nullable|file|mimes:pdf|max:1024',
        ];
    
    
    } elseif ($step == 3) {
        $rules = [
            'org_pengusul' => 'required|string|max:255',
            'upl_org' => 'required|file|mimes:pdf|max:1024',
            'rek_pakar1' => 'required|string|max:255',
            'upl_rek_pakar1' => 'required|file|mimes:pdf|max:1024',
            'rek_pakar2' => 'required|string|max:255',
            'upl_rek_pakar2' => 'required|file|mimes:pdf|max:1024',
            'rek_pakar3' => 'required|string|max:255',
            'upl_rek_pakar3' => 'required|file|mimes:pdf|max:1024',
            
        ];
    } elseif ($step == 4) {
        $rules = [
            'lamaran' => 'required|file|mimes:pdf|max:1024',
            'cv' => 'required|file|mimes:pdf|max:1024',
            'rangkap_jabatan' => 'required|file|mimes:pdf|max:1024',
            'pidana' => 'required|file|mimes:pdf|max:1024',
            'makalah' => 'required|file|mimes:pdf|max:1024',
            'surat_sehat' => 'required|file|mimes:pdf|max:1024',
            'skck'=> 'required|file|mimes:pdf|max:1024',
        ];
    }

    $validator = Validator::make($request->all(), $rules);

if ($validator->fails()) {
    return redirect()->back()
        ->withErrors($validator)
        ->withInput()
        ->with('active_step', $step); // menyimpan step yang gagal validasi
}

    // Simpan ke database
    $data = [];
    foreach ($request->allFiles() as $key => $file) {
        $data[$key] = $file->store('uploads/user_files', 'public');
    }

    // Gabungkan dengan input teks
    $data = array_merge($data, $request->except(['_token', 'step']));

    UserFiles::updateOrCreate(
        ['user_id' => auth()->id()],
        $data
    );

    return redirect()->route('updateberkas')->with([
        'success' => 'Berkas berhasil diunggah!',
        'step' => $step
    ]);    
}

    public function index()
{
    $greeting = $this->getGreeting();
    $userFiles = UserFiles::where('user_id', Auth::id())->first();
    return view('user.berkas', compact('userFiles', 'greeting'));
}

}


