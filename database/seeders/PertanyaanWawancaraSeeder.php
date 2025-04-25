<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PertanyaanWawancara;

class PertanyaanWawancaraSeeder extends Seeder
{
    public function run()
    {
        $pertanyaans = [
            'Apa motivasi Anda mengikuti seleksi ini?',
            'Ceritakan pengalaman kerja Anda yang paling berkesan.',
            'Apa kelebihan utama Anda dalam bekerja tim?',
            'Bagaimana Anda menghadapi tekanan dalam pekerjaan?',
            'Apa yang ingin Anda capai dalam 5 tahun ke depan?',
        ];

        foreach ($pertanyaans as $pertanyaan) {
            PertanyaanWawancara::create(['pertanyaan' => $pertanyaan]);
        }
    }
}

