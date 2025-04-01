<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin DEN',
            'username' => 'admin_den',
            'email' => 'admin@den.go.id',
            'password' => Hash::make('password'),
            'role' => 'administrator',
        ]);

        User::create([
            'name' => 'Verifikator DEN',
            'username' => 'verifikator_den',
            'email' => 'verifikator@den.go.id',
            'password' => Hash::make('password'),
            'role' => 'verifikator',
        ]);

        User::create([
            'name' => 'User Biasa',
            'nik' => '1234567890123456',
            'email' => 'user@den.go.id',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}

