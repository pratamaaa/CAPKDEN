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

    public static function berkascek($id_pelamar, $namaberkas){
        $data = DB::table('user_files')->where('user_id', $id_pelamar);

		if ($data->count() != 0){
			if ($data->first()->$namaberkas != 0){
				$filepath = $data->first()->$namaberkas;
				$berkascek = '<button type="button" id="btnPreview" class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal" data-bs-target="#previewModalNested"
                                        data-file="'.asset('storage/' . $filepath).'">
                                        Preview
                                    </button>';
			}else{
				$berkascek = '<span class="badge bg-danger">Belum upload</span>';
			}
		}else{
			$berkascek = '<span class="badge bg-danger">Belum upload</span>';
		}

        return $berkascek;
    }

	public static function berkasstatus($id_pelamar, $namaberkas){
		$data = DB::table('user_files')->where('user_id', $id_pelamar)->first();
		$namakolom = "status_".$namaberkas;

		if ($data->$namaberkas != ''){
			if ($data->$namakolom == 'belum diverifikasi'){
				$warna = 'warning';
			}elseif ($data->$namakolom == 'diterima'){
				$warna = 'success';
			}elseif ($data->$namakolom == 'ditolak'){
				$warna = 'danger';
			}
			$label = ucfirst($data->$namakolom);
		}else{
			$warna = 'secondary';
			$label = 'Belum upload';
		}

		return '<span class="badge bg-'.$warna.'">'.$label.'</span>';
	}

	public static function get_verifikator($id_verifikator){
		$data = DB::table('users')->where('id', $id_verifikator)->first();

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