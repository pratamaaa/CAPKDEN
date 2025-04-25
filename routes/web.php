<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\TahapanstatusController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserExperienceController;
use App\Http\Controllers\UserFilesController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\WawancaraController;
use App\Http\Controllers\PertanyaanWawancaraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class, 'homepage']);
Route::get('/home2',[HomeController::class, 'homepage2']);
Route::get('/pengumuman',[HomeController::class, 'pengumuman']);
// Route::get('/pengumuman2',[HomeController::class, 'pengumuman2']);
Route::get('/kontak',[HomeController::class, 'kontak']);

// LOGIN 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/reset-password', [AuthController::class, 'showForm'])->name('reset-password.form');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('reset-password.submit');


// MIDDLEWARE
Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('administrator.dashboard');
});

Route::middleware(['auth', 'role:verifikator'])->group(function () {
    Route::get('/verifikator', [DashboardController::class, 'verifikatorDashboard'])->name('verifikator.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    // USER 
    Route::get('/updatedata', [DashboardController::class, 'updatedata'])->name('updatedata');
    Route::post('/store-user-profile', [DashboardController::class, 'storeUserProfile'])->name('storeUserProfile');
    Route::get('/updateberkas', [DashboardController::class, 'updateberkas'])->name('updateberkas');
    Route::post('/store-user-files', [UserFilesController::class, 'store'])->name('storeUserFiles');
    Route::get('/statusberkas', [UserFilesController::class, 'status'])->name('statusberkas');
    Route::put('/userfiles/update/{field}', [UserFilesController::class, 'update'])->name('userfiles.update');
    Route::get('/password', [DashboardController::class, 'password'])->name('user.password');
    Route::post('/password', [DashboardController::class, 'updatePassword'])->name('user.updatePassword');
    Route::delete('/userfiles/delete/{field}', [UserFilesController::class, 'destroy'])->name('userfiles.destroy');
    Route::put('/userfiles/updatestatus/{field}', [UserFilesController::class, 'updatestatus'])->name('userfiles.updatestatus');
    Route::middleware(['auth'])->group(function () {
        Route::resource('pengalaman', UserExperienceController::class)->only([
            'store', 'update', 'destroy'
        ]);
    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/user/upload-makalah', [UserFilesController::class, 'uploadMakalah'])->name('upload.makalah');
        Route::post('/user/upload-makalah', [UserFilesController::class, 'storeMakalah'])->name('upload.makalah.store');
    });
    Route::delete('/user/upload-makalah/delete/{id}', [UserFilesController::class, 'deleteMakalah'])->name('upload.makalah.delete');


    // ADMIN 
    Route::get('/pengguna', [DashboardController::class, 'pengguna'])->name('pengguna');
    Route::get('/upl_pengumuman', [DashboardController::class, 'upl_pengumuman'])->name('upl_pengumuman');
    Route::get('/create', [DashboardController::class, 'create'])->name('create');
    Route::post('/store', [DashboardController::class, 'store'])->name('store');
    Route::put('/pengguna/update/{id}', [DashboardController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/delete/{id}', [DashboardController::class, 'destroy'])->name('pengguna.delete');
    Route::get('/daftarpelamar', [DashboardController::class, 'daftarpelamar'])->name('daftarpelamar');
    Route::get('/wawancara', [WawancaraController::class, 'wawancara'])->name('wawancara');
    Route::get('/pelamardetail', [DashboardController::class, 'pelamardetail']);
    Route::get('/pelamardetail_pdf', [DashboardController::class, 'pelamardetail_pdf']);
    Route::get('/download-pdf/{id}', [PdfController::class, 'generatePdf'])->name('download.pdf');
    // Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::post('/pengumuman/upload', [PengumumanController::class, 'upload'])->name('pengumuman.upload');
    Route::get('/pengumuman/{filename}', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::put('/pengumuman/update', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/destroy', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
    Route::post('/upload/{field}', [UploadController::class, 'uploadFile'])->name('upload.file');
    Route::get('/download-template/{type}', [DashboardController::class, 'download'])->name('template.download');

    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::put('/verifikasi/update-semua', [VerifikasiController::class, 'updateSemua'])->name('verifikasi.updateSemua');
    Route::get('/verifikasiform', [VerifikasiController::class, 'verifikasi_form'])->name('verifikasiform');
    Route::post('/verifikasi_saveupdate', [VerifikasiController::class, 'verifikasi_saveupdate'])->name('verifikasi_saveupdate');

    Route::get('/tahapanstatus', [TahapanstatusController::class, 'index']);
});

Route::get('/pertanyaan', [PertanyaanWawancaraController::class, 'pertanyaan'])->name('pertanyaan');
Route::post('/pertanyaan', [PertanyaanWawancaraController::class, 'store'])->name('pertanyaan.store');
Route::post('/pertanyaan/{id}/update', [PertanyaanWawancaraController::class, 'update'])->name('pertanyaan.update');
Route::delete('/pertanyaan/{id}', [PertanyaanWawancaraController::class, 'destroy'])->name('pertanyaan.destroy');

