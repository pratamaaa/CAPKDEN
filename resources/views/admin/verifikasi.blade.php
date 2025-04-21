@extends('layout/dashadmin')
@section('content')
    <div class="content-wrapper">
        
        <div class="content-header">
            <div class="container-fluid">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        @php echo session()->get('message') @endphp
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
                                        
                                                        <!-- Header Pendidikan -->
                                                        <th class="align-top text-center" colspan="18">Verifikasi Berkas</th>
                                        
                                                        <!-- Header Aksi -->
                                        
                                                        <th class="align-top text-center" rowspan="2">Status Administrasi Berkas</th>
                                                        <th class="align-top text-center" rowspan="2">Keterangan</th>
                                                        <th class="align-top text-center" rowspan="2">Last Update</th>
                                                        <th class="align-top text-center" rowspan="2">Aksi</th>
                                                    </tr>
                                                    <tr class="header-row">
                                                        <!-- Pendidikan -->
                                                        <th class="align-top text-center" style="width: 200px;">KTP</th>
                                                        <th class="align-top text-center" style="width: 200px;">Ijazah Sarjana</th>
                                                        <th class="align-top text-center" style="width: 200px;">Transkrip Sarjana</th>
                                                        <th class="align-top text-center" style="width: 200px;">Ijazah Magister</th>
                                                        <th class="align-top text-center" style="width: 200px;">Transkrip Magister</th>
                                                        <th class="align-top text-center" style="width: 200px;">Ijazah Doktoral</th>
                                                        <th class="align-top text-center" style="width: 200px;">Transkrip Doktoral</th>
                                                        <th class="align-top text-center" style="width: 200px;">Organisasi Pengusul</th>
                                                        <th class="align-top text-center" style="width: 200px;">Rekomendasi Pakar-1</th>
                                                        <th class="align-top text-center" style="width: 200px;">Rekomendasi Pakar-2</th>
                                                        <th class="align-top text-center" style="width: 200px;">Rekomendasi Pakar-3</th>
                                                        <th class="align-top text-center" style="width: 200px;">Surat Lamaran</th>
                                                        <th class="align-top text-center" style="width: 200px;">Rangkap Jabatan</th>
                                                        <th class="align-top text-center" style="width: 200px;">Daftar Riwayat Hidup</th>
                                                        <th class="align-top text-center" style="width: 200px;">Surat Tidak Ada Pidana</th>
                                                        <th class="align-top text-center" style="width: 200px;">Penulisan Makalah</th>
                                                        <th class="align-top text-center" style="width: 200px;">Surat Keterangan Sehat</th>
                                                        <th class="align-top text-center" style="width: 200px;">SKCK</th>
                                                    </tr>
                                                </thead>
                                        
                                                <tbody>
                                                    @foreach ($data as $index => $d)
                                                        @php
                                                        $pelamardok = Bantuan::berkaspelamar($d->userProfile->user_id);
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
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'ktp') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'ijazah_sarjana') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'transkrip_sarjana') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'ijazah_magister') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'transkrip_magister') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'ijazah_doktoral') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'transkrip_doktoral') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'upl_org') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'upl_rek_pakar1') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'upl_rek_pakar2') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'upl_rek_pakar3') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'lamaran') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'rangkap_jabatan') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'cv') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'pidana') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'makalah') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'surat_sehat') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center" style="width: 200px;">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php echo Bantuan::berkasstatus($d->userProfile->user_id, 'skck') @endphp
                                                                @else
                                                                    <span class="badge bg-secondary">Belum upload</span>
                                                                @endif
                                                            </td>
                                        
                                                            <td class="text-center">
                                                                @if ($pelamardok->count() != 0)
                                                                    @php
                                                                    if ($pelamardok->first()->administrasi_status == 'menunggu'){
                                                                        $warna_ver = 'primary';
                                                                    }elseif ($pelamardok->first()->administrasi_status == 'lulus'){
                                                                        $warna_ver = 'success';
                                                                    }else{
                                                                        $warna_ver = 'danger';
                                                                    }
                                                                    @endphp
                                                                    <span class="badge bg-{{ $warna_ver }}">{{ $pelamardok->first()->administrasi_status }}</span>
                                                                @else
                                                                    <span class="badge bg-secondary">-</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($pelamardok->count() != 0 && $pelamardok->first()->verified_by != '')
                                                                    <span class="badge bg-warning">{{ Bantuan::get_verifikator($pelamardok->first()->verified_by)->name }}</span>
                                                                    <hr style="margin-top: 5px;margin-bottom: 2px;">
                                                                    {{ $pelamardok->first()->administrasi_catatan }}
                                                                @else 
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($pelamardok->count() != 0)
                                                                    <span style="font-size: 12px;">{{ $pelamardok->first()->verified_at }}</span>
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-primary btn-sm preview-btn" onclick="verifikasiBerkas({{ $d->userProfile->user_id }})" data-bs-toggle="modal" data-bs-target="#modalverifikasi">
                                                                    <i class="fas fa-check"></i>
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

    <!-- Modal Utama -->
{{-- <div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-verifikasi" action="{{ route('verifikasi.updatedokumen') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="verifikasiModalLabel">Verifikasi Dokumen2: <span id="nama-user"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    @php
                        $dokumenList = [
                            'ktp' => 'KTP/SIM/PASPOR',
                            'ijazah_sarjana' => 'Ijazah Sarjana',
                            'transkrip_sarjana' => 'Transkrip Sarjana',
                            'ijazah_magister' => 'Ijazah Magister',
                            'transkrip_magister' => 'Transkrip Magister',
                            'ijazah_doktoral' => 'Ijazah Doktoral',
                            'transkrip_doktoral' => 'Transkrip Doktoral',
                            'upl_org' => 'Organisasi Pengusul',
                            'upl_rek_pakar1' => 'Rekomendasi Pakar-1',
                            'upl_rek_pakar2' => 'Rekomendasi Pakar-2',
                            'upl_rek_pakar3' => 'Rekomendasi Pakar-3',
                            'lamaran' => 'Surat Lamaran',
                            'rangkap_jabatan' => 'Surat Pernyataan Tidak Merangkap Jabatan',
                            'cv' => 'Daftar Riwayat Hidup (CV)',
                            'pidana' => 'Surat Pernyataan Tidak Sedang Dipidana',
                            'makalah' => 'Penulisan Makalah',
                            'surat_sehat' => 'Surat Keterangan Sehat',
                            'skck' => 'SKCK',
                        ];
                    @endphp

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Dokumen</th>
                                    <th class="text-center">Preview</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokumenList as $field => $label)
                                    @php
                                        $filePath = $d->userFiles?->$field;
                                        $currentStatus = $d->userFiles?->{"status_$field"};
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $label }}</td>
                                        <td class="text-center">
                                            @if ($filePath)
                                                <button type="button" id="btnPreview" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#previewModalNested"
                                                    data-file="{{ asset('storage/' . $filePath) }}"
                                                    data-judul="{{ $label }}">
                                                    Preview
                                                </button>
                                            @else
                                                <span class="badge bg-danger">Belum upload</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($filePath)
                                                <div class="btn-group" role="group">
                                                    <input type="radio" class="btn-check" name="status_{{ $field }}" id="terima_{{ $field }}" value="diterima" autocomplete="off" {{ $currentStatus == 'diterima' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-success btn-sm" for="terima_{{ $field }}">Terima</label>

                                                    <input type="radio" class="btn-check" name="status_{{ $field }}" id="tolak_{{ $field }}" value="ditolak" autocomplete="off" {{ $currentStatus == 'ditolak' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-danger btn-sm" for="tolak_{{ $field }}">Tolak</label>
                                                </div>
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="tmt_jabatan" class="form-label">Status verifikasi berkas</label>
                            <select class="form form-control" id="status_verifikasi" name="status_verifikasi">
                                <option id="menunggu">Menunggu</option>
                                <option id="lulus">Lulus</option>
                                <option id="tidak lulus">Tidak Lulus</option>
                            </select>
                        </div>
                    </div>

                    <input type="text" class="form form-control" name="verified_by" value="{{ $d->userProfile->user_id }}">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Verifikasi</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<!-- Modal Preview Nested -->
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

<div class="modal fade" id="modalverifikasi" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="modalverifikasi_content" class="modal-content shadow rounded-4 border-0"></div>
    </div>
</div>

<script>
    function verifikasiBerkas(user_id){
        $('#modalverifikasi').modal('show').find('#modalverifikasi_content').load("{{ url('verifikasiform') }}?userid="+user_id);
    }

    $("form").submit(function(){
        alert("Submitted");
    });

    // Muat file dokumen ke modal previw
    const previewModal = document.getElementById('previewModalNested');
    previewModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const fileUrl = button.getAttribute('data-file');
        document.getElementById('previewIframe').src = fileUrl;
        const iframe = previewModal.querySelector('#previewIframe');
        iframe.src = fileUrl;

        const parentModal = document.getElementById('verifikasiModal');
        parentModal.classList.remove('show');
        parentModal.style.display = 'none';
    });

    previewModal.addEventListener('hidden.bs.modal', function() {
        const parentModal = new bootstrap.Modal(document.getElementById('modalverifikasi'));
        parentModal.show();
    });
</script>
@endsection
