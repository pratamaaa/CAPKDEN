@extends('layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center" style="height: 120vh;">
                <div class="card p-5" style="width: 600px;background-image: url({{ asset('bs/assets/images/blog-left-dec.jpg') }}) !important;box-shadow: 0px 0px 15px rgba(0,0,0,0.4);">
                    <h3 class="text-center mb-4">Form Pendaftaran</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" id="formDaftar">

                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Nama Lengkap" required value="{{ old('name') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username"
                                required value="{{ old('username') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-pencil-alt"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK"
                                required value="{{ old('nik') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-comment-dots"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Password (minimal 6 karakter)" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" placeholder="Ketik Ulang Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>


                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Email Aktif" required value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required value="{{ old('tempat_lahir') }}">

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">
                            Daftar
                        </button>
                        
                    </form>


                    <div class="text-center mt-3">
                        <small>Kembali ke Halaman Login <a href="{{ url('/login') }}">Klik di sini</a></small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Konfirmasi -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pendaftaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin semua data sudah benar dan ingin mendaftar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" onclick="document.getElementById('formDaftar').submit();">Ya, Daftar</button>
      </div>
    </div>
  </div>
</div>

        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                Apakah kamu yakin semua data sudah benar dan ingin mendaftar?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="document.getElementById('formDaftar').submit();">Ya, Daftar</button>
                </div>
            </div>
            </div>
        </div>
  

    </div>
@endsection
