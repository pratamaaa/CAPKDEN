<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserFilesController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\VerifikasiController;

Route::get('/',[HomeController::class, 'homepage']);
Route::get('/pengumuman',[HomeController::class, 'pengumuman']);
Route::get('/kontak',[HomeController::class, 'kontak']);

// LOGIN 

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/register', [AuthController::class, 'register'])->name('register');

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

// ADMIN 
Route::get('/pengguna', [DashboardController::class, 'pengguna'])->name('pengguna');
Route::get('/upl_pengumuman', [DashboardController::class, 'upl_pengumuman'])->name('upl_pengumuman');
Route::get('/create', [DashboardController::class, 'create'])->name('create');
Route::post('/store', [DashboardController::class, 'store'])->name('store');
Route::put('/pengguna/update/{id}', [DashboardController::class, 'update'])->name('pengguna.update');
Route::delete('/pengguna/delete/{id}', [DashboardController::class, 'destroy'])->name('pengguna.delete');
Route::get('/daftarpelamar', [DashboardController::class, 'daftarpelamar'])->name('daftarpelamar');
Route::get('/download-pdf/{id}', [PdfController::class, 'generatePdf'])->name('download.pdf');
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::post('/pengumuman/upload', [PengumumanController::class, 'upload'])->name('pengumuman.upload');
Route::get('/pengumuman/{filename}', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::put('/pengumuman/update', [PengumumanController::class, 'update'])->name('pengumuman.update');
Route::delete('/pengumuman/destroy', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
Route::post('/upload/{field}', [UploadController::class, 'uploadFile'])->name('upload.file');
Route::get('verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::put('/verifikasi/update-semua', [VerifikasiController::class, 'updateSemua'])->name('verifikasi.updateSemua');
Route::get('/download-template/{type}', [DashboardController::class, 'download'])->name('template.download');




