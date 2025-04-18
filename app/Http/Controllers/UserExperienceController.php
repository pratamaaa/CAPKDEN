<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserExperience;

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
}
