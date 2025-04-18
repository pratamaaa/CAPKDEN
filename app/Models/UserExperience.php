<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    use HasFactory;

    protected $table = 'user_experiences';

    protected $fillable = [
        'user_id',
        'nama_jabatan',
        'unit_kerja',
        'tmt_jabatan',
        'uraian_jabatan',
    ];

    protected $dates = ['tmt_jabatan'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
