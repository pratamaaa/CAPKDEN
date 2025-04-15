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
            'ktp' => 'nullable|file|mimes:pdf|max:1024',
        ];
    } elseif ($step == 2) {
        $rules = [
            'universitas_sarjana' => 'nullable|string|max:255',
            'jurusan_sarjana' => 'nullable|string|max:255',
            'lulus_sarjana' => 'nullable|string|max:255',
            'ijazah_sarjana' => 'nullable|file|mimes:pdf|max:1024',
            'transkrip_sarjana' => 'nullable|file|mimes:pdf|max:1024',

            'universitas_magister' => 'nullable|string|max:255',
            'jurusan_magister' => 'nullable|string|max:255',
            'lulus_magister' => 'nullable|string|max:255',
            'ijazah_magister' => 'nullable|file|mimes:pdf|max:1024',
            'transkrip_magister' => 'nullable|file|mimes:pdf|max:1024',

            'universitas_doktoral' => 'nullable|string|max:255',
            'jurusan_doktoral' => 'nullable|string|max:255',
            'lulus_doktoral' => 'nullable|string|max:255',
            'ijazah_doktoral' => 'nullable|file|mimes:pdf|max:1024',
            'transkrip_doktoral' => 'nullable|file|mimes:pdf|max:1024',
        ];
    } elseif ($step == 3) {
        $rules = [
            'org_pengusul' => 'nullable|string|max:255',
            'upl_org' => 'nullable|file|mimes:pdf|max:1024',
            'rek_pakar1' => 'nullable|string|max:255',
            'upl_rek_pakar1' => 'nullable|file|mimes:pdf|max:1024',
            'rek_pakar2' => 'nullable|string|max:255',
            'upl_rek_pakar2' => 'nullable|file|mimes:pdf|max:1024',
            'rek_pakar3' => 'nullable|string|max:255',
            'upl_rek_pakar3' => 'nullable|file|mimes:pdf|max:1024',
        ];
    } elseif ($step == 4) {
        $rules = [
            'lamaran' => 'nullable|file|mimes:pdf|max:1024',
            'cv' => 'nullable|file|mimes:pdf|max:1024',
            'rangkap_jabatan' => 'nullable|file|mimes:pdf|max:1024',
            'pidana' => 'nullable|file|mimes:pdf|max:1024',
            'makalah' => 'nullable|file|mimes:pdf|max:1024',
            'surat_sehat' => 'nullable|file|mimes:pdf|max:1024',
            'skck' => 'nullable|file|mimes:pdf|max:1024',
        ];
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('active_step', $step);
    }

    // Simpan file yang diupload
    $uploadedFiles = [];
    foreach ($request->allFiles() as $field => $file) {
        if ($file->isValid()) {
            $uploadedFiles[$field] = $file->store('uploads/user_files', 'public');
        } else {
            return redirect()->back()
                ->with('error', "File $field tidak valid.")
                ->with('active_step', $step);
        }
    }

    $inputText = $request->except(array_merge(['_token', 'step'], array_keys($uploadedFiles)));

    $data = array_merge($uploadedFiles, $inputText);

    UserFiles::updateOrCreate(
        ['user_id' => auth()->id()],
        $data
    );

    return redirect()->route('statusberkas')->with([
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

public function status()
{
    $greeting = $this->getGreeting();
    $userFiles = UserFiles::where('user_id', Auth::id())->first();
    $success = session('success');
    return view('user.statusberkas', compact('userFiles', 'greeting', 'success'));
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
}


