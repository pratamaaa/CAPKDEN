@extends('layout/dashadmin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Input Hasil Assesment</h1>
                    </div>
                </div>

                <div class="card p-3">
                    <div class="card-body table-responsive p-0" style="overflow-x: auto;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2" style="width: 25px;">No</th>
                                    <th rowspan="2">Foto</th>
                                    <th rowspan="2" style="width: 250px;">Nama</th>
                                    <th rowspan="2">Calon Kalangan</th>
                                    <th rowspan="2">Status Assesment</th>
                                    <th rowspan="2">Keterangan</th>
                                    <th rowspan="2">Last Update</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($data as $nourut => $pel)
                                    @php
                                        $dok = $pel->userFiles;

                                        $warna_verifikasi = match (true) {
                                            ($dok?->assessment_status ?? 'menunggu') === 'menunggu' => 'primary',
                                            ($dok?->assessment_status ?? 'gagal') === 'lulus' => 'success',
                                            default => 'danger',
                                        };

                                        $profile = $pel->userProfile;

                                        $gelardepan =
                                            $profile && $profile->gelar_depan && $profile->gelar_depan !== '-'
                                                ? $profile->gelar_depan . ' '
                                                : '';
                                        $gelarbelakang =
                                            $profile && $profile->gelar_belakang && $profile->gelar_belakang !== '-'
                                                ? ', ' . $profile->gelar_belakang
                                                : '';
                                    @endphp

                                    <tr>
                                        <td>{{ $nourut + 1 }}</td>

                                        {{-- Foto --}}
                                        <td class="text-center">
                                            @if ($profile?->pas_foto)
                                                <img src="{{ asset('uploads/pas_foto/' . $profile->pas_foto) }}"
                                                    width="100">
                                            @else
                                                <span class="badge bg-danger">Belum diisi</span>
                                            @endif
                                        </td>

                                        {{-- Nama + Gelar --}}
                                        <td>
                                            {{ $gelardepan . $pel->name . $gelarbelakang }}
                                        </td>

                                        {{-- Kalangan --}}
                                        <td>{{ $profile?->kalangan ?? '-' }}</td>

                                        {{-- Status Assesment --}}
                                        <td class="text-center">
                                            <span class="badge bg-{{ $dok ? $warna_verifikasi : 'secondary' }}">
                                                {{ $dok->assessment_status ?? '-' }}
                                            </span>
                                        </td>

                                        {{-- Catatan Assesment --}}
                                        <td class="text-center">
                                            @if ($dok?->verified_by)
                                                <span class="badge bg-warning">
                                                    {{ Bantuan::get_verifikator($dok->verified_by)->name }}
                                                </span>
                                                <hr style="margin-top: 5px; margin-bottom: 2px;">
                                                {{ $dok->assessment_catatan ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        {{-- Tanggal Update --}}
                                        <td class="text-center">
                                            {{ $pel->updated_at ? $pel->updated_at->format('d-m-Y H:i') : '-' }}
                                        </td>

                                        {{-- Aksi Edit --}}
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm"
                                                onclick="assesmentModal({{ $pel->id }})" data-bs-toggle="modal"
                                                data-bs-target="#modalassesment">
                                                <i class="fas fa-check"></i>
                                            </button>

                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="16" class="text-center">Data tidak tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Input Nilai Wawancara -->
    <div class="modal fade" id="modalassesment" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('assesment.store') }}">
                @csrf
                <input type="hidden" name="user_id" id="input-user-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Status Assesment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Status Assesment</label>
                            <select name="assessment_status" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Lulus">Lulus</option>
                                <option value="Tidak Lulus">Tidak Lulus</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Keterangan</label>
                            <textarea name="assessment_catatan" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function assesmentModal(userId) {
            $('#input-user-id').val(userId);
            $('#modalassesment').modal('show');
        }
    </script>

@endsection
