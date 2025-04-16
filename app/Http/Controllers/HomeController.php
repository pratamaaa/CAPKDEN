<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\PengumumanController;
use App\Models\PengumumanPdf;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class HomeController extends Controller
{
    public function homepage(){
        // $data['jadwalseleksi'] = [['judul' => 'Pendaftaran<br><br><br>', 'gambar' => 'number/1.png'], 
        //                   ['judul' => 'Seleksi Administrasi<br><br>', 'gambar' => 'number/2.png'],
        //                   ['judul' => 'Pengumuman Hasil Seleksi Administrasi', 'gambar' => 'number/3.png'],
        //                   ['judul' => 'Masa Sanggah<br><br><br>', 'gambar' => 'number/4.png'],
        //                   ['judul' => 'Seleksi Assessment<br><br>', 'gambar' => 'number/5.png'],
        //                   ['judul' => 'Pengumuman Hasil Seleksi Assessment', 'gambar' => 'number/6.png'],
        //                   ['judul' => 'Wawancara<br><br>', 'gambar' => 'number/7.png'],
        //                   ['judul' => 'Pengumuman Hasil Wawancara', 'gambar' => 'number/8.png'],
        //                   ['judul' => 'Fit and Proper Test<br><br>', 'gambar' => 'number/9.png'],
        //                   ['judul' => 'Pengumuman Hasil<br>', 'gambar' => 'number/10.png'],
        //                   ['judul' => 'Pengumpulan Berkas Asli<br>', 'gambar' => 'number/11.png'],
        //                   ['judul' => 'Pengangkatan<br><br>', 'gambar' => 'number/12.png'],
        //                  ];
        
        $data['jadwalseleksi'] = [['judul' => 'Pengumuman Pendaftaran Penyaringan', 'gambar' => 'number/1.png', 'tanggal'=>'30 April s.d. 14 Mei 2025'], 
                                    ['judul' => 'Pengumuman Hasil Seleksi Administrasi', 'gambar' => 'number/2.png', 'tanggal'=>'16 Mei 2025'],
                                    ['judul' => 'Pelaksanaan Assessment<br><br>', 'gambar' => 'number/3.png', 'tanggal'=>'19 s.d. 21 Mei 2025'],
                                    ['judul' => 'Pengumuman Hasil Assessment', 'gambar' => 'number/4.png', 'tanggal'=>'9 Juni 2025'],
                                    ['judul' => 'Pelaksanaan Wawancara<br><br>', 'gambar' => 'number/5.png', 'tanggal'=>'11 s.d. 13 Juni 2025'],
                                    ['judul' => 'Pengumuman Hasil Wawancara', 'gambar' => 'number/6.png', 'tanggal'=>'20 Juni 2025'],
                                    ['judul' => 'Fit & Proper Test (DPR RI)<br><br>', 'gambar' => 'number/7.png', 'tanggal'=>'Menyesuaikan'],
                                    ['judul' => 'Pengangkatan APK DEN Periode 2026-2029', 'gambar' => 'number/8.png', 'tanggal'=>'Menyesuaikan'],
                                ];
        $data['syarat'] = DB::table('persyaratan')->orderBy('urutan', 'asc');
        return view('homepage', $data);
    }

    public function homepage2(){
        return view('homepage2');
    }
    
    public function index()
    {
        $data = User::get();

        return view('index', compact('data'));
    }

    public function pengumuman(){
        $pengumumans = PengumumanPdf::all();
        return view('pengumuman', compact('pengumumans'));
    }

    public function pengumuman2(){
        // $pengumumans = PengumumanPdf::all();
        // return view('pengumuman2', compact('pengumumans'));
        $data['judulhalaman'] = 'Judul Halamannya Disini';
        $pdf = PDF::loadView('pengumuman2', $data)->setPaper('a5', 'portrait');
        return $pdf->stream('namafile.pdf');

        return view('pengumuman2');
    }

    public function kontak(){
        return view('kontak');
    }
}
