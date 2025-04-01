@extends('layout/dashadmin')
@section('content')

    <!-- Main content -->
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Data Diri</h3>
                            </div>

                            <!-- Menampilkan pesan sukses -->
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <!-- Menampilkan error validation -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Form -->
                            <form class="form-horizontal" method="POST" action="{{ route('storeUserProfile') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama_lengkap"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}">
                                            @error('nama_lengkap')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" name="gelar_depan" class="form-control"
                                                placeholder="Gelar Depan">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" name="gelar_belakang" class="form-control"
                                                placeholder="Gelar Belakang">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">NIK</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="nik"
                                                class="form-control @error('nik') is-invalid @enderror" placeholder="NIK"
                                                value="{{ old('nik') }}">
                                            @error('nik')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="tempat_lahir" class="form-control"
                                                placeholder="Tempat Lahir">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" name="tanggal_lahir" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="jenis_kelamin">
                                                <option selected>- Pilih -</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">No. Handphone</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="no_handphone" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pas Foto (4x6)</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="pas_foto" class="form-control-file">
                                            <small class="badge bg-danger">JPEG, min 500 KB max 1 MB, latar biru</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Kalangan</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="kalangan">
                                                <option selected>- Pilih Kalangan -</option>
                                                <option value="Akademisi">Akademisi</option>
                                                <option value="Industri">Industri</option>
                                                <option value="Teknologi">Teknologi</option>
                                                <option value="Lingkungan Hidup">Lingkungan Hidup</option>
                                                <option value="Konsumen">Konsumen</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <!-- Tombol Submit -->
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#confirmModal">
                                        Update Data
                                    </button>
                                </div>

                                <!-- Modal Konfirmasi -->
                                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menyimpan perubahan data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Ya, Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
