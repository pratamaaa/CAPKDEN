@extends('layout/dashadmin')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Pengumuman</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="card" style="padding:15px">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
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
                                            <th>Nama Pengumuman</th>
                                            <th>File</th>
                                            <th>Tanggal Upload</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengumumanPdfs as $index => $pengumuman)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengumuman->title }}</td>
                                                <td>
                                                    @if ($pengumuman->file_path)
                                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#pdfModal"
                                                            data-pdf="{{ asset('storage/' . $pengumuman->file_path) }}">
                                                            Lihat Dokumen
                                                        </a>
                                                    @else
                                                        Tidak ada file
                                                    @endif
                                                </td>
                                                <td>{{ $pengumuman->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-pengumuman-btn"
    data-id="{{ $pengumuman->id }}"
    data-title="{{ $pengumuman->title }}"
    data-pdf="{{ asset('storage/' . $pengumuman->file_path) }}"
    data-toggle="modal" data-target="#editPengumumanModal">
    <i class="fas fa-edit"></i>
</button>

                                                    <button class="btn btn-sm btn-danger delete-pengumuman-btn"
                                                        data-id="{{ $pengumuman->id }}"
                                                        data-title="{{ $pengumuman->title }}" data-toggle="modal"
                                                        data-target="#deletePengumumanModal">
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

                                <!-- Modal untuk Menampilkan PDF -->
                                <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="pdfModalLabel">Lihat Dokumen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <iframe id="pdfViewer" src="" width="100%" height="600px"
                                                    style="border: none;"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Script untuk melihat PDF di Modal -->
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        var pdfModal = document.getElementById("pdfModal");
                                        pdfModal.addEventListener("show.bs.modal", function(event) {
                                            var button = event.relatedTarget; // Tombol yang diklik
                                            var pdfUrl = button.getAttribute("data-pdf"); // Ambil URL PDF
                                            var modalIframe = document.getElementById("pdfViewer");
                                            modalIframe.src = pdfUrl; // Tampilkan PDF di iframe
                                        });
                                    });
                                </script>
                                <!-- Modal Tambah Data -->
                                <div class="modal fade @if ($errors->any()) show @endif" id="tambahDataModal"
                                    tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true"
                                    style="@if ($errors->any()) display:block; @endif">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Pengumuman</h5>
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


                                                <form action="{{ route('pengumuman.upload') }}" method="POST"
                                                    enctype="multipart/form-data">

                                                    @csrf

                                <!-- Input Judul -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                            id="title" name="title" value="{{ old('title') }}"
                                                            required placeholder="Judul Pengumuman">
                                                        @error('title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                </div>

                                                    <!-- Input File -->
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                        <input type="file" name="file_path"
                                                            class="form-control @error('file_path') is-invalid @enderror"
                                                            accept="application/pdf" required>
                                                        @error('file_path')
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
                                            var myModal = new bootstrap.Modal(document.getElementById('tambahDataModal'));
                                            myModal.show();
                                        });
                                    </script>
                                @endif

                            </div>

                            <div class="modal fade" id="editPengumumanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('pengumuman.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-pengumuman-id">

                    <div class="form-group">
                        <label for="edit-pengumuman-title">Judul Pengumuman</label>
                        <input type="text" name="title" id="edit-pengumuman-title"
                            class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label>Preview Dokumen:</label>
                        <iframe id="edit-pdf-preview" src="" width="100%" height="300px" style="border:1px solid #ccc;"></iframe>
                    </div>

                    <div class="form-group mt-3">
                        <label for="edit-file">Ganti Dokumen (opsional)</label>
                        <input type="file" name="file_path" id="edit-file" class="form-control"
                            accept="application/pdf">
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
        const editButtons = document.querySelectorAll('.edit-pengumuman-btn');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
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
