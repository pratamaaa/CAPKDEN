<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserFiles extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'ktp',
    'universitas_sarjana',
    'jurusan_sarjana',
    'lulus_sarjana',
    'ijazah_sarjana',
    // 'transkrip_sarjana',
    'universitas_magister',
    'jurusan_magister',
    'lulus_magister',
    'ijazah_magister',
    // 'transkrip_magister',
    'universitas_doktoral',
    'jurusan_doktoral',
    'lulus_doktoral',
    'ijazah_doktoral',
    // 'transkrip_doktoral',
    'org_pengusul',
    'upl_org',
    'rek_pakar1',
    'upl_rek_pakar1',
    'rek_pakar2',
    'upl_rek_pakar2',
    'rek_pakar3',
    'upl_rek_pakar3',
    'lamaran',
    'rangkap_jabatan',
    'cv',
    'pidana',
    'judul_makalah',
    'makalah',
    'surat_sehat',
    'skck',
    'nama_jabatan',
    'unit_kerja',
    'tmt_jabatan',
    'uraian_jabatan',
    'persetujuan',
    'wawancara_status',
    'assessment_status',
    'wawancara_catatan',
    'assessment_catatan'
    ];

    // Relasi ke tabel users
    public function user()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }

    public function userProfile()
    {
    return $this->belongsTo(UserProfile::class, 'user_id', 'user_id');
    }
}
