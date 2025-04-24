@extends('layout/main')
@section('content')
    <div class="container">

        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card p-5"
                style="width: 600px;background-image: url({{ asset('bs/assets/images/blog-left-dec.jpg') }}) !important;box-shadow: 0px 0px 15px rgba(0,0,0,0.4);">
                <h3 class="text-center mb-4">Lupa Password</h3>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- Menampilkan error validasi jika ada --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Menampilkan pesan error dari session jika ada --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('reset-password.submit') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                            placeholder="Masukan Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-pencil-alt"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Masukan Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Masukan Password Baru"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Konfirmasi Password Baru" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Reset Password</button>
                    <div class="text-center mt-3">
                        <small>Kembali ke Halaman Login <a href="{{ url('/login') }}">Klik di sini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
