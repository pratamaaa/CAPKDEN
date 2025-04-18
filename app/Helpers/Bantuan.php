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

    public static function tanggalindo($tanggal){
		$split_space = explode(' ', $tanggal);
		$str = explode('-', $split_space[0]);

		$bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		return $str[2].' '.$bulan[$str[1]].' '.$str[0];
	}
}