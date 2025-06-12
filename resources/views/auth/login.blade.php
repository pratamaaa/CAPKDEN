@extends('layout/main')
@section('content')

    <div class="container">

        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card p-5" style="width: 600px;background-image: url({{ asset('bs/assets/images/blog-left-dec.jpg') }}) !important;box-shadow: 0px 0px 15px rgba(0,0,0,0.4);">
                <h3 class="text-center mb-4">Login</h3>

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

                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="identifier"
                            class="form-control @error('identifier') is-invalid @enderror" id="identifier"
                            value="{{ old('identifier') }}" placeholder="Username / NIK" required>
                        {{-- Menampilkan error untuk identifier --}}
                        @error('identifier')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Password" required>

                        {{-- Menampilkan error untuk password --}}
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check"></div>
                        <a href="{{ route('reset-password.form') }}" class="auth-link text-black">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Halaman Login</button>
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                </form>

                {{-- <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="{{ url('/registrasi') }}">Daftar di sini</a></small> --}}
                </div>
            </div>
        </div>
    </div>

@endsection
