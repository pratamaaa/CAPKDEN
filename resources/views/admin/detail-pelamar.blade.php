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
                                            <th class="align-top text-center" rowspan="2">Calon Kalangan</th>
                                            <th class="align-top text-center" rowspan="2">No. Handphone</th>
                                            <th class="align-top text-center" rowspan="2">Email</th>

                                            <!-- Header Pengusul Calon Kalangan -->
                                            <th class="align-top text-center" colspan="4">Pengusul Calon Kalangan</th>

                                            <!-- Header Pengalaman Kerja -->
                                            <th class="align-top text-center" colspan="3">Pengalaman Kerja Terakhir</th>
                                        </tr>

                                        <tr class="header-row">
                                            <!-- Sub-header Pengusul Calon Kalangan -->
                                            <th class="align-top text-center">Organisasi Pengusul</th>
                                            <th class="align-top text-center">Rekomendasi Pakar-1</th>
                                            <th class="align-top text-center">Rekomendasi Pakar-2</th>
                                            <th class="align-top text-center">Rekomendasi Pakar-3</th>

                                            <!-- Sub-header Pengalaman Kerja -->
                                            <th class="align-top text-center">Jabatan</th>
                                            <th class="align-top text-center">Unit Kerja</th>
                                            <th class="align-top text-center">TMT Jabatan</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($data->count() != 0)
                                            @foreach ($data as $nourut => $pel)
                                                <tr>
                                                    <td>{{ $nourut + 1 }}</td>
                                                    <td>
                                                        @if ($pel->userProfile?->pas_foto)
                                                            <img src="{{ asset('uploads/pas_foto/' . $pel->userProfile->pas_foto) }}"
                                                                width="100">
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>
                                                    <td style="width: 250px;">
                                                        @php
                                                            $gelardepan =
                                                                $pel->userProfile?->gelar_depan &&
                                                                $pel->userProfile->gelar_depan != '-'
                                                                    ? $pel->userProfile->gelar_depan
                                                                    : '';
                                                            $gelarbelakang =
                                                                $pel->userProfile?->gelar_belakang &&
                                                                $pel->userProfile->gelar_belakang != '-'
                                                                    ? $pel->userProfile->gelar_belakang
                                                                    : '';
                                                            $namalengkap_pelamar = trim(
                                                                "{$gelardepan} {$pel->name}" .
                                                                    ($gelarbelakang ? ", {$gelarbelakang}" : ''),
                                                            );
                                                        @endphp
                                                        {{ $namalengkap_pelamar }}
                                                    </td>
                                                    <td>{{ $pel->userProfile?->kalangan ?? '' }}</td>
                                                    <td>{{ $pel->userProfile?->no_handphone ?? '' }}</td>
                                                    <td>{{ $pel->email ?? '' }}</td>

                                                    @php
                                                        $berkaspelamar = \App\Helpers\Bantuan::berkaspelamar($pel->id);
                                                        $berkas = $berkaspelamar->first();
                                                    @endphp

                                                    <td class="text-center">
                                                        @if ($berkas && $berkas->org_pengusul)
                                                            {{ $berkas->org_pengusul }}
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($berkas && $berkas->rek_pakar1)
                                                            {{ $berkas->rek_pakar1 }}
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($berkas && $berkas->rek_pakar2)
                                                            {{ $berkas->rek_pakar2 }}
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($berkas && $berkas->rek_pakar3)
                                                            {{ $berkas->rek_pakar3 }}
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>

                                                    <!-- Data Pengalaman Kerja -->
                                                    @php
                                                        $exp = $pel->userExperiences
                                                            ->sortByDesc('tmt_jabatan')
                                                            ->first();
                                                    @endphp

                                                    <td>{{ $exp?->nama_jabatan ?? 'Belum diisi' }}</td>
                                                    <td>{{ $exp?->unit_kerja ?? 'Belum diisi' }}</td>
                                                    <td>
                                                        @if ($exp?->tmt_jabatan)
                                                            {{ \Carbon\Carbon::parse($exp->tmt_jabatan)->format('d/m/Y') }}
                                                        @else
                                                            Belum diisi
                                                        @endif
                                                    </td>



                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="14">Data tidak tersedia</td>
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
@endsection
