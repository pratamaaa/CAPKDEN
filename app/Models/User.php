<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'nik', 'email', 'password', 'role', 'tempat_lahir', 'tanggal_lahir','uuid'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function userFiles(): HasOne
    {
        return $this->hasOne(UserFiles::class, 'user_id', 'id');
    }
    
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function experiences()
    {
    return $this->hasMany(UserExperience::class);
    }

    public function hasilWawancara()
{
    return $this->hasMany(HasilWawancara::class, 'user_id');
}

public function userExperiences()
{
    return $this->hasMany(UserExperience::class, 'user_id', 'id');
}

public function latestExperience()
{
    return $this->hasOne(UserExperience::class)->latestOfMany();
}

}
