@extends('layout/dashadmin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ganti Password</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @elseif (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <form method="POST" action="{{ route('user.updatePassword') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="current_password">Password Saat Ini</label>
                                        <input type="password" name="current_password" class="form-control" required>
                                        @error('current_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="new_password">Password Baru</label>
                                        <input type="password" name="new_password" class="form-control" required>
                                        @error('new_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                                        <input type="password" name="new_password_confirmation" class="form-control"
                                            required>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">Update Password</button>
                                </form>
                            </div>

                        </div>
                        <!-- /.card-header -->


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
