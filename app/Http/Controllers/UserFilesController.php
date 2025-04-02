<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserFileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ktp' => 'required|nullable|file|mimes:pdf|max:1024',
            'universitas_sarjana' => 'required|string|max:255',
            'jurusan_sarjana' => 'required|string|max:255',
            'lulus_sarjana' => 'required|string|max:255',
            'ijazah_sarjana' => 'nullable|file|mimes:pdf|max:1024',
            'transkrip_sarjana' => 'nullable|file|mimes:pdf|max:1024',
            'universitas_magister' => 'string|max:255',
            'jurusan_magister' => 'string|max:255',
            'lulus_magister' => 'string|max:255',
            'ijazah_magister' => 'nullable|file|mimes:pdf|max:1024',
            'transkrip_magister' => 'nullable|file|mimes:pdf|max:1024',
            'universitas_doktoral' => 'string|max:255',
            'jurusan_doktoral' => 'string|max:255',
            'lulus_doktoral' => 'string|max:255',
            'ijazah_doktoral' => 'nullable|file|mimes:pdf|max:1024',
            'transkrip_doktoral' => 'nullable|file|mimes:pdf|max:1024',
            'org_pengusul' => 'required|string|max:255',
            'upl_org' => 'nullable|file|mimes:pdf|max:1024',
            'rek_pakar1' => 'required|string|max:255',
            'upl_rek_pakar1' => 'nullable|file|mimes:pdf|max:1024',
            'rek_pakar2' => 'required|string|max:255',
            'upl_rek_pakar2' => 'nullable|file|mimes:pdf|max:1024',
            'rek_pakar3' => 'required|string|max:255',
            'upl_rek_pakar3' => 'nullable|file|mimes:pdf|max:1024',
            'lamaran' => 'nullable|file|mimes:pdf|max:1024',
            'rangkap_jabatan' => 'nullable|file|mimes:pdf|max:1024',
            'cv' => 'nullable|file|mimes:pdf|max:1024',
            'pidana' => 'nullable|file|mimes:pdf|max:1024',
            'makalah' => 'nullable|file|mimes:pdf|max:1024',
            'surat_sehat' => 'nullable|file|mimes:pdf|max:1024',
            'skck' => 'nullable|file|mimes:pdf|max:1024',
        ]);

        // Simpan file ke storage
        $data = [];
        foreach ($request->allFiles() as $key => $file) {
            $data[$key] = $file->store('uploads/user_files', 'public');
        }

        // Simpan ke database
        UserFile::updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        return redirect()->back()->with('success', 'Berkas berhasil diunggah!');
    }

    public function index()
{
    $userFiles = UserFiles::where('user_id', Auth::id())->first();
    return view('berkas.index', compact('userFiles'));
}

}
