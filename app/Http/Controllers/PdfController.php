<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\UserFiles;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf($id)
    {
        // Ambil data pelamar dari tabel user_profile
       
        // $pelamar = UserProfile::with(['user', 'userFiles'])->where('user_id', $id)->first();
        $pelamar = UserProfile::with(['pendidikan', 'pengusul'])->where('user_id', $id)->first();


        if (!$pelamar) {
            return redirect()->back()->with('error', 'Data pelamar tidak ditemukan.');
        }

        // Load view dengan data pelamar
        $pdf = Pdf::loadView('pdf.pelamar', compact('pelamar'));

        // Unduh file PDF
        return $pdf->download("Detail_Pelamar_{$pelamar->user_id}.pdf");
    }
}
