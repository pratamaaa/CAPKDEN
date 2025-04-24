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
            ->with(['userProfile', 'userFiles']) // Pastikan relasi di-load
            ->get();
        $pelamar = DB::table('users as us')
               ->join('user_profiles as pr', 'us.id', '=', 'pr.user_id');
        return view('wawancara.intrvw', compact('data', 'pelamar', 'greeting', 'userfiles'));
    }
}
