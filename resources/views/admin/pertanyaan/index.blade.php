@extends('layout/dashadmin')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Pertanyaan Wawancara</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="card" style="padding:15px">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target="#tambahDataPertanyaan">
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

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pertanyaan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pertanyaans as $index => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->pertanyaan }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-pengumuman-btn"
                                                        {{-- data-id="{{ $pertanyaan->id }}"
                                                        data-title="{{ $pertanyaan->title }}" data-toggle="modal" --}} data-target="#editPengumumanModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <button class="btn btn-sm btn-danger delete-pengumuman-btn"
                                                        {{-- {{-- data-id="{{ $pertanyaan->id }}"
                                                        data-title="{{ $pertanyaan->title }}" data-toggle="modal" --}} data-target="#deletePengumumanModal">
                                                        <i class="fas fa-trash"></i>
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
                                <div class="modal fade @if ($errors->any()) show @endif"
                                    id="tambahDataPertanyaan" tabindex="-1" aria-labelledby="tambahDataPertanyaanLabel"
                                    aria-hidden="true" style="@if ($errors->any()) display:block; @endif">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tambahDataPertanyaanLabel">Tambah Pertanyaan
                                                </h5>
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

                                                <form action="{{ route('pengumuman.upload') }}" method="POST">

                                                    @csrf

                                                    <!-- Input Judul -->
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                                        <input type="text"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            id="title" name="title" value="{{ old('title') }}"
                                                            required placeholder="Pertanyaan Baru" autofocus>

                                                        @error('title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Tombol Submit -->
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
                                            var myModal = new bootstrap.Modal(document.getElementById('tambahDataPertanyaan'));
                                            myModal.show();
                                        });
                                    </script>
                                @endif

                            </div>

                            <div class="modal fade" id="editPengumumanModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('pengumuman.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Pertanyaan</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="edit-pengumuman-id">

                                                <div class="form-group">
                                                    <label for="edit-pengumuman-title">Pertanyaan</label>
                                                    <input type="text" name="title" id="edit-pengumuman-title"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const editButtons = document.querySelectorAll('.edit-pengumuman-btn');

                                    editButtons.forEach(button => {
                                        button.addEventListener('click', function() {
                                            const id = this.getAttribute('data-id');
                                            const title = this.getAttribute('data-title');
                                            const pdfUrl = this.getAttribute('data-pdf');

                                            document.getElementById('edit-pengumuman-id').value = id;
                                            document.getElementById('edit-pengumuman-title').value = title;
                                            document.getElementById('edit-pdf-preview').src = pdfUrl;
                                        });
                                    });
                                });
                            </script>


                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deletePengumumanModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus Pengumuman</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form action="{{ route('pengumuman.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="delete-pengumuman-id">
                                                <p>Apakah Anda yakin ingin menghapus <b id="delete-pengumuman-title"></b>?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
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
