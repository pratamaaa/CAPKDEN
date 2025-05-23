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

class AssesmentController extends Controller
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

    public function assessment()
{
    $greeting = $this->getGreeting();
    $userfiles = UserFiles::where('user_id', auth()->id())->first();

    $data = User::where('role', 'user')
    ->whereHas('userFiles', function ($query) {
        $query->where('administrasi_status', 'Lulus');
    })
    ->with(['userProfile', 'userFiles', 'hasilWawancara'])
    ->get();
    return view('assesment.assesment', compact('data', 'greeting', 'userfiles'));
}

public function store(Request $request)
{
    if (!in_array(auth()->user()->role, ['admin', 'verifikator'])) {
        abort(403, 'Unauthorized action.');
    }
    
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'assessment_status' => 'required|in:Lulus,Tidak Lulus',
        'assessment_catatan' => 'nullable|string',
    ]);

    $userFiles = UserFiles::where('user_id', $request->user_id)->first();

    if ($userFiles) {
        $userFiles->update([
            'assessment_status' => $request->assessment_status,
            'assessment_catatan' => $request->assessment_catatan,
            'verified_by' => auth()->id(),
        ]);
    }

    return redirect()->back()->with('success', 'Status assesment berhasil diupdate.');
}

}
