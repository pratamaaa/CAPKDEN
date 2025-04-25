<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PertanyaanWawancara;

class PertanyaanWawancaraController extends Controller
{
    private function getGreeting()
    {
        date_default_timezone_set('Asia/Jakarta');
        $hour = date('H');

        if ($hour >= 5 && $hour < 12) {
            return "Selamat Pagi";
        } elseif ($hour >= 12 && $hour < 15) {
            return "Selamat Siang";
        } elseif ($hour >= 15 && $hour < 18) {
            return "Selamat Sore";
        } else {
            return "Selamat Malam";
        }
    }

    public function pertanyaan()
    {
        $greeting = $this->getGreeting();
        $pertanyaans = PertanyaanWawancara::all();
        return view('admin.pertanyaan.index', compact('pertanyaans','greeting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
        ]);

        PertanyaanWawancara::create($request->only('pertanyaan'));
        return redirect()->back()->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
        ]);

        PertanyaanWawancara::findOrFail($id)->update($request->only('pertanyaan'));
        return redirect()->back()->with('success', 'Pertanyaan berhasil diupdate.');
    }

    public function destroy($id)
    {
        PertanyaanWawancara::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pertanyaan berhasil dihapus.');
    }
}

