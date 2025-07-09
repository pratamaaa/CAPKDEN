@extends('layout/dashadmin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Pelamar</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="padding:15px">
                            <div class="card-body table-responsive p-0" style="overflow-x: auto;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="header-row">
                                            <th class="align-top text-center" rowspan="2">No</th>
                                            <th class="align-top text-center" rowspan="2">Foto</th>
                                            <th class="align-top text-center" rowspan="2" style="width: 250px;">Nama</th>
                                            <th class="align-top text-center" rowspan="2" style="width: 250px;">NIK</th>
                                            <th class="align-top text-center" rowspan="2">Calon Kalangan</th>
                                            <th class="align-top text-center" rowspan="2">No. Handphone</th>
                                            <th class="align-top text-center" rowspan="2">Email</th>

                                            <!-- Header Pengusul Calon Kalangan -->
                                            {{-- <th class="align-top text-center" colspan="4">Pengusul Calon Kalangan</th> --}}
                                            <!-- Header Pendidikan -->
                                            <th class="align-top text-center" colspan="3">Pendidikan</th>

                                            <!-- Header Pengalaman Kerja -->
                                            <th class="align-top text-center" colspan="3">Pengalaman Kerja Terakhir</th>
                                        </tr>

                                        <tr class="header-row">
                                            <!-- Pendidikan -->
                                        <th class="align-top text-center" style="width: 200px;">Sarjana</th>
                                        <th class="align-top text-center" style="width: 200px;">Magister</th>
                                        <th class="align-top text-center" style="width: 200px;">Doktoral</th>
                                            <!-- Sub-header Pengusul Calon Kalangan -->
                                            {{-- <th class="align-top text-center">Organisasi Pengusul</th>
                                            <th class="align-top text-center">Rekomendasi Pakar-1</th>
                                            <th class="align-top text-center">Rekomendasi Pakar-2</th>
                                            <th class="align-top text-center">Rekomendasi Pakar-3</th> --}}

                                            <!-- Sub-header Pengalaman Kerja -->
                                            <th class="align-top text-center">Jabatan</th>
                                            <th class="align-top text-center">Unit Kerja</th>
                                            <th class="align-top text-center">TMT Jabatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    @forelse ($data as $nourut => $pel)
        @php
            $experiences = $pel->userExperiences->sortByDesc('tmt_jabatan');
            $rowspan = max($experiences->count(), 1);

            $gelardepan = $pel->userProfile?->gelar_depan !== '-' ? $pel->userProfile?->gelar_depan : '';
            $gelarbelakang = $pel->userProfile?->gelar_belakang !== '-' ? $pel->userProfile?->gelar_belakang : '';
            $namalengkap = trim("{$gelardepan} {$pel->name}" . ($gelarbelakang ? ", {$gelarbelakang}" : ''));
            $berkaspelamar = \App\Helpers\Bantuan::berkaspelamar($pel->id)->first();
        @endphp

        {{-- Baris pertama --}}
        <tr>
            <td rowspan="{{ $rowspan }}">{{ $nourut + 1 }}</td>
            <td rowspan="{{ $rowspan }}">
                @if ($pel->userProfile?->pas_foto)
                    <img src="{{ asset('uploads/pas_foto/' . $pel->userProfile->pas_foto) }}" width="100">
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>
            <td rowspan="{{ $rowspan }}">{{ $namalengkap }}</td>
            <td rowspan="{{ $rowspan }}">{{ $pel->nik ?? '' }}</td>
            <td rowspan="{{ $rowspan }}">{{ $pel->userProfile?->kalangan ?? '' }}</td>
            <td rowspan="{{ $rowspan }}">{{ $pel->userProfile?->no_handphone ?? '' }}</td>
            <td rowspan="{{ $rowspan }}">{{ $pel->email ?? '' }}</td>

            {{-- Pendidikan --}}
            <td rowspan="{{ $rowspan }}" class="text-center">
                @if ($berkaspelamar)
                    <strong>{{ $berkaspelamar->universitas_sarjana }}</strong><br>
                    {{ $berkaspelamar->jurusan_sarjana }}<br>
                    {{ $berkaspelamar->lulus_sarjana }}
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>
            <td rowspan="{{ $rowspan }}" class="text-center">
                @if ($berkaspelamar)
                    <strong>{{ $berkaspelamar->universitas_magister }}</strong><br>
                    {{ $berkaspelamar->jurusan_magister }}<br>
                    {{ $berkaspelamar->lulus_magister }}
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>
            <td rowspan="{{ $rowspan }}" class="text-center">
                @if ($berkaspelamar)
                    <strong>{{ $berkaspelamar->universitas_doktoral }}</strong><br>
                    {{ $berkaspelamar->jurusan_doktoral }}<br>
                    {{ $berkaspelamar->lulus_doktoral }}
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>

            {{-- Pengalaman pertama --}}
            @if ($experiences->count())
                @php $firstExp = $experiences->first(); @endphp
                <td>{{ $firstExp->nama_jabatan ?? 'Belum diisi' }}</td>
                <td>{{ $firstExp->unit_kerja ?? 'Belum diisi' }}</td>
                <td>{{ $firstExp->tmt_jabatan ? \Carbon\Carbon::parse($firstExp->tmt_jabatan)->format('d/m/Y') : 'Belum diisi' }}</td>
            @else
                <td colspan="3" class="text-center">Tidak ada pengalaman kerja</td>
            @endif
        </tr>

        {{-- Baris tambahan untuk pengalaman ke-2 dst --}}
        @foreach ($experiences->skip(1) as $exp)
            <tr>
                <td>{{ $exp->nama_jabatan ?? 'Belum diisi' }}</td>
                <td>{{ $exp->unit_kerja ?? 'Belum diisi' }}</td>
                <td>{{ $exp->tmt_jabatan ? \Carbon\Carbon::parse($exp->tmt_jabatan)->format('d/m/Y') : 'Belum diisi' }}</td>
            </tr>
        @endforeach
    @empty
        <tr>
            <td colspan="15" class="text-center">Data tidak tersedia</td>
        </tr>
    @endforelse
</tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
