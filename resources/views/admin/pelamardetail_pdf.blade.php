<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>detailpelamar</title>

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0;
            background-color: #ffffff;
            font: 12pt "Tahoma";
        }
        table, th, td {
            border: 0px solid black;
            border-collapse: collapse;
        }
        .ratatengah{ text-align: center; }
        .cetaktebal{ font-weight: bold; }
        .table-header{
            background-color: #7B7878;padding:10px;text-align:center;font-weight:bold;
            border: 1px solid #B8B8B8;
        }
        .row-gray{
            background-color: #E0E0E0;
            padding: 10px 5px;
            border: 1px solid #B8B8B8;
            vertical-align: top;
        }
        .row-white{
            background-color: #ffffff;
            padding: 10px 5px;
            border: 1px solid #B8B8B8;
            vertical-align: top;
        }
        .title{
            font-weight: bold;
            font-size: 17px;
            padding: 0px 5px 10px 0px;
        }
    </style>
</head>
<body>
    @php
        if ($pelamar->gelar_depan == '' || $pelamar->gelar_depan == '-'){
            $gelardepan = '';
        }else{
            $gelardepan = $pelamar->gelar_depan;
        }

        if ($pelamar->gelar_belakang == '' || $pelamar->gelar_belakang == '-'){
            $gelarbelakang = '';
        }else{
            $gelarbelakang = $pelamar->gelar_belakang;
        }

        $namalengkap_pelamar = $gelardepan.' '.$pelamar->name.', '.$gelarbelakang;
      @endphp

    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td colspan="2" style="text-align: center;font-weight:bold;height:50px;"><h2>Detail Pelamar</h2><br></td>
        </tr>
        <tr>
            <td style="width: 30%;">
                <table style="padding: 5px;">
                    <tr>
                        <td class="ratatengah" style="border: 0px !important;border-collapse: collapse !important;">
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('uploads/pas_foto/' . $pelamar->pas_foto))) }}" width="130px">
                        </td>
                    </tr>
                    <tr><td class="ratatengah"><b>{{ $namalengkap_pelamar }}</b><br>{{ $pelamar->kalangan }}</td></tr>
                    <tr>
                        <td style="">
                            <p><i class="fas fa-id-card me-2 text-muted"></i><strong>NIK</strong><br><span>{{ $pelamar->nik }}</span></p>
                            <p><i class="fas fa-calendar-alt me-2 text-muted"></i><strong>TTL</strong><br><span>{{ $pelamar->tempat_lahir.', '.Bantuan::tanggalindo($pelamar->tanggal_lahir) }}</span></p>
                            <p><i class="fas fa-venus-mars me-2 text-muted"></i><strong>Jenis Kelamin</strong><br><span>{{ $pelamar->jenis_kelamin }}</span></p>
                            <p><i class="fas fa-phone me-2 text-muted"></i><strong>No. HP</strong><br><span>{{ $pelamar->no_handphone }}</span></p>
                            <p><i class="fas fa-envelope me-2 text-muted"></i><strong>Email</strong><br><span>{{ $pelamar->email }}</span></p>
                            <p><i class="fas fa-map-marker-alt me-2 text-muted"></i><strong>Alamat</strong><br><span>{{ $pelamar->alamat }}</span></p>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 70%;vertical-align: top;">
                <table style="padding: 5px;">
                    <tr><td colspan="4" class="title">Riwayat Pendidikan:</td></tr>
                    <tr>
                        <td class="table-header" style="width: 20%;">Jenjang</td>
                        <td class="table-header" style="width: 35%;">Universitas</td>
                        <td class="table-header" style="width: 35%;">Jurusan</td>
                        <td class="table-header" style="width: 10%;">Tahun Lulus</td>
                    </tr>
                    <tr>
                        <td class="row-gray cetaktebal">Sarjana</td>
                        <td class="row-gray">{{ ($files_check != 0) ? $pelamar->universitas_sarjana : '-'}}</td>
                        <td class="row-gray">{{ ($files_check != 0) ? $pelamar->jurusan_sarjana : '-'}}</td>
                        <td class="row-gray ratatengah">{{ ($files_check != 0) ? $pelamar->lulus_sarjana : '-'}}</td>
                    </tr>
                    <tr>
                        <td class="row-white cetaktebal">Magister</td>
                        <td class="row-white">{{ ($files_check != 0) ? $pelamar->universitas_magister : '-'}}</td>
                        <td class="row-white">{{ ($files_check != 0) ? $pelamar->jurusan_magister : '-'}}</td>
                        <td class="row-white ratatengah">{{ ($files_check != 0) ? $pelamar->lulus_magister : '-'}}</td>
                    </tr>
                    <tr>
                        <td class="row-gray cetaktebal">Doktoral</td>
                        <td class="row-gray">{{ ($files_check != 0) ? $pelamar->universitas_doktoral : '-'}}</td>
                        <td class="row-gray">{{ ($files_check != 0) ? $pelamar->jurusan_doktoral : '-'}}</td>
                        <td class="row-gray ratatengah">{{ ($files_check != 0) ? $pelamar->lulus_doktoral : '-'}}</td>
                    </tr>
                </table>
                <br>
                <table style="padding: 5px; width: 100%;">
                    <tr><td colspan="2" class="title">Pengusul Calon Kalangan:</td></tr>
                    <tr>
                        <td class="row-gray cetaktebal" style="width: 35%;">Organisasi Pengusul</td>
                        <td class="row-gray" style="width: 65%;"><span>{{ ($files_check != 0) ? $pelamar->org_pengusul : '-'}}</span></td>
                    </tr>
                    <tr>
                        <td class="row-white cetaktebal">Rekomendasi Pakar-1</td>
                        <td class="row-white">{{ ($files_check != 0) ? $pelamar->rek_pakar1 : '-'}}</td>
                    </tr>
                    <tr>
                        <td class="row-gray cetaktebal">Rekomendasi Pakar-2</td>
                        <td class="row-gray">{{ ($files_check != 0) ? $pelamar->rek_pakar2 : '-'}}</td>
                    </tr>
                    <tr>
                        <td class="row-white cetaktebal">Rekomendasi Pakar-3</td>
                        <td class="row-white">{{ ($files_check != 0) ? $pelamar->rek_pakar3 : '-'}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
    <tr>
        <td colspan="2" class="row-gray" style="font-weight: bold;">
            Status Pendaftaran: <span style="color: green;">Sudah Submit.</span> Tanggal Submit: {{ optional($pelamar)->updated_at ?? 'Belum diisi' }}
        </td>
    </tr>

</tr>
    </table>
</body>
</html>