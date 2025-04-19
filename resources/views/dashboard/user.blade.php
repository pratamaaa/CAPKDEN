@extends('layout/dashadmin')
@section('content')
<!-- Main content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @php
                    $user = auth()->user();
                    $userProfile = $user->userProfile;
                    $userFiles = $user->userfiles()->get();
                @endphp

                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($userProfile)
                                    <img src="{{ asset('uploads/pas_foto/' . optional($userProfile)->pas_foto) }}"
                                        alt="Foto Profil" class="img-thumbnail"
                                        style="width: 250px; height: 250px; border-radius: 50%;">
                                @else
                                    <img src="{{ asset('uploads/pas_foto/default.png') }}" alt="Default Foto"
                                        class="img-thumbnail" style="width: 250px; height: 250px; border-radius: 50%;">
                                @endif
                            </div>
                            <h3 class="profile-username text-center">
                                {{ optional($userProfile)->gelar_depan }}
                                {{ $user->name }}
                                {{ optional($userProfile)->gelar_belakang }}
                            </h3>
                        </div>
                    </div>

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-calendar mr-1"></i> Tempat dan Tanggal Lahir</strong>
                            <p class="text-muted">
                                {{ $user->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') }}
                            </p>
                            <hr>

                            <strong><i class="fas fa-user"></i> Username</strong>
                            <p class="text-muted">{{ $user->username }}</p>
                            <hr>

                            <strong><i class="fas fa-home"></i> Alamat</strong>
                            <p class="text-muted">{{ optional($userProfile)->alamat ?? 'Belum diisi' }}</p>
                            <hr>

                            <strong><i class="fas fa-book"></i> NIK</strong>
                            <p class="text-muted">{{ $user->nik }}</p>
                            <hr>

                            <strong><i class="fas fa-envelope-open"></i> Email Aktif</strong>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- KANAN -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Status Pelamar</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <!-- STATUS PELAMAR -->
                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <table class="table table-bordered">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th class="text-center" width="40%">Detail Pendaftaran</th>
                                                    <th class="text-center" width="60%">Status Seleksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table>
                                                            <td>Calon Kalangan : {{ optional($userProfile)->kalangan ?? 'Belum diisi' }}</td>
                                                        </table>
                                                        {{-- <strong>Calon Kalangan : {{ optional($userProfile)->kalangan ?? 'Belum diisi' }}</strong><br>
                                                        Tanggal Registrasi : {{ $user->created_at }}
                                                        Pendidikan : 
                                                        Pengalaman :  --}}
                                                    </td>
                                                    <td>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" style="width: 10px">#</th>
                                                                    <th class="text-center" style="width: 20px">Tahapan</th>
                                                                    <th class="text-center" style="width: 5px"></th>
                                                                    <th class="text-center" style="width: 40px">Status</th>
                                                                    <th class="text-center" style="width: 40px">Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Administrasi</td>
                                                                    <td class="text-center">:</td>
                                                                    <td class="text-center">
                                                                        <span class="badge bg-danger">Belum Upload</span><br>
                                                            <span class="badge bg-primary">Proses Verifikasi</span><br>
                                                            <span class="badge bg-success">Selesai Verifikasi</span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span class="badge bg-success">Lulus</span><br>
                                                                        <span class="badge bg-danger">Tidak Lulus</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Assesment</td>
                                                                    <td class="text-center">:</td>
                                                                    <td class="text-center">
                                                                        <span class="badge bg-warning">-</span><br>
                                                                        <span class="badge bg-primary">Proses Assesment</span>
                                                                        <span class="badge bg-success">Selesai Assesment</span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span class="badge bg-warning">-</span><br>
                                                                        <span class="badge bg-success">Lulus</span><br>
                                                                        <span class="badge bg-danger">Tidak Lulus</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>Wawancara</td>
                                                                    <td class="text-center">:</td>
                                                                    <td class="text-center">
                                                                        <span class="badge bg-warning">-</span><br>
                                                                        <span class="badge bg-primary">Proses Wawancara</span>
                                                                        <span class="badge bg-success">Selesai Wawancara</span>
                                                                    </td>
                                                                    <td class="text-center"><span class="badge bg-warning">-</span><br>
                                                                        <span class="badge bg-success">Lulus</span><br>
                                                                        <span class="badge bg-danger">Tidak Lulus</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>Fit and Proper Test</td>
                                                                    <td class="text-center">:</td>
                                                                    <td class="text-center"><span class="badge bg-warning">Menunggu</span></td>
                                                                    <td class="text-center"><span class="badge bg-warning">Menunggu</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="alert alert-warning d-flex align-items-start gap-3 p-3" role="alert"
                                style="border-radius: 8px;">
                                <i class="fas fa-exclamation-triangle fa-lg text-warning mt-1"></i>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">Mohon diperhatikan!</h6>
                                    <ul class="mb-0 ps-3 text-dark">
                                        <li>Pastikan Anda sudah mengupdate <strong>Data Diri dan Kelengkapan Berkas</strong>, pada menu yang sudah disediakan.</li>
                                        <li>Cek kembali data yang sudah di submit sebelum melakukan <strong>Submit Data Final</strong> dihalaman <strong>Status Berkas</strong>.
                                        </li>
                                        <li>
                                            Batas akhir penyampaian data:
                                            <strong id="countdown-timer" class="countdown-style">Menghitung...</strong>
                                        </li>
                                        
                                        <style>
                                            .countdown-style {
                                                background-color: #f8d7da;
                                                color: #721c24;
                                                padding: 4px 10px;
                                                border-radius: 5px;
                                                font-weight: bold;
                                                font-size: 1.25rem;
                                                animation: pulse 1.5s infinite;
                                            }
                                        
                                            @keyframes pulse {
                                                0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.5); }
                                                70% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
                                                100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
                                            }
                                        </style>
                                        
                                        <script>
                                            const deadline = new Date("May 14, 2025 23:59:59").getTime();
                                        
                                            const x = setInterval(function () {
                                                const now = new Date().getTime();
                                                const distance = deadline - now;
                                        
                                                if (distance < 0) {
                                                    clearInterval(x);
                                                    document.getElementById("countdown-timer").innerHTML = "Sudah berakhir.";
                                                    document.getElementById("countdown-timer").classList.remove("countdown-style");
                                                    return;
                                                }
                                        
                                                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                        
                                                document.getElementById("countdown-timer").innerHTML =
                                                    `${days} hari, ${hours} jam, ${minutes} menit, ${seconds} detik`;
                                            }, 1000);
                                        </script>
                                        
                                    </ul>
                                </div>
                            </div>
                                
                            </div> <!-- /.tab-content -->
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </section>
</div> <!-- /.content-wrapper -->
@endsection
