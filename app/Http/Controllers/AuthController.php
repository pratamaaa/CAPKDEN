<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'identifier' => 'required', // Bisa username atau NIK
        'password' => 'required',
        'g-recaptcha-response' => 'required|captcha', // Validasi reCAPTCHA di awal
    ]);

    $user = null;

    // Cek apakah input adalah NIK (hanya untuk user)
    if (is_numeric($request->identifier) && strlen($request->identifier) == 16) {
        $user = User::where('nik', $request->identifier)->first();
    } else {
        // Jika bukan NIK, anggap sebagai username (admin & verifikator)
        $user = User::where('username', $request->identifier)->first();
    }

    // Validasi jika user ditemukan dan password cocok
    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);
        return redirect()->route("$user->role.dashboard");
    }

    return back()->withErrors(['loginError' => 'Username/NIK atau password salah!'])->withInput();
}

    public function registrasi(){
        return view('auth.registrasi');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function register(Request $request)
{
    // Validasi Input termasuk reCAPTCHA

    $validator = Validator::make($request->all(), [
    'name' => 'required|string|max:255',
    'username' => 'required|string|max:255',
    'nik' => 'required|string|min:16|unique:users,nik',
    'email' => 'required|string|email|max:255|unique:users,email',
    'password' => [
        'required',
        'string',
        'min:6',
        'confirmed',
        'regex:/[a-z]/',      // huruf kecil
        'regex:/[A-Z]/',      // huruf besar
        'regex:/[0-9]/',      // angka
        'regex:/[@$!%*#?&]/', // simbol
    ],
    'tempat_lahir' => 'required|string|max:255',
    'tanggal_lahir' => 'required|date|before:' . now()->subYears(45)->format('Y-m-d'),
    'g-recaptcha-response' => 'required|captcha', // Validasi reCAPTCHA
], [
    'tanggal_lahir.before' => 'Anda harus berusia minimal 45 tahun untuk mendaftar.',
    'password.regex' => 'Password minimal 6 karakter dan harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
]);


    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Simpan ke Database
    User::create([
        'uuid' => (string) Str::uuid(),
        'name' => $request->name,
        'username' => $request->username,
        'nik' => $request->nik,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'role' => 'user', // Set role default untuk pendaftar baru
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
}

    public function showForm()
    {
        return view('auth.reset-password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('username', $request->username)
                    ->where('email', $request->email)
                    ->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Data tidak ditemukan.'])->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah!');
    }
}