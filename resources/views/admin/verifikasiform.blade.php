<div class="modal-header">
    <h5 class="modal-title" id="verifikasiModalLabel">Verifikasi Dokumen</h5>
</div>

<form id="form-verifikasi" action="{{ route('verifikasi_saveupdate') }}" method="POST">
@csrf
<div class="modal-body">
    @php
        $dokumenList = [
            'ktp' => 'KTP/SIM/PASPOR',
            'ijazah_sarjana' => 'Ijazah Sarjana',
            // 'transkrip_sarjana' => 'Transkrip Sarjana',
            'ijazah_magister' => 'Ijazah Magister',
            // 'transkrip_magister' => 'Transkrip Magister',
            'ijazah_doktoral' => 'Ijazah Doktoral',
            // 'transkrip_doktoral' => 'Transkrip Doktoral',
            'upl_org' => 'Organisasi Pengusul',
            'upl_rek_pakar1' => 'Rekomendasi Pakar-1',
            'upl_rek_pakar2' => 'Rekomendasi Pakar-2',
            'upl_rek_pakar3' => 'Rekomendasi Pakar-3',
            'lamaran' => 'Surat Lamaran',
            'rangkap_jabatan' => 'Surat Pernyataan 3 Point',
            'cv' => 'Daftar Riwayat Hidup (CV)',
            'pidana' => 'Surat Pernyataan Tidak Sedang Dipidana',
            // 'makalah' => 'Penulisan Makalah',
            'surat_sehat' => 'Surat Keterangan Sehat',
            'skck' => 'SKCK',
            'persetujuan' => 'Surat Persetujuan Pimpinan', //tambah baru tapi tidak muncul
        ];

        $berkaspelamar = Bantuan::berkaspelamar($user_id);
    @endphp
    <label for="tmt_jabatan" class="form-label">Daftar dokumen untuk diverifikasi:</label>
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
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $label }}</td>
                        <td class="text-center">@php echo Bantuan::berkascek($user_id, $field) @endphp</td>
                        <td class="text-center">
                            @if ($berkaspelamar->count() != 0)
                                @php
                                $kolomstatus = "status_".$field;
                                $berkas_isset = $berkaspelamar->first()->$field; 
                                $berkas_status = $berkaspelamar->first()->$kolomstatus;
                                @endphp

                                @if ($berkas_isset != '')
                                    
                                    <div class="btn-group" role="group">
                                        <div class="btn-group" role="group">
                                            <input type="radio" style="width: 18px !important;margin-right: 4px;" name="status_{{ $field }}" id="terima_{{ $field }}" value="diterima" autocomplete="off" {{ $berkas_status == 'diterima' ? 'checked' : '' }}>
                                            <span class="radiolabel-success">Diterima</span>

                                            <input type="radio" style="width: 18px !important;margin-right: 4px;" class="marginleft-10" name="status_{{ $field }}" id="tolak_{{ $field }}" value="ditolak" autocomplete="off" {{ $berkas_status == 'ditolak' ? 'checked' : '' }}>
                                            <span class="radiolabel-danger">Ditolak</span>
                                        </div>
                                    </div>
                                @else
                                    <span class="badge bg-warning">NA</span>
                                @endif
                            @else
                                <span class="badge bg-warning">NA</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="tmt_jabatan" class="form-label">Status verifikasi berkas:</label>
            <select class="form form-control" id="status_verifikasi" name="status_verifikasi" style="width: 200px;">
                @if ($berkaspelamar->count() != 0)
                    <option id="menunggu" {{ $berkaspelamar->first()->administrasi_status == 'menunggu' ? 'selected' : '' }}>Perlu Didiskusikan</option>
                    <option id="lulus" {{ $berkaspelamar->first()->administrasi_status == 'lulus' ? 'selected' : '' }}>Memenuhi Syarat</option>
                    <option id="tidak lulus" {{ $berkaspelamar->first()->administrasi_status == 'tidak lulus' ? 'selected' : '' }}>Tidak Memenuhi Syarat</option>
                @endif
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="tmt_jabatan" class="form-label">Catatan verifikasi:</label>
            <textarea id="catatan" name="catatan_verifikasi" class="form form-control" rows="5">{{ $berkaspelamar->count() != 0 ? $berkaspelamar->first()->administrasi_catatan : '' }}</textarea>
        </div>
    </div>

    <input type="hidden" class="form form-control" name="user_id" value="{{ $user_id }}">
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-primary" {{ $berkaspelamar->count() == 0 ? 'disabled' : '' }}>Simpan Verifikasi</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>
</form>

<script>
    $("form").submit(function(){
        
    });
</script>
