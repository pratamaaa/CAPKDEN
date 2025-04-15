<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFiles;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Session;

class VerifikasiController extends Controller
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

    public function index()
    {
        $greeting = $this->getGreeting();
        $dokumenList = UserFiles::with('userProfile.user')->get();
        $data = User::where('role', 'user')
    ->with(['userProfile', 'userFiles'])
    ->get();
        return view('admin.verifikasi', compact('data','dokumenList', 'greeting'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:diterima,ditolak',
        'field' => 'required|string',
        'keterangan' => 'nullable|string',
    ]);

    $userFiles = UserFiles::where('user_id', $id)->firstOrFail();

    $statusField = 'status_' . $request->field;
    $userFiles->$statusField = $request->status;
    $userFiles->save();

    return back()->with('success', 'Status verifikasi berhasil diperbarui.');
}

}
