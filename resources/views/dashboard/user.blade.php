@extends('layout/dashadmin')
@section('content')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if (Auth::user()->userProfile)
                                        <img src="{{ asset('uploads/pas_foto/' . optional(Auth::user()->userProfile)->pas_foto) }}"
                                            alt="Foto Profil" class="img-thumbnail"
                                            style="width: 250px; height: 250px; border-radius: 50%;">
                                    @else
                                        <img src="{{ asset('uploads/pas_foto/default.png') }}" alt="Default Foto"
                                            class="img-thumbnail" style="width: 250px; height: 250px; border-radius: 50%;">
                                    @endif
                                </div>

                                <h3 class="profile-username text-center">
                                    {{ optional(Auth::user()->userProfile)->gelar_depan }}.
                                    {{ Auth::user()->name }},
                                    {{ optional(Auth::user()->userProfile)->gelar_belakang }}
                                </h3>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-calendar mr-1"></i> Tempat dan Tanggal Lahir</strong>

                                <p class="text-muted">
                                    {{ Auth::user()->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->format('d-m-Y') }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-user"></i> Username</strong>

                                <p class="text-muted">{{ Auth::user()->username }}</p>

                                <hr>

                                <strong><i class="fas fa-book"></i> NIK</strong>

                                <p class="text-muted">{{ Auth::user()->nik }}</p>

                                <hr>

                                <strong><i class="fas fa-envelope-open"></i> Email Aktif</strong>

                                <p class="text-muted">{{ Auth::user()->email }}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Status Pelamar</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Berkas
                                            Kelengkapan</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="post">

                                            <table class="table table-bordered">
                                                <thead class="table-secondary">
                                                    <tr>
                                                        <th class="text-center" width="40%">Detail Pendaftaran</th>
                                                        <th class="text-center" width="60%">Status Seleksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td>
                                                        <strong>Calon Kalangan :
                                                            {{ Auth::user()->userprofile->kalangan ?? 'Belum diisi' }}</strong>
                                                        <br>
                                                        Tanggal Pendaftaran : {{ Auth::user()->created_at }}
                                                    </td>
                                                    <td>

                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" style="width: 10px">#</th>
                                                                    <th class="text-center" style="width: 20px">Tahapan</th>
                                                                    <th class="text-center" style="width: 5px"></th>
                                                                    <th class="text-center" style="width: 40px">Status</th>

                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Administrasi</td>
                                                                    <td class="text-center">:</td>
                                                                    <td class="text-center"><span
                                                                            class="badge bg-primary">Verfikasi
                                                                            Berkas</span></td>

                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Assesment</td>
                                                                    <td class="text-center">:</td>
                                                                    <td class="text-center"><span
                                                                            class="badge bg-warning">Menunggu</span></td>

                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>Wawancara</td>
                                                                    <td class="text-center">:</td>
                                                                    <td class="text-center"><span
                                                                            class="badge bg-warning">Menunggu</span></td>

                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>Fit and Proper Test</td>
                                                                    <td class="text-center">:</td>
                                                                    <td class="text-center"><span
                                                                            class="badge bg-warning">Menunggu</span></td>

                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.post -->


                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        
                                        <table class="table table-bordered">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th class="text-center">No.</th>
                                                    <th class="text-center">Dokumen</th>
                                                    <th class="text-center">Status Dokumen</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $fieldNames = [
                                                    'ktp', 
                                                    'ijazah_sarjana', 
                                                    'transkrip_sarjana', 
                                                    'ijazah_magister', 
                                                    'transkrip_magister', 
                                                    'ijazah_doktoral', 
                                                    'transkrip_doktoral', 
                                                    'org_pengusul',
                                                    'upl_rek_pakar1', 
                                                    'upl_rek_pakar2', 
                                                    'upl_rek_pakar3', 
                                                    'lamaran', 
                                                    'rangkap_jabatan', 
                                                    'cv', 
                                                    'pidana', 
                                                    'makalah', 
                                                    'surat_sehat', 
                                                    'skck'
                                                ];
                                        
                                                $documents = [
                                                    'KTP/SIM/PASPOR', 
                                                    'Ijazah Sarjana', 
                                                    'Transkrip Sarjana', 
                                                    'Ijazah Magister <small class="text-muted">*opsional</small>', 
                                                    'Transkrip Magister <small class="text-muted">*opsional</small>', 
                                                    'Ijazah Doktoral <small class="text-muted">*opsional</small>',
                                                    'Transkrip Doktoral <small class="text-muted">*opsional</small>',
                                                    'Organisasi Pengusul',
                                                    'Rekomendasi Pakar-1',
                                                    'Rekomendasi Pakar-2', 
                                                    'Rekomendasi Pakar-3',
                                                    'Surat Lamaran',
                                                    'Surat Keterangan Tidak Rangkap Jabatan',
                                                    'Curiculum Vitae',
                                                    'Surat Pernyataan sedang tidak menjalani proses pidana / pernah dipidana',
                                                    'Makalah',
                                                    'Surat Keterangan Sehat Jasmani dan Rohani',
                                                    'SKCK'
                                                ]; 
                                        
                                                $userFiles = Auth::user()->userfiles()->get(); // Ambil semua file milik pengguna
                                                @endphp
                                        
                                                @foreach($documents as $index => $doc)
                                                    <tr>
                                                        <td class="text-center">{{ $index + 1 }}.</td>
                                                        <td>{!! $doc !!}</td> 
                                        
                                                        <td class="text-center">
                                                            @php
                                                            $fieldName = $fieldNames[$index] ?? null;
                                                            $file = $userFiles->where('file_name', $fieldName)->first();
                                                            @endphp
                                                            
                                                            @if($fieldName && $file && $file->file_path)
                                                                <span class="badge bg-success">Sudah Upload</span>
                                                            @else
                                                                <span class="badge bg-danger">Belum Upload</span>
                                                            @endif
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <a href="{{ $file ? route('edit.file', $file->id) : '#' }}" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            <form action="{{ $file ? route('delete.file', $file->id) : '#' }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus file ini?')">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
