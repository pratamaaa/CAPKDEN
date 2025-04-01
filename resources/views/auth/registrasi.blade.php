@extends('layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card shadow p-4" style="width: 600px;">
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

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Nama Lengkap" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Password" required>
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
                                placeholder="Email Aktif" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </form>


                    <div class="text-center mt-3">
                        <small>Kembali ke Halaman Login <a href="{{ url('/login') }}">Klik di sini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
