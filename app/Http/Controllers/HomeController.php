<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homepage(){
        $data['icons'] = [['judul' => 'Pendaftaran<br><br><br>', 'gambar' => 'number/1.png'], 
                          ['judul' => 'Seleksi Administrasi<br><br>', 'gambar' => 'number/2.png'],
                          ['judul' => 'Pengumuman Hasil Seleksi Administrasi', 'gambar' => 'number/3.png'],
                          ['judul' => 'Masa Sanggah<br><br><br>', 'gambar' => 'number/4.png'],
                          ['judul' => 'Seleksi Assessment<br><br>', 'gambar' => 'number/5.png'],
                          ['judul' => 'Pengumuman Hasil Seleksi Assessment', 'gambar' => 'number/6.png'],
                          ['judul' => 'Wawancara<br><br>', 'gambar' => 'number/7.png'],
                          ['judul' => 'Pengumuman Hasil Wawancara', 'gambar' => 'number/8.png'],
                          ['judul' => 'Fit and Proper Test<br><br>', 'gambar' => 'number/9.png'],
                          ['judul' => 'Pengumuman Hasil<br>', 'gambar' => 'number/10.png'],
                          ['judul' => 'Pengumpulan Berkas Asli<br>', 'gambar' => 'number/11.png'],
                          ['judul' => 'Pengangkatan<br><br>', 'gambar' => 'number/12.png'],
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
        return view('header/pengumuman');
    }

    public function kontak(){
        return view('header/kontak');
    }
}
