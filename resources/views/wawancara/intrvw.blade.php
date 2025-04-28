@extends('layout/dashadmin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Input Hasil Wawancara</h1>
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
                                <th colspan="2">Sikap</th>
                                <th colspan="2">Komunikasi</th>
                                <th colspan="2">Motivasi</th>
                                <th colspan="2">Kompetensi</th>
                                <th rowspan="2">Status Wawancara</th>
                                <th rowspan="2">Keterangan</th>
                                <th rowspan="2">Last Update</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr class="text-center">
                                @for ($i = 0; $i < 4; $i++)
                                    <th style="width: 25px;">Kriteria</th>
                                    <th style="width: 25px;">Nilai</th>
                                @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($data as $nourut => $pel)
                                @php
                                    // Ambil data relasi
                                    $jawaban = $pel->hasilWawancara->sortBy('pertanyaan_id')->values();
                                    $dok = $pel->userFiles;
                            
                                    // Warna badge status
                                    $warna_verifikasi = match (true) {
                                        ($dok?->wawancara_status ?? 'menunggu') === 'menunggu' => 'primary',
                                        ($dok?->wawancara_status ?? 'gagal') === 'lulus' => 'success',
                                        default => 'danger',
                                    };
                            
                                    // Cek apakah ada userProfile dulu
                                    $profile = $pel->userProfile;
                            
                                    $gelardepan = ($profile && $profile->gelar_depan && $profile->gelar_depan !== '-') ? $profile->gelar_depan . ' ' : '';
                                    $gelarbelakang = ($profile && $profile->gelar_belakang && $profile->gelar_belakang !== '-') ? ', ' . $profile->gelar_belakang : '';
                                @endphp
                            
                                <tr>
                                    <td>{{ $nourut + 1 }}</td>
                            
                                    {{-- Foto --}}
                                    <td class="text-center">
                                        @if ($profile?->pas_foto)
                                            <img src="{{ asset('uploads/pas_foto/' . $profile->pas_foto) }}" width="100">
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
                            
                                    {{-- Kriteria & Nilai Wawancara --}}
                                    @for ($i = 0; $i < 4; $i++)
                                        <td class="text-center">{{ $jawaban[$i]->kriteria ?? '-' }}</td>
                                        <td class="text-center">{{ $jawaban[$i]->nilai ?? '-' }}</td>
                                    @endfor
                            
                                    {{-- Status Wawancara --}}
                                    <td class="text-center">
                                        <span class="badge bg-{{ $dok ? $warna_verifikasi : 'secondary' }}">
                                            {{ $dok->wawancara_status ?? '-' }}
                                        </span>
                                    </td>
                            
                                    {{-- Catatan Wawancara --}}
                                    <td class="text-center">
                                        @if ($dok?->verified_by)
                                            <span class="badge bg-warning">
                                                {{ Bantuan::get_verifikator($dok->verified_by)->name }}
                                            </span>
                                            <hr style="margin-top: 5px; margin-bottom: 2px;">
                                            {{ $dok->wawancara_catatan ?? '-' }}
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
                                            onclick="intrvwModal({{ $pel->id }})"
                                            data-bs-toggle="modal" data-bs-target="#modalintrvw">
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
<div class="modal fade" id="modalintrvw" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('wawancara.store') }}">
            @csrf
            <input type="hidden" name="user_id" id="input-user-id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Nilai Wawancara</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 50px;">No</th>
                                <th>Pertanyaan</th>
                                <th style="width: 150px;">Kriteria</th>
                                <th style="width: 150px;">Nilai</th>
                            </tr>
                        </thead> <!-- TUTUP thead di sini -->
                
                        <tbody>
                            @foreach ($pertanyaan as $index => $p)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $p->pertanyaan }}</td>
                                    <td>
                                        <select name="jawaban[{{ $p->id }}][kriteria]" class="form-control kriteria-select" data-id="{{ $p->id }}" required>
                                            <option value="">Pilih</option>
                                            <option value="Tinggi">Tinggi</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Rendah">Rendah</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="jawaban[{{ $p->id }}][nilai]" id="nilai-{{ $p->id }}" class="form-control" required>
                                            <option value="">--</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                    <script>
                        const nilaiRange = {
                            "Tinggi": [...Array(98 - 86 + 1).keys()].map(i => i + 86),
                            "Sedang": [...Array(85 - 71 + 1).keys()].map(i => i + 71),
                            "Rendah": [...Array(70 - 60 + 1).keys()].map(i => i + 60)
                        };
                
                        $(document).on('change', '.kriteria-select', function () {
                            const id = $(this).data('id');
                            const kriteria = $(this).val();
                            const $nilaiSelect = $(`#nilai-${id}`);
                
                            $nilaiSelect.empty().append('<option value="">--</option>');
                            if (nilaiRange[kriteria]) {
                                nilaiRange[kriteria].forEach(n => {
                                    $nilaiSelect.append(`<option value="${n}">${n}</option>`);
                                });
                            }
                        });
                    </script>
                
                    <div class="mb-3 mt-3">
                        <label>Status Wawancara</label>
                        <select name="wawancara_status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Lulus">Lulus</option>
                            <option value="Tidak Lulus">Tidak Lulus</option>
                        </select>
                    </div>
                
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="wawancara_catatan" class="form-control" rows="3"></textarea>
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
    function intrvwModal(userId) {
        $('#input-user-id').val(userId);
        $('#modalintrvw').modal('show');
    }
</script>

@endsection
