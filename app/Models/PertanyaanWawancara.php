<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanWawancara extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan'
    ];

    public function hasil()
    {
    return $this->hasMany(HasilWawancara::class, 'pertanyaan_id');
    }
}
