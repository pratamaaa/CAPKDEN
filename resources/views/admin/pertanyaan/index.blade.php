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
                                                    <button class="btn btn-sm btn-primary edit-pertanyaan-btn"
                                                        data-id="{{ $item->id }}"
                                                        data-pertanyaan="{{ $item->pertanyaan }}"
                                                        data-toggle="modal"
                                                        data-target="#editPertanyaanModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>



                                                    <button class="btn btn-sm btn-danger delete-pengumuman-btn"
            data-id="{{ $item->id }}"
            data-title="{{ $item->nama_pertanyaan }}"
            data-toggle="modal"
            data-target="#deletePertanyaanModal">
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

                                                <form action="{{ route('pertanyaan.store') }}" method="POST">

                                                    @csrf

                                                    <!-- Input Pertanyaan -->
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                                        <input type="text"
                                                            class="form-control @error('pertanyaan') is-invalid @enderror"
                                                            id="pertanyaan" name="pertanyaan" value="{{ old('pertanyaan') }}"
                                                            required placeholder="Pertanyaan Baru" autofocus>

                                                        @error('pertanyaan')
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

                            <!-- Modal Edit Pertanyaan -->
                            <div class="modal fade" id="editPertanyaanModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form id="editPertanyaanForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Pertanyaan</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="edit-pertanyaan-id">
                                                <div class="form-group">
                                                    <label for="edit-pertanyaan-text">Pertanyaan</label>
                                                    <input type="text" name="pertanyaan" id="edit-pertanyaan-text"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>                            

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const editButtons = document.querySelectorAll('.edit-pertanyaan-btn');
                                    const form = document.getElementById('editPertanyaanForm');
                            
                                    editButtons.forEach(button => {
                                        button.addEventListener('click', function () {
                                            const id = this.getAttribute('data-id');
                                            const text = this.getAttribute('data-pertanyaan');
                            
                                            document.getElementById('edit-pertanyaan-id').value = id;
                                            document.getElementById('edit-pertanyaan-text').value = text;
                            
                                            // Set action ke /pertanyaan/{id}/update
                                            form.action = `/pertanyaan/${id}/update`;
                                        });
                                    });
                                });
                            </script>
                            
                            
                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deletePertanyaanModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus Pengumuman</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form id="deletePertanyaanForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="delete-pengumuman-id">
                                                <p>Apakah Anda yakin ingin menghapus <b id="delete-pengumuman-title"></b>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                const deleteButtons = document.querySelectorAll('.delete-pengumuman-btn');
                                                const form = document.getElementById('deletePertanyaanForm');
                                        
                                                deleteButtons.forEach(button => {
                                                    button.addEventListener('click', function () {
                                                        const id = this.getAttribute('data-id');
                                                        const title = this.getAttribute('data-title');
                                        
                                                        // Set isi konfirmasi
                                                        document.getElementById('delete-pengumuman-id').value = id;
                                                        document.getElementById('delete-pengumuman-title').textContent = title;
                                        
                                                        // Ganti action form secara dinamis
                                                        form.action = `/pertanyaan/${id}`;
                                                    });
                                                });
                                            });
                                        </script>
                                        
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
