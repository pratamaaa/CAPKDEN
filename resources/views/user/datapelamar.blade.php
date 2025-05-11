<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CAPK DEN</title>

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0;
            background-color: #ffffff;
            font-family: sans-serif;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 0px solid black;
            border-collapse: collapse;
        }

        .ratatengah {
            text-align: center;
        }

        .cetaktebal {
            font-weight: bold;
        }

        .table-header {
            background-color: #7B7878;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #B8B8B8;
        }

        .row-gray {
            background-color: #06000025;
            padding: 10px 5px;
            border: 1px solid #B8B8B8;
            vertical-align: top;
        }

        .row-white {
            background-color: #ffffff;
            padding: 10px 5px;
            border: 1px solid #B8B8B8;
            vertical-align: top;
        }

        .title {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-box {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            font-size: 14px;
        }

        .status-box span {
            color: #ff9800;
            font-weight: bold;
        }

        .submit-time {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
        }

        .photo {
            flex: 0 0 120px;
        }

        .photo img {
            width: 100px;
            height: auto;
            border: 2px solid #ccc;
            padding: 3px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 10px;
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .info {
            margin-left: 20px;
            flex-grow: 1;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 4px 0;
        }
    </style>
</head>

<body>
    @php
    $gelardepan = ($pelamar && $pelamar->gelar_depan && $pelamar->gelar_depan != '-') ? $pelamar->gelar_depan : '';
    $gelarbelakang = ($pelamar && $pelamar->gelar_belakang && $pelamar->gelar_belakang != '-') ? $pelamar->gelar_belakang : '';
    $namalengkap_pelamar = ($pelamar && $pelamar->name) ? $gelardepan . ' ' . $pelamar->name . ($gelarbelakang ? ', ' . $gelarbelakang : '') : '';
@endphp


    {{-- <img src="{{ asset('bs/assets/images/logo-den.png') }}" alt="" style="width: 300px; position:absolute"> --}}
<img src="{{ public_path('bs/assets/images/logo-den.png') }}" alt="" style="width: 300px; position:absolute">

    <img src="{{ storage_path('app/' . $barcode) }}" alt=""
        style="width: 100px; position:absolute;right:0;top:-10">




    <table cellspacing="0" cellpadding="0" width="100%" style="padding-top:50px;">
        <tr>
            <td align="center">


                <div class="title">STATUS PENDAFTARAN</div>

                <div class="status-box">
                    Terima Kasih Anda berhasil <span>SUBMIT</span>
                </div>

                <div class="submit-time">
                    Tanggal Submit: {{ optional($pelamar)->updated_at ?? 'Belum diisi' }}
                </div>
            </td>
        </tr>
    </table>
    @php
    $gelardepan = ($pelamar && $pelamar->gelar_depan && $pelamar->gelar_depan != '-') ? $pelamar->gelar_depan : '';
    $gelarbelakang = ($pelamar && $pelamar->gelar_belakang && $pelamar->gelar_belakang != '-') ? $pelamar->gelar_belakang : '';
    $namalengkap_pelamar = ($pelamar && $pelamar->name) ? $gelardepan . ' ' . $pelamar->name . ($gelarbelakang ? ', ' . $gelarbelakang : '') : '';
@endphp

    <table width="100%"
        style="padding-left: 0px;padding-top: 10px;padding-right: 0px;padding-bottom: 10px;border:0px solid;">
        <tr>
            <td width="25%" style="border:0px solid red;">
                <div class="photo">
                    @php
    $defaultFotoPath = public_path('images/default_pas_foto.png'); // Gambar default jika tidak ada
    $fotoPath = $pelamar && $pelamar->pas_foto
        ? public_path('uploads/pas_foto/' . $pelamar->pas_foto)
        : $defaultFotoPath;

    $fotoBase64 = file_exists($fotoPath)
        ? base64_encode(file_get_contents($fotoPath))
        : '';
@endphp

@if ($fotoBase64)
    <img src="data:image/png;base64,{{ $fotoBase64 }}"
        style="width:3cm;height:4cm;margin-right:10px;margin-left:10px;">
@else
    <p>Foto tidak tersedia</p>
@endif

                </div>
            </td>
            <td width="100%" style="border:0px solid green; vertical-align:top;padding:0px" cellpadding="0"
                cellspacing="0">
                <div class="info">
                    <table style="padding: 0px;border:0px solid; width:100%">
                        <tr>
                            <td width="60px" style="border:0px solid;vertical-align:top;">Nama</td>
                            <td width="10px" style="border:0px solid;vertical-align:top;">:</td>
                            <td width="400px" style="border:0px solid;vertical-align:top;">{{ $namalengkap_pelamar }}
                            </td>
                        </tr>
                        <tr>
                            <td width="60px" style="border:0px solid;vertical-align:top;">NIK</td>
                            <td width="10px" style="border:0px solid;vertical-align:top;">:</td>
                            <td width="400px" style="border:0px solid;vertical-align:top;">
    {{ $pelamar->nik ?? '-' }}
</td>
                        </tr>
                        <tr>
                            <td width="60px" style="border:0px solid;vertical-align:top;">Kalangan</td>
                            <td width="10px" style="border:0px solid;vertical-align:top;">:</td>
                            <td width="400px" style="border:0px solid;vertical-align:top;">
    {{ $pelamar->kalangan ?? '-' }}
</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dewan Energi Nasional | 2025
    </div>
</body>

</html>
