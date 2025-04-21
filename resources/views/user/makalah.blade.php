@extends('layout/dashadmin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Dokumen Makalah</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-success mb-3" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahMakalah">
                                    + Tambah Makalah
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
                                            <th>Judul Makalah</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $makalahs = auth()
                                                ->user()
                                                ?->userFiles()
                                                ->whereNotNull('judul_makalah')
                                                ->get();
                                        @endphp

                                        @if ($makalahs->count())
                                            @foreach ($makalahs as $makalah)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $makalah->judul_makalah }}</td>
                                                    <td class="text-center">
                                                        @if ($makalah->makalah)
                                                            <a href="{{ asset('storage/uploads/user_files/' . $makalah->makalah) }}"
                                                                target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Preview
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $makalah->created_at->format('d-m-Y') }}</td>
                                                    <td class="text-center">
                                                        {{-- Tombol Edit --}}
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditMakalah{{ $makalah->id }}">
                                                            <i class="fas fa-pen"></i>
                                                        </button>



                                                        {{-- Tombol Hapus --}}
                                                        <form action="{{ route('upload.makalah.delete', $makalah->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus makalah ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>


                                                    </td>
                                                </tr>

                                                {{-- Modal Edit --}}
                                                <div class="modal fade" id="modalEditMakalah{{ $makalah->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{ route('upload.makalah.store') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id"
                                                                value="{{ $makalah->id }}">

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Makalah</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Judul Makalah</label>
                                                                        <input type="text" name="judul_makalah"
                                                                            class="form-control"
                                                                            value="{{ $makalah->judul_makalah }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Ganti File Makalah
                                                                            (Opsional)
                                                                        </label>
                                                                        <input type="file" name="makalah"
                                                                            accept="application/pdf" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Simpan
                                                                        Perubahan</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Belum ada makalah
                                                    diunggah.</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambahMakalah" tabindex="-1" aria-labelledby="modalTambahMakalah" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('upload.makalah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Makalah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Makalah</label>
                            <input type="text" name="judul_makalah" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload File Makalah (PDF)</label>
                            <input type="file" name="makalah" accept="application/pdf" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
