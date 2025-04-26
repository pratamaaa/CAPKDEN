<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserFiles;
use App\Models\PengumumanPdf;
use App\Models\HasilWawancara;
use App\Models\PertanyaanWawancara;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PertanyaanWawancaraController;
use App\Http\Controllers\PdfController;
use App\Helpers\Bantuan;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class WawancaraController extends Controller
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

    public function wawancara()
{
    $greeting = $this->getGreeting();
    $userfiles = UserFiles::where('user_id', auth()->id())->first();

    $data = User::where('role', 'user')
    ->whereHas('userFiles', function ($query) {
        $query->where('administrasi_status', 'Lulus');
    })
    ->with(['userProfile', 'userFiles', 'hasilWawancara'])
    ->get();


    $pertanyaan = PertanyaanWawancara::all();

    return view('wawancara.intrvw', compact('data', 'greeting', 'userfiles', 'pertanyaan'));
}

public function store(Request $request)
{

    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'jawaban' => 'required|array',
        'jawaban.*.kriteria' => 'required|string|in:Tinggi,Sedang,Rendah',
        'jawaban.*.nilai' => 'required|numeric|min:60|max:98',
        'wawancara_status' => 'required|string|in:Lulus,Tidak Lulus',
        'wawancara_catatan' => 'nullable|string',
    ]);

    $userFiles = UserFiles::where('user_id', $validated['user_id'])->first();
    if ($userFiles) {
        $userFiles->update([
            'wawancara_status' => $validated['wawancara_status'],
            'wawancara_catatan' => $validated['wawancara_catatan'],
        ]);
    }

    HasilWawancara::where('user_id', $validated['user_id'])->delete();

    $jawabanList = [];
    foreach ($validated['jawaban'] as $pertanyaanId => $jawaban) {
        $jawabanList[] = [
            'user_id' => $validated['user_id'],
            'pertanyaan_id' => $pertanyaanId,
            'kriteria' => $jawaban['kriteria'],
            'nilai' => $jawaban['nilai'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    HasilWawancara::insert($jawabanList);

    return redirect()->back()->with('success', 'Hasil wawancara berhasil disimpan.');
}


}
