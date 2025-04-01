<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'nik', 'email', 'password', 'role', 'tempat_lahir', 'tanggal_lahir',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function userProfile()
{
    return $this->hasOne(UserProfile::class, 'user_id');
}
}
