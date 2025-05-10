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
        
        $data['jadwalseleksi'] = [['judul' => 'Pendaftaran Calon Anggota DEN', 'gambar' => 'number/1.png', 'tanggal'=>'9 Mei s.d. 23 Mei 2025'], 
                                    ['judul' => 'Pengumuman Hasil Seleksi Administrasi', 'gambar' => 'number/2.png', 'tanggal'=>'28 Mei 2025'],
                                    ['judul' => 'Pelaksanaan Assessment<br><br>', 'gambar' => 'number/3.png', 'tanggal'=>'2 s.d. 7 Juni 2025'],
                                    ['judul' => 'Pengumuman Hasil Assessment', 'gambar' => 'number/4.png', 'tanggal'=>'24 Juni 2025'],
                                    ['judul' => 'Pelaksanaan Wawancara<br><br>', 'gambar' => 'number/5.png', 'tanggal'=>'25 s.d. 27 Juni 2025'],
                                    ['judul' => 'Pengumuman Hasil Wawancara', 'gambar' => 'number/6.png', 'tanggal'=>'30 Juni 2025'],
                                    ['judul' => 'Fit & Proper Test (DPR RI)<br><br>', 'gambar' => 'number/7.png', 'tanggal'=>'Menyesuaikan'],
                                    ['judul' => 'Pengangkatan APK DEN Periode 2026-2030', 'gambar' => 'number/8.png', 'tanggal'=>'Menyesuaikan'],
                                ];
        $data['syarat'] = DB::table('persyaratan')->orderBy('urutan', 'asc');
        return view('homepage', $data);
        // return view('undermaintenance', $data);
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

    
public function check_pelamar(Request $req){
    $uuid = $req->get('code');
    $user = DB::table('users')->where('uuid', $uuid)->first();
    $status = false;
    if($user){
        $status = true;
        $user_id = $user->id;
    }

    if($status){
        $files_check = DB::table('user_files')->where('user_id', $user_id)->count();

        if ($files_check == 0){
            $pelamar = DB::table('users as us')
                    ->join('user_profiles as pr', 'us.id', '=', 'pr.user_id')
                    ->where('us.id', $user_id)->first();
        }else{
            $pelamar = DB::table('users as us')
                    ->join('user_profiles as pr', 'us.id', '=', 'pr.user_id')
                    ->join('user_files as fi', 'us.id', '=', 'fi.user_id')
                    ->where('us.id', $user_id)->first();
        }
    }
    if(!$status){
        echo 'Anda Tidak Terdaftar';
        die();
    }

    $barcode =  'barcode/'.$user_id.'.svg';
    return view('user.datapelamar', compact('files_check', 'pelamar', 'barcode'));
    echo '<pre>';
    print_r($pelamar);
    die();
   
    // $fileName = $user_id.'.svg';
    // $path =  'barcode/'.$fileName;
    // $secureID = md5($user_id);

    // $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
    // ->size(400)
    // ->margin(5)
    // // ->encoding('UTF-8')
    // // ->errorCorrection('H')
    // ->generate("http://capk.den.go.id/check_pelamar?code=".$secureID);
    // Storage::put($path, $qrCode);
    // $barcode = $path;

    // $pdf = PDF::loadView('user.datapelamar', compact('files_check', 'pelamar', 'barcode'))->setPaper('a5', 'landscape');
    // return $pdf->stream('detailpelamar.pdf', 'pelamar');
}


    // public function pengumuman2(){
    //     // $pengumumans = PengumumanPdf::all();
    //     // return view('pengumuman2', compact('pengumumans'));
    //     $data['judulhalaman'] = 'Judul Halamannya Disini';
    //     $pdf = PDF::loadView('pengumuman2', $data)->setPaper('a5', 'portrait');
    //     return $pdf->stream('namafile.pdf');

    //     return view('pengumuman2');
    // }

    public function kontak(){
        return view('kontak');
    }
}
