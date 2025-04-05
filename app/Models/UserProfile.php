<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'nama_lengkap',
        'gelar_depan', 
        'gelar_belakang', 
        'nik',
        'tempat_lahir', 
        'tanggal_lahir', 
        'jenis_kelamin', 
        'alamat', 
        'no_handphone',
        'pas_foto', 
        'kalangan'
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function userFiles()
    {
    return $this->hasMany(UserFiles::class, 'user_id', 'user_id');
    }
    public function pendidikan()
    {
    return $this->hasMany(Pendidikan::class, 'user_id', 'user_id');
    }

    public function pengusul()
    {
    return $this->hasOne(Pengusul::class, 'user_id', 'user_id');
    }
}
