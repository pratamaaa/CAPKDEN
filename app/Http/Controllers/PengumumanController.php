<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanPdf;
use App\Http\Controllers\DashboardController;

class PengumumanController extends Controller
{
    // Tampilkan halaman daftar & preview
    public function index()
    {
        $pengumumans = PengumumanPdf::all();
        return view('header.pengumuman', compact('pengumumans'));
    }

    // Proses upload PDF
    public function upload(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'file_path' => 'required|mimes:pdf|max:2048' // Hanya menerima file PDF maksimal 2MB
    ]);

    // Periksa apakah file benar-benar diunggah
    if ($request->hasFile('file_path')) {
        $filePath = $request->file('file_path')->store('pengumuman', 'public');

        PengumumanPdf::create([
            'title' => $request->title,
            'file_path' => $filePath
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil diunggah.');
    } else {
        return redirect()->back()->withErrors(['file_path' => 'File tidak ditemukan. Silakan unggah kembali.']);
    }
}


    public function show($filename)
{
    $path = storage_path("app/public/uploads/pengumuman/{$filename}");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="'.basename($path).'"',
    ]);
}

public function update(Request $request)
{
    $request->validate(['title' => 'required']);
    $pengumuman = PengumumanPdf::findOrFail($request->id);
    $pengumuman->update(['title' => $request->title]);

    return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui.');
}

public function destroy(Request $request)
{
    $pengumuman = PengumumanPdf::findOrFail($request->id);
    
    // Hapus file jika ada
    if ($pengumuman->file) {
        Storage::delete('public/pengumuman/' . $pengumuman->file);
    }

    $pengumuman->delete();

    return redirect()->back()->with('success', 'Pengumuman berhasil dihapus!');
}

}

