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
                        <div class="alert alert-warning d-flex align-items-start gap-3 p-3" role="alert"
                                style="border-radius: 8px;">
                                <i class="fas fa-exclamation-triangle fa-lg text-warning mt-1"></i>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">Mohon diperhatikan!</h6>
                                    <ul class="mb-0 ps-3 text-dark">
                                        <li>Pastikan Anda sudah mengupdate <strong>Data Diri dan Kelengkapan Berkas</strong>, pada menu yang sudah disediakan.</li>
                                        <li>Cek kembali data yang sudah di submit sebelum melakukan <strong>Submit Data Final</strong> dihalaman <strong>Status Berkas</strong>. Jika Anda tidak menyelesaikan dan belum mensubmit sampai batas waktu yang ditetapkan, maka akan dianggap gugur dalam proses Administrasi.
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
                                                font-size: 1rem;
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

                        <div class="card-body">
                            <div class="tab-content">

                                <!-- STATUS PELAMAR -->
                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <table class="table table-bordered">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center" width="60%">Detail Pendaftaran</th>
                                                    <th class="text-center" width="40%">Status Seleksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <td><strong>Calon Kalangan</strong></td>
                                                                <td>{{ optional($userProfile)->kalangan ?? 'Belum diisi' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Tanggal Registrasi</strong></td>
                                                                <td>{{ optional($user)->created_at ?? 'Belum diisi' }}</td>
                                                            </tr>
                                                        </table>
                                                        
                                                        <h6 class="text-primary fw-bold">Riwayat Pendidikan</h6>
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <td class="text-center"><strong>Jenjang</strong></td>
                                                                <td class="text-center"><strong>Universitas</strong></td>
                                                                <td class="text-center"><strong>Jurusan</strong></td>
                                                                <td class="text-center"><strong>Lulus</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Sarjana</strong></td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->universitas_sarjana)
                                                                        {{ $userfiles->universitas_sarjana }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->jurusan_sarjana)
                                                                        {{ $userfiles->jurusan_sarjana }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->lulus_sarjana)
                                                                        {{ $userfiles->lulus_sarjana }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Magister</strong></td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->universitas_magister)
                                                                        {{ $userfiles->universitas_magister }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->jurusan_magister)
                                                                        {{ $userfiles->jurusan_magister }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->lulus_magister)
                                                                        {{ $userfiles->lulus_magister }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Doktoral</strong></td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->universitas_doktoral)
                                                                        {{ $userfiles->universitas_doktoral }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->jurusan_doktoral)
                                                                        {{ $userfiles->jurusan_doktoral }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->lulus_doktoral)
                                                                        {{ $userfiles->lulus_doktoral }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            
                                                        </table>

                                                        <h6 class="text-primary fw-bold">Pengalaman Kerja</h6>
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <td class="text-center"><strong>Nama Jabatan</strong></td>
                                                                <td class="text-center"><strong>Unit Kerja</strong></td>
                                                                <td class="text-center"><strong>TMT Jabatan</strong></td>
                                                            </tr>
                                                            @php
                        $user = auth()->user();
                        $experiences = $user && $user->experiences ? $user->experiences : collect();
                    @endphp
                                                            <tr>
                                                                @if ($experiences->count())
                        @foreach ($experiences as $i => $pengalaman)
                            <tr>
                                <td>{{ $pengalaman->nama_jabatan }}</td>
                                <td>{{ $pengalaman->unit_kerja }}</td>
                                <td>{{ $pengalaman->tmt_jabatan }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data pengalaman.</td>
                        </tr>
                    @endif
                                                            </tr>
                                                            
                                                            
                                                        </table>

                                                        <h6 class="text-primary fw-bold">Pengusul Calon Kalangan</h6>
                                                        <table class="table table-striped">
                                                           
                                                            <tr>
                                                                <td><strong>Organisasi Pengusul</strong></td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->org_pengusul)
                                                                        {{ $userfiles->org_pengusul }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Rekomendasi Pakar-1</strong></td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->rek_pakar1)
                                                                        {{ $userfiles->rek_pakar1 }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Rekomendasi Pakar-2</strong></td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->rek_pakar2)
                                                                        {{ $userfiles->rek_pakar2 }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Rekomendasi Pakar-3</strong></td>
                                                                <td>
                                                                    @if ($userfiles && $userfiles->rek_pakar3)
                                                                        {{ $userfiles->rek_pakar3 }}
                                                                    @else
                                                                        <span class="badge bg-danger">Belum diisi</span>
                                                                    @endif
                                                                </td>
                                                                
                                                            </tr>
                                                            
                                                        </table>
                                                    </div>
                                                </div>
                                              
                                                    
                                                    </td>
                                                    {{-- Status Seleksi --}}
                            <td class="align-top">
                                <table class="table table-bordered table-hover table-sm text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Tahapan</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ([
                                        ['label' => 'Administrasi', 'status' => $userfiles?->administrasi_status, 'catatan' => $userfiles?->administrasi_catatan],
                                        ['label' => 'Assesment', 'status' => $userfiles?->assessment_status, 'catatan' => $userfiles?->assessment_catatan],
                                        ['label' => 'Wawancara', 'status' => $userfiles?->wawancara_status, 'catatan' => $userfiles?->wawancara_catatan],
                                        // ['label' => 'Fit and Proper Test', 'status' => $userfiles?->propertest_status, 'catatan' => $userfiles?->propertest_catatan],
                                    ] as $index => $item)

                                            @php
                                                $badgeClass = match ($item['status']) {
                                                    'lulus' => 'bg-success',
                                                    'tidak lulus' => 'bg-danger',
                                                    default => 'bg-warning text-dark',
                                                };
                                                $statusText = match ($item['status']) {
                                                    'lulus' => 'Lulus',
                                                    'tidak lulus' => 'Tidak Lulus',
                                                    default => 'Menunggu',
                                                };
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item['label'] }}</td>
                                                <td><span class="badge {{ $badgeClass }}">{{ $statusText }}</span></td>
                                                <td>{{ $item['catatan'] ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
