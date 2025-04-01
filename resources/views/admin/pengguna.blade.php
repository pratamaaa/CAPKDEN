@extends('layout/dashadmin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Pengguna</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target="#tambahDataModal">
                                    Tambah Data
                                </button>


                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 250px;">

                                        <input type="text" id="searchInput" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>NIK</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->name }}</td>
                                                <td>{{ $d->username }}</td>
                                                <td>{{ $d->nik }}</td>
                                                <td>{{ $d->email }}</td>
                                                <td>{{ $d->role }}</td>
                                                <td>
                                                    <button class="btn btn-primary editButton" data-id="{{ $d->id }}"
                                                        data-nama="{{ $d->name }}" data-username="{{ $d->username }}"
                                                        data-nik="{{ $d->nik }}" data-email="{{ $d->email }}"
                                                        data-role="{{ $d->role }}" data-bs-toggle="modal"
                                                        data-bs-target="#editDataModal">
                                                        <i class="fas fa-pen"></i>
                                                    </button>

                                                    <button class="btn btn-danger deleteButton"
                                                        data-id="{{ $d->id }}" data-nama="{{ $d->name }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
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
