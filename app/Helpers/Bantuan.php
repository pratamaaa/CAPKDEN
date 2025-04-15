<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// use Illuminate\Http\Request;

class Bantuan{

    public static function berkaspelamar($id_pelamar){
        $data = DB::table('user_files')->where('user_id', $id_pelamar);

        return $data;
    }
}