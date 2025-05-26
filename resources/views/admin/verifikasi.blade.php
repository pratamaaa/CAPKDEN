@extends('layout/dashadmin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Verifikasi Pelamar</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card card-primary" style="padding:15px">
                                        <div class="card-body table-responsive p-0" style="overflow-x: auto;">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="header-row">
                                                        <th class="align-top text-center" rowspan="2">No</th>
                                                        <th class="align-top text-center" rowspan="2">Foto</th>
                                                        <th class="align-top text-center" rowspan="2" style="width: 250px;">Nama</th>
                                                        <th class="align-top text-center" rowspan="2">Calon Kalangan</th>
                                                        <th class="align-top text-center" colspan="15">Verifikasi Berkas</th>
                                                        <th class="align-top text-center" rowspan="2">Status Administrasi Berkas</th>
                                                        <th class="align-top text-center" rowspan="2">Keterangan</th>
                                                        <th class="align-top text-center" rowspan="2">Status Akhir</th>
                                                        <th class="align-top text-center" rowspan="2">Catatan Akhir</th>
                                                        <th class="align-top text-center" rowspan="2">Last Update</th>
                                                        <th class="align-top text-center" rowspan="3">Aksi</th>
                                                    </tr>
                                                    <tr class="header-row">
                                                        <th class="align-top text-center" style="width: 200px;">KTP</th>
                                                        <th class="align-top text-center" style="width: 200px;">Ijazah Sarjana</th>
                                                        <th class="align-top text-center" style="width: 200px;">Ijazah Magister</th>
                                                        <th class="align-top text-center" style="width: 200px;">Ijazah Doktoral</th>
                                                        <th class="align-top text-center" style="width: 200px;">Organisasi Pengusul</th>
                                                        <th class="align-top text-center" style="width: 200px;">Rekomendasi Pakar-1</th>
                                                        <th class="align-top text-center" style="width: 200px;">Rekomendasi Pakar-2</th>
                                                        <th class="align-top text-center" style="width: 200px;">Rekomendasi Pakar-3</th>
                                                        <th class="align-top text-center" style="width: 200px;">Surat Lamaran</th>
                                                        <th class="align-top text-center" style="width: 200px;">Surat Pernyataan 3 Point</th>
                                                        <th class="align-top text-center" style="width: 200px;">Daftar Riwayat Hidup</th>
                                                        <th class="align-top text-center" style="width: 200px;">Surat Tidak Ada Pidana</th>
                                                        <th class="align-top text-center" style="width: 200px;">Surat Keterangan Sehat</th>
                                                        <th class="align-top text-center" style="width: 200px;">SKCK</th>
                                                        <th class="align-top text-center" style="width: 200px;">Surat Persetujuan</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    @foreach ($data as $index => $d)
                                                    @php
                                                        $pelamardok = isset($d->userProfile) ? Bantuan::berkaspelamar($d->userProfile->user_id) : collect();
                                                        $dok = $pelamardok->first() ?? null;
                                                    @endphp
                                                    
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            @if (optional($d->userProfile)->pas_foto)
                                                                <img src="{{ asset('uploads/pas_foto/' . $d->userProfile->pas_foto) }}" width="100">
                                                            @else
                                                                <span class="badge bg-danger">Belum diisi</span>
                                                            @endif
                                                        </td>
                                                    
                                                        <td style="width: 250px;">
                                                            @php
                                                                $depan = $d->userProfile->gelar_depan ?? '';
                                                                $nama = $d->name ?? 'Belum diisi';
                                                                $belakang = $d->userProfile->gelar_belakang ?? '';
                                                            @endphp
                                                            {{ str_replace('-', '', trim("{$depan} {$nama}, {$belakang}", ' ,')) }}
                                                        </td>
                                                    
                                                        <td>{{ $d->userProfile->kalangan ?? 'Belum diisi' }}</td>
                                                    
                                                        <!-- Kolom verifikasi berkas -->
                                                        @foreach(['ktp', 'ijazah_sarjana', 'ijazah_magister', 'ijazah_doktoral', 'upl_org', 'upl_rek_pakar1', 'upl_rek_pakar2', 'upl_rek_pakar3', 'lamaran', 'rangkap_jabatan', 'cv', 'pidana', 'surat_sehat', 'skck', 'persetujuan'] as $berkas)
                                                        <td class="text-center" style="width: 200px;">
                                                            @if ($pelamardok->count() != 0)
                                                                {!! Bantuan::berkasstatus($d->userProfile->user_id, $berkas) !!}
                                                            @else
                                                                <span class="badge bg-secondary">Belum upload</span>
                                                            @endif
                                                        </td>
                                                        @endforeach
                                                    
                                                        <td class="text-center">
                                                            @if ($dok && $dok->administrasi_status)
                                                                @php
                                                                    $warna_ver = match($dok->administrasi_status) {
                                                                        'perlu didiskusikan' => 'primary',
                                                                        'memenuhi syarat' => 'success',
                                                                        default => 'danger'
                                                                    };
                                                                @endphp
                                                                <span class="badge bg-{{ $warna_ver }}">{{ $dok->administrasi_status }}</span>
                                                            @else
                                                                <span class="badge bg-secondary">-</span>
                                                            @endif
                                                        </td>
                                                    
                                                        <td class="text-center">
                                                            @if ($dok && $dok->verified_by)
                                                                <span class="badge bg-warning">
                                                                    {{ Bantuan::get_verifikator($dok->verified_by)->name }}
                                                                </span>
                                                                <hr style="margin-top: 5px;margin-bottom: 2px;">
                                                                {{ $dok->administrasi_catatan ?? '-' }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    
                                                        <td class="text-center">
                                                            @if ($dok && $dok->status_akhir)
                                                                @php
                                                                    $warna_ver = $dok->status_akhir == 'lulus' ? 'success' : 'danger';
                                                                @endphp
                                                                <span class="badge bg-{{ $warna_ver }}">{{ $dok->status_akhir }}</span>
                                                            @else
                                                                <span class="badge bg-secondary">-</span>
                                                            @endif
                                                        </td>
                                                    
                                                        <td class="text-center">
                                                            @if ($dok && $dok->verified_by)
                                                                <span class="badge bg-warning">
                                                                    {{ Bantuan::get_verifikator($dok->verified_by)->name }}
                                                                </span>
                                                                <hr style="margin-top: 5px;margin-bottom: 2px;">
                                                                {{ $dok->catatan_akhir ?? '-' }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    
                                                        <td class="text-center">
                                                            @if ($dok && $dok->verified_at)
                                                                <span style="font-size: 12px;">
                                                                    {{ $dok->verified_at }}
                                                                </span>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-primary preview-btn mb-1" 
                                                                    onclick="verifikasiBerkas({{ $d->id }})" 
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#modalverifikasi">
                                                                <i class="fas fa-check"></i> Verifikasi
                                                            </button>
                                                            
                                                            <button type="button" class="btn btn-sm btn-success" 
                                                                onclick="showStatusAkhirModal({{ $d->id }})">
                                                                <i class="fas fa-edit me-1"></i> Status Akhir
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Preview Dokumen -->
    <div class="modal fade" id="previewModalNested" tabindex="-1" aria-labelledby="previewModalNestedLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    <iframe id="previewIframe" src="" width="100%" height="600px" style="border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Verifikasi Berkas -->
    <div class="modal fade" id="modalverifikasi" tabindex="-1" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div id="modalverifikasi_content" class="modal-content shadow rounded-4 border-0"></div>
        </div>
    </div>

    <!-- Modal Status Akhir -->
    <div class="modal fade" id="modalStatusAkhir" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div id="modalStatusAkhirContent" class="modal-content"></div>
        </div>
    </div>

    <script>
        function verifikasiBerkas(user_id) {
            $('#modalverifikasi').modal('show')
                .find('#modalverifikasi_content')
                .load("{{ url('verifikasiform') }}?userid=" + user_id);
        }

        function showStatusAkhirModal(userId) {
            const modal = new bootstrap.Modal(document.getElementById('modalStatusAkhir'));
            
            fetch(`/statuskahirform?userid=${userId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    document.getElementById('modalStatusAkhirContent').innerHTML = html;
                    modal.show();
                })
                .catch(error => {
                    document.getElementById('modalStatusAkhirContent').innerHTML = `
                        <div class="modal-header">
                            <h5 class="modal-title">Error</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                Gagal memuat data: ${error.message}
                            </div>
                        </div>
                    `;
                    modal.show();
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const previewModal = document.getElementById('previewModalNested');
            const previewIframe = document.getElementById('previewIframe');
            const parentModal = document.getElementById('modalverifikasi');

            if (previewModal && previewIframe && parentModal) {
                previewModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    if (button) {
                        const fileUrl = button.getAttribute('data-file');
                        if (fileUrl) {
                            previewIframe.src = fileUrl;
                            $('#modalverifikasi').modal('hide');
                        }
                    }
                });

                previewModal.addEventListener('hidden.bs.modal', function () {
                    $('#modalverifikasi').modal('show');
                });
            }
        });
    </script>
@endsection