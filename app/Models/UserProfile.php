<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'gelar_depan', 
        'gelar_belakang',
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
    
}
