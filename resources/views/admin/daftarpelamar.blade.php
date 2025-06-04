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
                                    
    @if ($data->count() != 0)
        @foreach ($data as $nourut => $pel)
            <tr>
                @php
                 $pelamardok = isset($d->userProfile)
                 ? Bantuan::berkaspelamar($d->userProfile->user_id): collect();
                @endphp
                 @php
        $isUpdated = $pelamardok->filter(function($item) {
            return \Carbon\Carbon::parse($item->updated_at)->gt('2025-05-27');
        })->count() > 0;
    @endphp
                <td class="text-center">
                    @if ($pelamardok->count() > 0 && $pelamardok->where('updated_at', '>', '2025-05-27')->count() > 0)
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
                <td style="width: 250px;">
                    @php
                        $gelardepan = ($pel->userProfile?->gelar_depan && $pel->userProfile->gelar_depan != '-') ? $pel->userProfile->gelar_depan : '';
                        $gelarbelakang = ($pel->userProfile?->gelar_belakang && $pel->userProfile->gelar_belakang != '-') ? $pel->userProfile->gelar_belakang : '';
                        $namalengkap_pelamar = trim("{$gelardepan} {$pel->name}" . ($gelarbelakang ? ", {$gelarbelakang}" : ''));
                    @endphp
                    {{ $namalengkap_pelamar }}
                </td>
                <td>{{ $pel->userProfile?->kalangan ?? '' }}</td>
                <td>{{ $pel->userProfile?->no_handphone ?? '' }}</td>
                <td class="text-center">
                    @php
                        $statusData = $pel->userFiles->status_data ?? null;
                    @endphp
                    @if ($statusData == 1)
                        <span class="badge bg-success">Sudah Submit</span>
                    @else
                        <span class="badge bg-warning">Belum Submit</span>
                    @endif
                </td>
                @php
                    $berkaspelamar = \App\Helpers\Bantuan::berkaspelamar($pel->id);
                @endphp
                <td class="text-center" style="width: 200px;">
                    @if ($berkaspelamar->count() != 0)
                        <strong>{{ $berkaspelamar->first()->universitas_sarjana }}</strong>
                        {{ $berkaspelamar->first()->jurusan_sarjana }}
                        {{ $berkaspelamar->first()->lulus_sarjana }}
                    @else
                        <span class="badge bg-danger">Belum diisi</span>
                    @endif
                </td>
                <td class="text-center" style="width: 200px;">
                    @if ($berkaspelamar->count() != 0)
                        <strong>{{ $berkaspelamar->first()->universitas_magister }}</strong>
                        {{ $berkaspelamar->first()->jurusan_magister }}
                        {{ $berkaspelamar->first()->lulus_magister }}
                    @else
                        <span class="badge bg-danger">Belum diisi</span>
                    @endif
                </td>
                <td class="text-center" style="width: 200px;">
                    @if ($berkaspelamar->count() != 0)
                        <strong>{{ $berkaspelamar->first()->universitas_doktoral }}</strong>
                        {{ $berkaspelamar->first()->jurusan_doktoral }}
                        {{ $berkaspelamar->first()->lulus_doktoral }}
                    @else
                        <span class="badge bg-danger">Belum diisi</span>
                    @endif
                </td>
                @php $berkas = $berkaspelamar->first(); @endphp

                <td class="text-center" style="width: 200px;">
                    @if ($berkas && $berkas->org_pengusul)
                        {{ $berkas->org_pengusul }}
                    @else
                        <span class="badge bg-danger">Belum diisi</span>
                    @endif
                </td>
                <td class="text-center" style="width: 200px;">
                    @if ($berkas && $berkas->rek_pakar1)
                        {{ $berkas->rek_pakar1 }}
                    @else
                        <span class="badge bg-danger">Belum diisi</span>
                    @endif
                </td>
                <td class="text-center" style="width: 200px;">
                    @if ($berkas && $berkas->rek_pakar2)
                        {{ $berkas->rek_pakar2 }}
                    @else
                        <span class="badge bg-danger">Belum diisi</span>
                    @endif
                </td>
                <td class="text-center" style="width: 200px;">
                    @if ($berkas && $berkas->rek_pakar3)
                        {{ $berkas->rek_pakar3 }}
                    @else
                        <span class="badge bg-danger">Belum diisi</span>
                    @endif
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
            <td colspan="13">Data tidak tersedia</td>
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
