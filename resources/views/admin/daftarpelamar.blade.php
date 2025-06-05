@extends('layout/dashadmin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pelamar</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" style="padding:15px">

                        <div class="card-body table-responsive p-0" style="overflow-x: auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="header-row">
                                        <th class="align-top text-center" rowspan="2">Status Update</th>
                                        <th class="align-top text-center" rowspan="2">No</th>
                                        <th class="align-top text-center" rowspan="2">Foto</th>
                                        <th class="align-top text-center" rowspan="2" style="width: 250px;">Nama</th>
                                        <th class="align-top text-center" rowspan="2">Calon Kalangan</th>
                                        <th class="align-top text-center" rowspan="2">No. Handphone</th>
                                        <th class="align-top text-center" rowspan="2">Status Submit Data</th>
                            
                                        <!-- Header Pendidikan -->
                                        <th class="align-top text-center" colspan="3">Pendidikan</th>
                            
                                        <!-- Header Pengusul Calon Kalangan -->
                                        <th class="align-top text-center" colspan="4">Pengusul Calon Kalangan</th>
                                        
                                        <th class="align-top text-center" rowspan="2">Aksi</th>
                                    </tr>
                                    <tr class="header-row">
                                        <!-- Pendidikan -->
                                        <th class="align-top text-center" style="width: 200px;">Sarjana</th>
                                        <th class="align-top text-center" style="width: 200px;">Magister</th>
                                        <th class="align-top text-center" style="width: 200px;">Doktoral</th>
                            
                                        <!-- Pengusul Calon Kalangan -->
                                        <th class="align-top text-center">Organisasi Pengusul</th>
                                        <th class="align-top text-center">Rekomendasi Pakar-1</th>
                                        <th class="align-top text-center">Rekomendasi Pakar-2</th>
                                        <th class="align-top text-center">Rekomendasi Pakar-3</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
@if ($data->count())
    @foreach ($data as $nourut => $pel)
        @php
            $isUpdated = false;
            $batasTanggal = \Carbon\Carbon::parse('2025-05-27 23:59:59');

            $pelamardok = $pel->userFiles ?? collect();
            $berkas = $pelamardok->first(); // ambil satu dokumen untuk ditampilkan

            foreach ($pelamardok as $item) {
                if ($item?->updated_at && \Carbon\Carbon::parse($item->updated_at)->gt($batasTanggal)) {
                    $isUpdated = true;
                    break;
                }
            }

            $gelardepan = ($pel->userProfile?->gelar_depan && $pel->userProfile->gelar_depan != '-') ? $pel->userProfile->gelar_depan : '';
            $gelarbelakang = ($pel->userProfile?->gelar_belakang && $pel->userProfile->gelar_belakang != '-') ? $pel->userProfile->gelar_belakang : '';
            $namalengkap_pelamar = trim("{$gelardepan} {$pel->name}" . ($gelarbelakang ? ", {$gelarbelakang}" : ''));

            $statusData = $berkas?->status_data ?? null;
        @endphp

        <tr>
            <td class="text-center">
                @if (!$pel->userProfile)
                    <span class="badge bg-danger">No Profile</span>
                @elseif ($isUpdated)
                    <span class="badge bg-warning text-dark">Update</span>
                @else
                    <span class="badge bg-secondary">Tidak Update</span>
                @endif
            </td>

            <td>{{ $nourut + 1 }}</td>

            <td>
                @if ($pel->userProfile?->pas_foto)
                    <img src="{{ asset('uploads/pas_foto/' . $pel->userProfile->pas_foto) }}" width="100">
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>

            <td style="width: 250px;">{{ $namalengkap_pelamar }}</td>
            <td>{{ $pel->userProfile?->kalangan ?? '' }}</td>
            <td>{{ $pel->userProfile?->no_handphone ?? '' }}</td>

            <td class="text-center">
                @if ($statusData == 1)
                    <span class="badge bg-success">Sudah Submit</span>
                @else
                    <span class="badge bg-warning">Belum Submit</span>
                @endif
            </td>

            <td class="text-center" style="width: 200px;">
                @if ($berkas?->universitas_sarjana)
                    <strong>{{ $berkas->universitas_sarjana }}</strong>
                    {{ $berkas->jurusan_sarjana }}
                    {{ $berkas->lulus_sarjana }}
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>

            <td class="text-center" style="width: 200px;">
                @if ($berkas?->universitas_magister)
                    <strong>{{ $berkas->universitas_magister }}</strong>
                    {{ $berkas->jurusan_magister }}
                    {{ $berkas->lulus_magister }}
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>

            <td class="text-center" style="width: 200px;">
                @if ($berkas?->universitas_doktoral)
                    <strong>{{ $berkas->universitas_doktoral }}</strong>
                    {{ $berkas->jurusan_doktoral }}
                    {{ $berkas->lulus_doktoral }}
                @else
                    <span class="badge bg-danger">Belum diisi</span>
                @endif
            </td>

            <td class="text-center" style="width: 200px;">
                {{ $berkas?->org_pengusul ?? 'Belum diisi' }}
            </td>
            <td class="text-center" style="width: 200px;">
                {{ $berkas?->rek_pakar1 ?? 'Belum diisi' }}
            </td>
            <td class="text-center" style="width: 200px;">
                {{ $berkas?->rek_pakar2 ?? 'Belum diisi' }}
            </td>
            <td class="text-center" style="width: 200px;">
                {{ $berkas?->rek_pakar3 ?? 'Belum diisi' }}
            </td>

            <td>
                <button class="btn btn-primary btn-sm preview-btn" onclick="detailPelamar({{ $pel->id }})" data-bs-toggle="modal" data-bs-target="#modalpelamar">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="16" class="text-center">Data saat initidak tersedia</td>
    </tr>
@endif
</tbody>


                            </table>
                            
                            <div class="modal fade" id="modalpelamar" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div id="modalpelamar_content" class="modal-content shadow rounded-4 border-0"></div>
                                </div>
                            </div>

                        </div>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function detailPelamar(user_id){
        $('#modalpelamar').modal('show').find('#modalpelamar_content').load("{{ url('pelamardetail') }}?userid="+user_id);
    }
</script>
@endsection
