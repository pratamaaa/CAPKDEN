<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumumanPdf extends Model
{
    use HasFactory;
    protected $table = 'pengumuman_pdfs'; // Nama tabel di database
    protected $fillable = ['title', 'file_path'];
    public $timestamps = true;
}
