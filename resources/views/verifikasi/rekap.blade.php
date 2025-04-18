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
            {{-- @php
                $status_verifikasi = ((($d->userFiles->status_ktp == 'diterima' && $d->userFiles->status_ijazah_sarjana == 'diterima' && $d->userFiles->status_transkrip_sarjana == 'diterima' && $d->userFiles->status_upl_org == 'diterima' && $d->userFiles->status_upl_rek_pakar1 == 'diterima' && $d->userFiles->status_upl_rek_pakar2 == 'diterima' && $d->userFiles->status_upl_rek_pakar3 == 'diterima' && $d->userFiles->status_lamaran == 'diterima' && $d->userFiles->status_rangkap_jabatan == 'diterima' && $d->userFiles->status_cv == 'diterima' && $d->userFiles->status_pidana == 'diterima' && $d->userFiles->status_makalah == 'diterima' && $d->userFiles->status_surat_sehat == 'diterima' && $d->userFiles->status_skck == 'diterima')?'Lulus Administrasi':'Tidak Lulus Administrasi'));
            @endphp --}}
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

                        {{ trim("{$depan} {$nama}, {$belakang}", ' ,') }}
                    </td>


                    <td>{{ $d->userProfile->kalangan ?? 'Belum diisi' }}</td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->ktp;
                            $status = $d->userFiles->status_ktp;
                        @endphp --}}

                        {{-- @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @else
                            @if (!$status)
                                <span class="badge bg-warning text-dark">Belum diverifikasi</span>
                            @else
                                @php
                                    $badgeClass = match ($status) {
                                        'diterima' => 'bg-success',
                                        'ditolak' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                            @endif
                        @endif --}}
                    </td>


                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->ijazah_sarjana;
                            $status = $d->userFiles->status_ijazah_sarjana;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->transkrip_sarjana;
                            $status = $d->userFiles->status_transkrip_sarjana;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->ijazah_magister;
                            $status = $d->userFiles->status_ijazah_magister;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->transkrip_magister;
                            $status = $d->userFiles->status_transkrip_magister;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->ijazah_doktoral;
                            $status = $d->userFiles->status_ijazah_doktoral;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->transkrip_doktoral;
                            $status = $d->userFiles->status_transkrip_doktoral;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->org_pengusul;
                            $status = $d->userFiles->status_org_pengusul;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->upl_rek_pakar1;
                            $status = $d->userFiles->status_upl_rek_pakar1;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->upl_rek_pakar2;
                            $status = $d->userFiles->status_upl_rek_pakar2;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->upl_rek_pakar3;
                            $status = $d->userFiles->status_upl_rek_pakar3;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->lamaran;
                            $status = $d->userFiles->status_lamaran;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->rangkap_jabatan;
                            $status = $d->userFiles->status_rangkap_jabatan;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->cv;
                            $status = $d->userFiles->status_cv;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->pidana;
                            $status = $d->userFiles->status_pidana;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->makalah;
                            $status = $d->userFiles->status_makalah;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->surat_sehat;
                            $status = $d->userFiles->status_surat_sehat;
                        @endphp

                        @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center" style="width: 200px;">
                        {{-- @php
                            $file = $d->userFiles->skck;
                            $status = $d->userFiles->status_skck;
                            $status_file = (($file==null)?'Belum upload':$status);
                            $status_file_class = (($file==null)?'bg-danger':(($status=='belum diverifikasi')?'bg-warning':(($status=='diterima')?'bg-success':'bg-danger')));
                        @endphp --}}
{{-- <span class="badge {{ $status_file_class }}">{{ ucfirst($status_file) }}</span> --}}
                        {{-- @if (!$file)
                            <span class="badge bg-danger">Belum upload</span>
                        @elseif (!$status)
                            <span class="badge bg-warning">Belum diverifikasi</span>
                        @else
                            @php
                                $badgeClass = match ($status) {
                                    'diterima' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge" style="background-color: #ffc107; color: #000;">Belum
                                diverifikasi</span>
                        @endif --}}
                    </td>

                    <td class="text-center"></td>
                    <td class="text-center">Keterangan</td>
                    <td class="text-center">Last Update</td>
                    <td class="text-center">
                        <button class="btn btn-info btn-sm preview-btn" data-bs-toggle="modal"
                            data-bs-target="#verifikasiModal" data-nama="{{ $d->name ?? 'Belum diisi' }}"
                            data-nik="{{ $d->nik ?? 'Belum diisi' }}"
                            data-ttl="{{ ($d->tempat_lahir ?? '-') . ', ' . ($d->tanggal_lahir ?? '-') }}"
                            data-jk="{{ $d->userProfile->jenis_kelamin ?? 'Belum diisi' }}"
                            data-gelar-depan="{{ $d->userProfile->gelar_depan ?? 'Belum diisi' }}"
                            data-gelar-belakang="{{ $d->userProfile->gelar_belakang ?? 'Belum diisi' }}"
                            data-email="{{ $d->userProfile->user->email ?? 'Belum diisi' }}"
                            data-alamat="{{ $d->userProfile->alamat ?? 'Belum diisi' }}"
                            data-hp="{{ $d->userProfile->no_handphone ?? 'Belum diisi' }}"
                            data-kalangan="{{ $d->userProfile->kalangan ?? 'Belum diisi' }}"
                            data-universitas-sarjana="{{ $d->userFiles->universitas_sarjana ?? 'Belum diisi' }}"
                            data-jurusan-sarjana="{{ $d->userFiles->jurusan_sarjana ?? 'Belum diisi' }}"
                            data-lulus-sarjana="{{ $d->userFiles->lulus_sarjana ?? 'Belum diisi' }}"
                            data-ijazah-sarjana="{{ $d->userFiles->ijazah_sarjana ?? 'Belum diisi' }}"
                            data-transkrip-sarjana="{{ $d->userFiles->transkrip_sarjana ?? 'Belum diisi' }}"
                            data-universitas-magister="{{ $d->userFiles->universitas_magister ?? 'Belum diisi' }}"
                            data-jurusan-magister="{{ $d->userFiles->jurusan_magister ?? 'Belum diisi' }}"
                            data-lulus-magister="{{ $d->userFiles->lulus_magister ?? 'Belum diisi' }}"
                            data-ijazah-magister="{{ $d->userFiles->ijazah_magister ?? 'Belum diisi' }}"
                            data-transkrip-magister="{{ $d->userFiles->transkrip_magister ?? 'Belum diisi' }}"
                            data-universitas-doktoral="{{ $d->userFiles->universitas_doktoral ?? 'Belum diisi' }}"
                            data-jurusan-doktoral="{{ $d->userFiles->jurusan_doktoral ?? 'Belum diisi' }}"
                            data-lulus-doktoral="{{ $d->userFiles->lulus_doktoral ?? 'Belum diisi' }}"
                            data-ijazah-doktoral="{{ $d->userFiles->ijazah_doktoral ?? 'Belum diisi' }}"
                            data-transkrip-doktoral="{{ $d->userFiles->transkrip_doktoral ?? 'Belum diisi' }}"
                            data-org-pengusul="{{ $d->userFiles->org_pengusul ?? 'Belum diisi' }}"
                            data-upl-org="{{ $d->userFiles->upl_org ?? 'Belum diisi' }}"
                            data-rek-pakar1="{{ $d->userFiles->rek_pakar1 ?? 'Belum diisi' }}"
                            data-rek-pakar2="{{ $d->userFiles->rek_pakar2 ?? 'Belum diisi' }}"
                            data-rek-pakar3="{{ $d->userFiles->rek_pakar3 ?? 'Belum diisi' }}"
                            data-upl-rek-pakar1="{{ $d->userFiles->upl_rek_pakar1 ?? 'Belum diisi' }}"
                            data-upl-rek-pakar2="{{ $d->userFiles->upl_rek_pakar2 ?? 'Belum diisi' }}"
                            data-upl-rek-pakar3="{{ $d->userFiles->upl_rek_pakar3 ?? 'Belum diisi' }}"
                            data-surat-lamaran="{{ $d->userFiles->lamaran ?? 'Belum diisi' }}"
                            data-rangkap-jabatan="{{ $d->userFiles->rangkap_jabatan ?? 'Belum diisi' }}"
                            data-cv="{{ $d->userFiles->cv ?? 'Belum diisi' }}"
                            data-pidana="{{ $d->userFiles->pidana ?? 'Belum diisi' }}"
                            data-makalah="{{ $d->userFiles->makalah ?? 'Belum diisi' }}"
                            data-surat-sehat="{{ $d->userFiles->surat_sehat ?? 'Belum diisi' }}"
                            data-skck="{{ $d->userFiles->skck ?? 'Belum diisi' }}"
                            data-foto="{{ asset('uploads/pas_foto/' . ($d->userProfile->pas_foto ?? 'default.jpg')) }}">
                            <i class="fas fa-check-square"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Utama -->
<div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-verifikasi" action="" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="verifikasiModalLabel">Verifikasi Dokumen: <span
                            id="nama-user"></span></h5>
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
                                    <th>No</th>
                                    <th>Nama Dokumen</th>
                                    <th>Preview</th>
                                    <th>Status</th>
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
                                                <button type="button" class="btn btn-sm btn-outline-primary"
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
                                                    <input type="radio" class="btn-check"
                                                        name="status_{{ $field }}"
                                                        id="terima_{{ $field }}" value="diterima"
                                                        autocomplete="off"
                                                        {{ $currentStatus == 'diterima' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-success btn-sm"
                                                        for="terima_{{ $field }}">Terima</label>

                                                    <input type="radio" class="btn-check"
                                                        name="status_{{ $field }}"
                                                        id="tolak_{{ $field }}" value="ditolak"
                                                        autocomplete="off"
                                                        {{ $currentStatus == 'ditolak' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-danger btn-sm"
                                                        for="tolak_{{ $field }}">Tolak</label>
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
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Verifikasi</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Preview Nested -->
<div class="modal fade" id="previewModalNested" tabindex="-1" aria-labelledby="previewModalNestedLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <iframe id="previewIframe" src="" width="100%" height="600px"
                    style="border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
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
        const parentModal = new bootstrap.Modal(document.getElementById('verifikasiModal'));
        parentModal.show();
    });
</script>
