<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserExperience;
use Illuminate\Support\Facades\Auth;

class UserExperienceController extends Controller
{
    // Menampilkan semua data pengalaman user yang sedang login
    public function index()
{
    $user = auth()->user()->load('experiences');

    return view('user.experiences.index', compact('user'));
}

    // Menyimpan data pengalaman baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan'   => 'required|string|max:255',
            'unit_kerja'     => 'required|string|max:255',
            'tmt_jabatan'    => 'required|date',
            'uraian_jabatan' => 'required|string',
        ]);

        UserExperience::create([
            'user_id'         => auth()->id(),
            'nama_jabatan'    => $request->nama_jabatan,
            'unit_kerja'      => $request->unit_kerja,
            'tmt_jabatan'     => $request->tmt_jabatan,
            'uraian_jabatan'  => $request->uraian_jabatan,
        ]);

        return redirect()->back()->with('success', 'Data Riwayat Pengalaman berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',
            'tmt_jabatan' => 'required|date',
            'uraian_jabatan' => 'required|string',
        ]);

        $pengalaman = UserExperience::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pengalaman->update([
            'nama_jabatan' => $request->nama_jabatan,
            'unit_kerja' => $request->unit_kerja,
            'tmt_jabatan' => $request->tmt_jabatan,
            'uraian_jabatan' => $request->uraian_jabatan,
        ]);

        return back()->with('success', 'Pengalaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengalaman = UserExperience::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pengalaman->delete();

        return back()->with('success', 'Pengalaman berhasil dihapus.');
    }
}
