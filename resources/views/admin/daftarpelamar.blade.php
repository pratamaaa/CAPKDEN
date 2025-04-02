@extends('layout/dashadmin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Pelamar</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="overflow-x: auto;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="header-row">
                                            <th class="align-top text-center" rowspan="3">No</th>
                                            <th class="align-top text-center" rowspan="3">Foto Profile</th>
                                            <th class="align-top text-center" rowspan="3">Nama</th>
                                            <th class="align-top text-center" rowspan="3">NIK</th>
                                            <th class="align-top text-center" rowspan="3">Tempat, Tanggal Lahir</th>
                                            <th class="align-top text-center" rowspan="3">Jenis Kelamin</th>
                                            <th class="align-top text-center" rowspan="3">Alamat</th>
                                            <th class="align-top text-center" rowspan="3">No. Handphone</th>
                                            <th class="align-top text-center" rowspan="3">Calon Kalangan</th>
                                            <th class="text-center" colspan="9">Pendidikan</th>
                                            <th class="text-center" colspan="4">Pengusul Calon Kalangan</th>
                                        </tr>
                                        <tr class="header-row">
                                            <th class="text-center" colspan="3">Sarjana</th>
                                            <th class="text-center" colspan="3">Magister</th>
                                            <th class="text-center" colspan="3">Doktoral</th>
                                            <th class="text-center" rowspan="3">Organisasi Pengusul</th>
                                            <th class="text-center" rowspan="3">Rekomendasi Pakar-1</th>
                                            <th class="text-center" rowspan="3">Rekomendasi Pakar-2</th>
                                            <th class="text-center" rowspan="3">Rekomendasi Pakar-3</th>
                                        </tr>
                                        <tr class="header-row">
                                            <th class="text-center" rowspan="3">Universitas</th>
                                            <th class="text-center" rowspan="3">Jurusan</th>
                                            <th class="text-center" rowspan="3">Lulus</th>
                                            <th class="text-center" rowspan="3">Universitas</th>
                                            <th class="text-center" rowspan="3">Jurusan</th>
                                            <th class="text-center" rowspan="3">Lulus</th>
                                            <th class="text-center" rowspan="3">Universitas</th>
                                            <th class="text-center" rowspan="3">Jurusan</th>
                                            <th class="text-center" rowspan="3">Lulus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if (optional($d->userProfile)->pas_foto)
                                                        <img src="{{ asset('uploads/pas_foto/' . $d->userProfile->pas_foto) }}"
                                                            width="100">
                                                    @else
                                                        Belum diisi
                                                    @endif
                                                </td>
                                                <td>{{ $d->userProfile->gelar_depan ?? 'Belum diisi' }}.
                                                    {{ $d->userProfile->nama_lengkap ?? 'Belum diisi' }},
                                                    {{ $d->userProfile->gelar_belakang ?? 'Belum diisi' }}
                                                </td>
                                                <td>{{ $d->userProfile->nik ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userProfile->tempat_lahir ?? 'Belum diisi' }},
                                                    {{ $d->userProfile->tanggal_lahir ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userProfile->jenis_kelamin ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userProfile->alamat ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userProfile->no_handphone ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userProfile->kalangan ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->universitas_sarjana ?? 'Belum diisi' }}
                                                </td>
                                                <td>{{ $d->userFiles->jurusan_sarjana ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->lulus_sarjana ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->universitas_magister ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->jurusan_magister ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->lulus_magister ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->universitas_doktoral ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->jurusan_doktoral ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->lulus_doktoral ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->org_pengusul ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->rek_pakar1 ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->rek_pakar2 ?? 'Belum diisi' }}</td>
                                                <td>{{ $d->userFiles->rek_pakar3 ?? 'Belum diisi' }}</td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <!-- Flash Message -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <!-- Modal Tambah Data -->
                                <div class="modal fade @if ($errors->any()) show @endif" id="tambahDataModal"
                                    tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true"
                                    style="@if ($errors->any()) display:block; @endif">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Pengguna</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                <form action="{{ route('store') }}" method="POST">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user-alt"></i></span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="username" name="name" value="{{ old('name') }}"
                                                            required placeholder="nama">
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-edit"></i></span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            id="username" name="username" value="{{ old('username') }}"
                                                            required placeholder="username">

                                                        @error('username')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-wind"></i></span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control @error('nik') is-invalid @enderror"
                                                            id="nik" name="nik" value="{{ old('nik') }}"
                                                            required placeholder="nik">
                                                        @error('nik')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror

                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-envelope"></i></span>
                                                        </div>

                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" name="email" value="{{ old('email') }}"
                                                            required placeholder="email">
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-rocket"></i></span>
                                                        </div>
                                                        <select class="form-control @error('role') is-invalid @enderror"
                                                            id="role" name="role" required>
                                                            <option value="administrator"
                                                                {{ old('role') == 'administrator' ? 'selected' : '' }}>
                                                                Administrator</option>
                                                            <option value="verifikator"
                                                                {{ old('role') == 'verifikator' ? 'selected' : '' }}>
                                                                Verifikator</option>
                                                            <option value="user"
                                                                {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                                        </select>
                                                        @error('role')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror

                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-lock"></i></span>
                                                        </div>
                                                        <input type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="password" name="password" required
                                                            placeholder="password">
                                                        @error('password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Script untuk Membuka Modal Jika Ada Error -->
                                @if ($errors->any())
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var myModal = new bootstrap.Modal(document.getElementById('tambahDataModal'));
                                            myModal.show();
                                        });
                                    </script>
                                @endif

                            </div>
                            <!-- Modal Edit Data -->
                            <div class="modal fade" id="editDataModal" tabindex="-1"
                                aria-labelledby="editDataModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDataModalLabel">Edit Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="edit_nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="edit_nama"
                                                        name="nama" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="edit_username"
                                                        name="username" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_nik" class="form-label">NIK</label>
                                                    <input type="text" class="form-control" id="edit_nik"
                                                        name="nik" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="edit_email"
                                                        name="email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_role" class="form-label">Role</label>
                                                    <select class="form-control" id="edit_role" name="role" required>
                                                        <option value="administrator">Administrator</option>
                                                        <option value="verifikator">Verifikator</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteConfirmModal" tabindex="-1"
                                aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus <strong id="delete_nama"></strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger"
                                                id="confirmDelete">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
@endsection
