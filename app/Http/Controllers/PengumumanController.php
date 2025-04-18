<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanPdf;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\DashboardController;

class PengumumanController extends Controller
{
    // Tampilkan halaman daftar & preview
    public function index()
    {
        $pengumumans = PengumumanPdf::all();
        return view('pengumuman', compact('pengumumans'));
    }

    // public function pengumuman2()
    // {
    //     $pengumumans = PengumumanPdf::all();
    //     return view('pengumuman2', compact('pengumumans'));
    // }

    // Proses upload PDF
    public function upload(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'file_path' => 'required|mimes:pdf|max:20480'
    ]);

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
    $request->validate([
        'id' => 'required|exists:pengumuman_pdfs,id',
        'title' => 'required|string|max:255',
        'file_path' => 'nullable|file|mimes:pdf|max:20480',
    ]);

    $pengumuman = PengumumanPdf::findOrFail($request->id);
    $pengumuman->title = $request->title;

    // Jika ada file baru
    if ($request->hasFile('file_path')) {
        // Hapus file lama
        if ($pengumuman->file_path && Storage::disk('public')->exists($pengumuman->file_path)) {
            Storage::disk('public')->delete($pengumuman->file_path);
        }

        // Upload file baru
        $file = $request->file('file_path');
        $path = $file->store('uploads/pengumuman', 'public');
        $pengumuman->file_path = $path;
    }

    $pengumuman->save();

    return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui!');
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

