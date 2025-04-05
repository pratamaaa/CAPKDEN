<!DOCTYPE html>
<html lang="id">
<pre>
        {{ dd($pelamar) }}
    </pre>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelamar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #008000;
            padding-bottom: 10px;
        }

        .header img {
            width: 50px;
            height: auto;
            vertical-align: middle;
        }

        .header h2 {
            display: inline-block;
            margin-left: 10px;
            color: #008000;
        }

        .info-box {
            display: flex;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .info-box img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .info {
            flex-grow: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #008000;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="{{ public_path('logo_den.png') }}" alt="Logo DEN">
            <h2>Detail Pelamar</h2>
        </div>

        <div class="info-box">
            <img src="{{ public_path('uploads/' . $pelamar->foto) }}" alt="Foto Pelamar">
            <div class="info">
                <h3>{{ $pelamar->nama_lengkap }}</h3>

                <p><strong>NIK:</strong> {{ $pelamar->nik }}</p>
                <p><strong>TTL:</strong> {{ $pelamar->ttl }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $pelamar->jenis_kelamin }}</p>
                <p><strong>No. Handphone:</strong> {{ $pelamar->hp }}</p>
                <p><strong>Email:</strong> {{ $pelamar->email }}</p>
                <p><strong>Alamat:</strong> {{ $pelamar->alamat }}</p>
            </div>
        </div>

        <h3>Pendidikan</h3>
        <table>
            <thead>
                <tr>
                    <th>Jenjang</th>
                    <th>Universitas</th>
                    <th>Jurusan</th>
                    <th>Tahun Lulus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelamar->pendidikan as $pend)
                    <tr>
                        <td>{{ $pend->jenjang }}</td>
                        <td>{{ $pend->universitas }}</td>
                        <td>{{ $pend->jurusan }}</td>
                        <td>{{ $pend->tahun_lulus }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Pengusul Calon Kalangan</h3>
        <table>
            <tbody>
                <tr>
                    <th>Organisasi Pengusul</th>
                    <td>{{ $pelamar->pengusul->organisasi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Rekomendasi Pakar-1</th>
                    <td>{{ $pelamar->pengusul->pakar1 ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Rekomendasi Pakar-2</th>
                    <td>{{ $pelamar->pengusul->pakar2 ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Rekomendasi Pakar-3</th>
                    <td>{{ $pelamar->pengusul->pakar3 ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

    </div>

</body>

</html>
