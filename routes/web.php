<?php

use App\Http\Controllers\{
    AssesmentController,
    AuthController,
    DashboardController,
    HomeController,
    PdfController,
    PengumumanController,
    PertanyaanWawancaraController,
    TahapanstatusController,
    UploadController,
    UserExperienceController,
    UserFilesController,
    VerifikasiController,
    WawancaraController
};
use Illuminate\Support\Facades\Route;

// === PUBLIC ===
Route::get('/', [HomeController::class, 'homepage']);
Route::get('/home2', [HomeController::class, 'homepage2']);
Route::get('/check_pelamar', [HomeController::class, 'check_pelamar']);
Route::get('/pengumuman', [HomeController::class, 'pengumuman']);
Route::get('/kontak', [HomeController::class, 'kontak']);

// === AUTH ===
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/reset-password', [AuthController::class, 'showForm'])->name('reset-password.form');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('reset-password.submit');

// === USER DASHBOARD ===
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/updatedata', [DashboardController::class, 'updatedata'])->name('updatedata');
    Route::post('/store-user-profile', [DashboardController::class, 'storeUserProfile'])->name('storeUserProfile');

    Route::get('/updateberkas', [DashboardController::class, 'updateberkas'])->name('updateberkas');
    Route::post('/store-user-files', [UserFilesController::class, 'store'])->name('storeUserFiles');
    Route::get('/statusberkas', [UserFilesController::class, 'status'])->name('statusberkas');
    Route::put('/userfiles/update/{field}', [UserFilesController::class, 'update'])->name('userfiles.update');
    Route::delete('/userfiles/delete/{field}', [UserFilesController::class, 'destroy'])->name('userfiles.destroy');
    Route::put('/userfiles/updatestatus/{field}', [UserFilesController::class, 'updatestatus'])->name('userfiles.updatestatus');
    Route::get('/barcode', [DashboardController::class, 'barcode']);
    Route::get('/password', [DashboardController::class, 'password'])->name('user.password');
    Route::post('/password', [DashboardController::class, 'updatePassword'])->name('user.updatePassword');

    Route::resource('pengalaman', UserExperienceController::class)->only(['store', 'update', 'destroy']);
    Route::post('/upload/{field}', [UploadController::class, 'uploadFile'])->name('upload.file');
});

// === VERIFIKATOR DASHBOARD ===
Route::middleware(['auth', 'role:verifikator'])->group(function () {
    Route::get('/verifikator', [DashboardController::class, 'verifikatorDashboard'])->name('verifikator.dashboard');
});

// === ADMIN DASHBOARD ===
Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('administrator.dashboard');
});

// === ADMIN & VERIFIKATOR ===
Route::middleware(['auth', 'role:administrator,verifikator'])->group(function () {

    // DATA PENGGUNA DAN PELAMAR
    Route::get('/pengguna', [DashboardController::class, 'pengguna'])->name('pengguna');
    Route::put('/pengguna/update/{id}', [DashboardController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/delete/{id}', [DashboardController::class, 'destroy'])->name('pengguna.delete');
    Route::get('/daftarpelamar', [DashboardController::class, 'daftarpelamar'])->name('daftarpelamar');

    // WAWANCARA & ASSESSMENT
    Route::get('/wawancara', [WawancaraController::class, 'wawancara'])->name('wawancara');
    Route::post('/wawancara/store', [WawancaraController::class, 'store'])->name('wawancara.store');
    Route::get('/assesment', [AssesmentController::class, 'assesment'])->name('assesment');
    Route::post('/assesment/store', [AssesmentController::class, 'store'])->name('assesment.store');

    // DOKUMEN PDF & BARCODE
    Route::get('/pelamardetail', [DashboardController::class, 'pelamardetail']);
    Route::get('/pelamardetail_pdf', [DashboardController::class, 'pelamardetail_pdf']);
    Route::get('/datapelamar_pdf', [DashboardController::class, 'datapelamar_pdf']);
    Route::get('/download-pdf/{id}', [PdfController::class, 'generatePdf'])->name('download.pdf');

    // PENGUMUMAN
    Route::get('/upl_pengumuman', [DashboardController::class, 'upl_pengumuman'])->name('upl_pengumuman');
    Route::get('/create', [DashboardController::class, 'create'])->name('create');
    Route::post('/store', [DashboardController::class, 'store'])->name('store');
    Route::post('/pengumuman/upload', [PengumumanController::class, 'upload'])->name('pengumuman.upload');
    Route::get('/pengumuman/{filename}', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::put('/pengumuman/update', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/destroy', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

    // VERIFIKASI
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::put('/verifikasi/update-semua', [VerifikasiController::class, 'updateSemua'])->name('verifikasi.updateSemua');
    Route::get('/verifikasiform', [VerifikasiController::class, 'verifikasi_form'])->name('verifikasiform');
    Route::post('/verifikasi_saveupdate', [VerifikasiController::class, 'verifikasi_saveupdate'])->name('verifikasi_saveupdate');

    // LAINNYA
    Route::get('/download-template/{type}', [DashboardController::class, 'download'])->name('template.download');
    Route::get('/tahapanstatus', [TahapanstatusController::class, 'index']);
});

Route::middleware(['auth', 'role:administrator,verifikator'])->group(function () {
    
});

// === PERTANYAAN WAWANCARA ===
Route::get('/pertanyaan', [PertanyaanWawancaraController::class, 'pertanyaan'])->name('pertanyaan');
Route::post('/pertanyaan', [PertanyaanWawancaraController::class, 'store'])->name('pertanyaan.store');
Route::put('/pertanyaan/{id}/update', [PertanyaanWawancaraController::class, 'update'])->name('pertanyaan.update');
Route::delete('/pertanyaan/{id}', [PertanyaanWawancaraController::class, 'destroy'])->name('pertanyaan.destroy');
