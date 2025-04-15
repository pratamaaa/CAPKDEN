<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

    <table border="1px">
        <tr>
            <td colspan="2" style="text-align: center;font-weight:bold;">Detail Pelamar</td>
        </tr>
        <tr>
            <td style="width: 30%;">
                <table>
                    <tr><td><img src="{{ asset('uploads/pas_foto/' . $pelamar->pas_foto) }}" class="img-thumbnail rounded-circle border mb-3 shadow-sm" style="width: 120px; height: 120px; object-fit: cover;" alt="Foto Profile"></td></tr>
                    <tr><td>{{ $namalengkap_pelamar }}<br>{{ $pelamar->kalangan }}</td></tr>
                    <tr>
                        <td><p><i class="fas fa-id-card me-2 text-muted"></i><strong>NIK</strong><br><span>{{ $pelamar->nik }}</span></p></td>
                    </tr>
                    <tr>
                        <td><p><i class="fas fa-calendar-alt me-2 text-muted"></i><strong>TTL</strong><br><span>{{ $pelamar->tempat_lahir.', '.$pelamar->tanggal_lahir }}</span></p></td>
                    </tr>
                    <tr>
                        <td><p><i class="fas fa-venus-mars me-2 text-muted"></i><strong>Jenis Kelamin</strong><br><span>{{ $pelamar->jenis_kelamin }}</span></p></td>
                    </tr>
                    <tr>
                        <td><p><i class="fas fa-phone me-2 text-muted"></i><strong>No. HP</strong><br><span>{{ $pelamar->no_handphone }}</span></p></td>
                    </tr>
                    <tr>
                        <td><p><i class="fas fa-envelope me-2 text-muted"></i><strong>Email</strong><br><span>{{ $pelamar->email }}</span></p></td>
                    </tr>
                    <tr>
                        <td><p><i class="fas fa-map-marker-alt me-2 text-muted"></i><strong>Alamat</strong><br><span>{{ $pelamar->alamat }}</span></p></td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: top;">
                <table>
                    <tr><td colspan="4" style="font-weight: bold;">Pendidikan</td></tr>
                    <tr>
                        <td>Jenjang</td>
                        <td>Universitas</td>
                        <td>Jurusan</td>
                        <td>Tahun Lulus</td>
                    </tr>
                    <tr>
                        <td>Sarjana</td>
                        <td>{{ ($files_check != 0) ? $pelamar->universitas_sarjana : '-'}}</td>
                        <td>{{ ($files_check != 0) ? $pelamar->jurusan_sarjana : '-'}}</td>
                        <td>{{ ($files_check != 0) ? $pelamar->lulus_sarjana : '-'}}</td>
                    </tr>
                    <tr>
                        <td>Magister</td>
                        <td>{{ ($files_check != 0) ? $pelamar->universitas_magister : '-'}}</td>
                        <td>{{ ($files_check != 0) ? $pelamar->jurusan_magister : '-'}}</td>
                        <td>{{ ($files_check != 0) ? $pelamar->lulus_magister : '-'}}</td>
                    </tr>
                    <tr>
                        <td>Doktoral</td>
                        <td>{{ ($files_check != 0) ? $pelamar->universitas_doktoral : '-'}}</td>
                        <td>{{ ($files_check != 0) ? $pelamar->jurusan_doktoral : '-'}}</td>
                        <td>{{ ($files_check != 0) ? $pelamar->lulus_doktoral : '-'}}</td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr><td colspan="2" style="font-weight: bold;">Pengusul Calon Kalangan</td></tr>
                    <tr>
                        <td>Organisasi Pengusul</td>
                        <td><span>{{ ($files_check != 0) ? $pelamar->org_pengusul : '-'}}</span></td>
                    </tr>
                    <tr>
                        <td>Rekomendasi Pakar-1</td>
                        <td>{{ ($files_check != 0) ? $pelamar->rek_pakar1 : '-'}}</td>
                    </tr>
                    <tr>
                        <td>Rekomendasi Pakar-2</td>
                        <td>{{ ($files_check != 0) ? $pelamar->rek_pakar2 : '-'}}</td>
                    </tr>
                    <tr>
                        <td>Rekomendasi Pakar-3</td>
                        <td>{{ ($files_check != 0) ? $pelamar->rek_pakar3 : '-'}}</td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</body>
</html>