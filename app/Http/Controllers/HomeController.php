<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\PengumumanController;

class HomeController extends Controller
{
    public function homepage(){
        return view('homepage');
    }
    
    public function index()
    {
        $data = User::get();

        return view('index', compact('data'));
    }

    public function pengumuman(){
        return view('header/pengumuman');
    }

    public function kontak(){
        return view('header/kontak');
    }
}
