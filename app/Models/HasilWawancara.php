<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilWawancara extends Model
{
    protected $fillable = [
        'user_id',
        'pertanyaan_id',
        'kriteria',
        'nilai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanWawancara::class, 'pertanyaan_id');
    }
}
