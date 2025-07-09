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
  <tr>
    <th class="text-center">No</th>
    <th class="text-center">Foto</th>
    <th class="text-center" style="width: 250px;">Nama</th>
    <th class="text-center" style="width: 250px;">NIK</th>
    <th class="text-center">Calon Kalangan</th>
    <th class="text-center">No. Handphone</th>
    <th class="text-center">Email</th>

    {{-- Pendidikan --}}
    <th class="text-center" style="width: 200px;">Sarjana</th>
    <th class="text-center" style="width: 200px;">Magister</th>
    <th class="text-center" style="width: 200px;">Doktoral</th>

    {{-- Pengalaman kerja --}}
    <th class="text-center">Pengalaman</th>
  </tr>
</thead>

                                    <tbody>
    @forelse ($data as $nourut => $pel)
        @php
            $experiences = $pel->userExperiences->sortByDesc('tmt_jabatan');
            $gelardepan = $pel->userProfile?->gelar_depan !== '-' ? $pel->userProfile?->gelar_depan : '';
            $gelarbelakang = $pel->userProfile?->gelar_belakang !== '-' ? $pel->userProfile?->gelar_belakang : '';
            $namalengkap = trim("{$gelardepan} {$pel->name}" . ($gelarbelakang ? ", {$gelarbelakang}" : ''));
            $berkaspelamar = \App\Helpers\Bantuan::berkaspelamar($pel->id)->first();
        @endphp

        <tr>
            <td>{{ $nourut + 1 }}</td>
            <td>
                @if ($pel->userProfile?->pas_foto)
                    <img src="{{ asset('uploads/pas_foto/' . $pel->userProfile->pas_foto) }}" width="100">
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>
            <td>{{ $namalengkap }}</td>
            <td>{{ $pel->nik ?? '-' }}</td>
            <td>{{ $pel->userProfile?->kalangan ?? '-' }}</td>
            <td>{{ $pel->userProfile?->no_handphone ?? '-' }}</td>
            <td>{{ $pel->email ?? '-' }}</td>

            {{-- Pendidikan --}}
            <td class="text-center">
                @if ($berkaspelamar)
                    <strong>{{ $berkaspelamar->universitas_sarjana }}</strong><br>
                    {{ $berkaspelamar->jurusan_sarjana }}<br>
                    {{ $berkaspelamar->lulus_sarjana }}
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>
            <td class="text-center">
                @if ($berkaspelamar)
                    <strong>{{ $berkaspelamar->universitas_magister }}</strong><br>
                    {{ $berkaspelamar->jurusan_magister }}<br>
                    {{ $berkaspelamar->lulus_magister }}
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>
            <td class="text-center">
                @if ($berkaspelamar)
                    <strong>{{ $berkaspelamar->universitas_doktoral }}</strong><br>
                    {{ $berkaspelamar->jurusan_doktoral }}<br>
                    {{ $berkaspelamar->lulus_doktoral }}
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>

            {{-- Pengalaman kerja dalam satu kolom --}}
            <td colspan="3">
                @if ($experiences->isNotEmpty())
                    <ol class="mb-0 ps-3">
                        @foreach ($experiences as $i => $exp)
                            <li>
                                <strong>{{ $exp->nama_jabatan ?? 'Belum diisi' }}</strong><br>
                                {{ $exp->unit_kerja ?? 'Belum diisi' }}<br>
                                {{ $exp->tmt_jabatan ? \Carbon\Carbon::parse($exp->tmt_jabatan)->format('d/m/Y') : 'Belum diisi' }}
                            </li>
                        @endforeach
                    </ol>
                @else
                    <span class="badge bg-warning text-dark">Tidak ada pengalaman</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="14" class="text-center">Data tidak tersedia</td>
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
