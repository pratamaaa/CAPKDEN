{{-- Notifikasi SweetAlert --}}
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

<div class="card">
    <div class="card-body">
        {{-- Informasi --}}
        <div class="alert alert-warning d-flex align-items-start gap-3 p-3" role="alert" style="border-radius: 8px;">
            <i class="fas fa-exclamation-triangle fa-lg text-warning mt-1"></i>
            <div>
                <h6 class="mb-1 fw-bold text-dark">Informasi</h6>
                <ul class="mb-0 ps-3 text-dark">
                    <li>
                        Tuliskan minimal <strong>3 (tiga)</strong> riwayat pengalaman jabatan di bidang energi
                        setidaknya dalam <strong>10 (sepuluh)</strong> tahun terakhir.
                    </li>
                </ul>
            </div>
        </div>

        <h5 class="fw-bold mb-3">Riwayat Pengalaman Jabatan</h5>

        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPengalaman"
            {{ $userFiles != null && $userFiles->status_data == 1 ? 'disabled' : '' }}>
            <i class="fa fa-plus" aria-hidden="true"></i> Tambah Pengalaman
            {{ $userFiles != null && $userFiles->status_data == 1 ? '(Berkas Sudah Di Submit)' : '' }}
        </button>

        {{-- Tabel --}}
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Unit Kerja</th>
                    <th>TMT Jabatan</th>
                    <th>Uraian Jabatan</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $experiences = auth()->user()?->experiences ?? collect();
                @endphp

                @if ($experiences->count())
                    @foreach ($experiences as $pengalaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengalaman->nama_jabatan }}</td>
                            <td>{{ $pengalaman->unit_kerja }}</td>
                            <td>{{ $pengalaman->tmt_jabatan }}</td>
                            <td>{{ $pengalaman->uraian_jabatan }}</td>
                            <td>
                                
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalEditPengalaman{{ $pengalaman->id }}">
                                    <i class="fas fa-pen"></i>
                                </button>

                                
                                <form action="{{ route('pengalaman.destroy', $pengalaman->id) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus pengalaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="modalEditPengalaman{{ $pengalaman->id }}" tabindex="-1"
                            aria-labelledby="modalEditPengalamanLabel{{ $pengalaman->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('pengalaman.update', $pengalaman->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Pengalaman Kerja</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label class="form-label">Nama Jabatan</label>
                                                    <input type="text" name="nama_jabatan" class="form-control"
                                                        value="{{ $pengalaman->nama_jabatan }}" required>
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">Unit Kerja</label>
                                                    <input type="text" name="unit_kerja" class="form-control"
                                                        value="{{ $pengalaman->unit_kerja }}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label class="form-label">TMT Jabatan</label>
                                                    <input type="date" name="tmt_jabatan" class="form-control"
                                                        value="{{ $pengalaman->tmt_jabatan }}" required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Uraian Jabatan</label>
                                                <textarea name="uraian_jabatan" class="form-control" rows="4" required>{{ $pengalaman->uraian_jabatan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                        <td colspan="6" class="text-center text-muted">Belum ada data pengalaman.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambahPengalaman" tabindex="-1" aria-labelledby="modalTambahPengalamanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('pengalaman.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengalaman Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Unit Kerja</label>
                            <input type="text" name="unit_kerja" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">TMT Jabatan</label>
                            <input type="date" name="tmt_jabatan" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Uraian Jabatan</label>
                        <textarea name="uraian_jabatan" class="form-control" rows="4" required></textarea>
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
