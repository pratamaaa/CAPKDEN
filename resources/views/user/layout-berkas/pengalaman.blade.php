    <div class="card">
        <div class="card-body">
            <div class="alert alert-warning d-flex align-items-start gap-3 p-3" role="alert" style="border-radius: 8px;">
                <i class="fas fa-exclamation-triangle fa-lg text-warning mt-1"></i>
                <div>
                    <h6 class="mb-1 fw-bold text-dark">Informasi</h6>
                    <ul class="mb-0 ps-3 text-dark">
                        <li>Tuliskan minimal <strong>3 (tiga)</strong> riwayat pengalaman jabatan di bidang energi
                            setidaknya dalam <strong>10 (sepuluh)</strong> tahun terakhir.</li>
                    </ul>
                </div>
            </div>
            <h5 class="fw-bold mb-3">Riwayat Pengalaman Jabatan</h5>

            {{-- Tombol Tambah Data --}}
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPengalaman">
                + Tambah Pengalaman
            </button>

            {{-- Tabel Riwayat Pengalaman --}}
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Jabatan</th>
                        <th>Unit Kerja</th>
                        <th>TMT Jabatan</th>
                        <th>Uraian Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $user = auth()->user();
                        $experiences = $user && $user->experiences ? $user->experiences : collect();
                    @endphp

                <tbody>
                    @if ($experiences->count())
                        @foreach ($experiences as $i => $pengalaman)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengalaman->nama_jabatan }}</td>
                                <td>{{ $pengalaman->unit_kerja }}</td>
                                <td>{{ $pengalaman->tmt_jabatan }}</td>
                                <td>{{ $pengalaman->uraian_jabatan }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data pengalaman.</td>
                        </tr>
                    @endif
                </tbody>



            </table>
        </div>
    </div>

    {{-- Modal Tambah Pengalaman --}}
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
                                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                <input type="text" name="nama_jabatan" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                <input type="text" name="unit_kerja" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="tmt_jabatan" class="form-label">TMT Jabatan</label>
                                <input type="date" name="tmt_jabatan" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="uraian_jabatan" class="form-label">Uraian Jabatan</label>
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
