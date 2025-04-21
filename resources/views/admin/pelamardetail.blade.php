<!-- Modal Header -->
<div class="modal-header bg-secondary text-white rounded-top">
    <img src="{{ asset('bs/dist/img/den.png') }}" alt="Logo DEN" style="width: 36px; height: auto; margin-right: 4px;">

    <h5 class="modal-title" id="previewModalLabel">
        <i class="fas fa-user-circle me-2"></i> Detail Pelamar
    </h5>
    <a href="{{ url('/pelamardetail_pdf') }}?userid={{ $pelamar->user_id }}" target="_blank" class="btn btn-primary" id="downloadPdfBtn">
        <i class="fas fa-download"></i> Download PDF
    </a>
</div>

<!-- Modal Body -->
<div class="modal-body p-0">
  <div class="row g-0">

    <!-- Sidebar Info -->
    <div class="col-md-4 bg-light text-dark text-center py-4 border-end">
      <img src="{{ asset('uploads/pas_foto/' . $pelamar->pas_foto) }}" class="img-thumbnail rounded-circle border mb-3 shadow-sm" style="width: 120px; height: 120px; object-fit: cover;" alt="Foto Profile">

      @php
        if ($pelamar->gelar_depan == '' || $pelamar->gelar_depan == '-'){
            $gelardepan = '';
        }else{
            $gelardepan = $pelamar->gelar_depan;
        }

        if ($pelamar->gelar_belakang == '' || $pelamar->gelar_belakang == '-'){
            $gelarbelakang = '';
        }else{
            $gelarbelakang = $pelamar->gelar_belakang;
        }

        $namalengkap_pelamar = $gelardepan.' '.$pelamar->name.', '.$gelarbelakang;
      @endphp
      <h6>{{ $namalengkap_pelamar }}</h6>
      <p class="text-muted" style="margin-top: -7px;">{{ $pelamar->kalangan }}</p>
      <hr>
      <div class="text-start px-4 small">
        <p><i class="fas fa-id-card me-2 text-muted"></i><strong>NIK</strong><br><span>{{ $pelamar->nik }}</span></p>
        <p><i class="fas fa-calendar-alt me-2 text-muted"></i><strong>TTL</strong><br><span>{{ $pelamar->tempat_lahir.', '.$pelamar->tanggal_lahir }}</span></p>
        <p><i class="fas fa-venus-mars me-2 text-muted"></i><strong>Jenis Kelamin</strong><br><span>{{ $pelamar->jenis_kelamin }}</span></p>
        <p><i class="fas fa-phone me-2 text-muted"></i><strong>No. HP</strong><br><span>{{ $pelamar->no_handphone }}</span></p>
        <p><i class="fas fa-envelope me-2 text-muted"></i><strong>Email</strong><br><span>{{ $pelamar->email }}</span></p>
        <p><i class="fas fa-map-marker-alt me-2 text-muted"></i><strong>Alamat</strong><br><span>{{ $pelamar->alamat }}</span></p>
      </div>
    </div>

    <!-- Konten Kanan -->
    <div class="col-md-8 p-4 bg-light rounded-end">
        <h5 class="mb-2 text-primary"><i class="fas fa-graduation-cap me-2"></i>Pendidikan</h5>
        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Jenjang</th>
                        <th>Universitas</th>
                        <th>Jurusan</th>
                        <th>Tahun Lulus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Sarjana</b></td>
                        <td><span>{{ ($files_check != 0) ? $pelamar->universitas_sarjana : '-'}}</span></td>
                        <td><span>{{ ($files_check != 0) ? $pelamar->jurusan_sarjana : '-'}}</span></td>
                        <td class="text-center"><span>{{ ($files_check != 0) ? $pelamar->lulus_sarjana : '-'}}</span></td>
                    </tr>
                    <tr>
                        <td><b>Magister</b></td>
                        <td><span>{{ ($files_check != 0) ? $pelamar->universitas_magister : '-'}}</span></td>
                        <td><span>{{ ($files_check != 0) ? $pelamar->jurusan_magister : '-'}}</span></td>
                        <td class="text-center"><span>{{ ($files_check != 0) ? $pelamar->lulus_magister : '-'}}</span></td>
                    </tr>
                    <tr>
                        <td><b>Doktoral</b></td>
                        <td><span>{{ ($files_check != 0) ? $pelamar->universitas_doktoral : '-'}}</span></td>
                        <td><span>{{ ($files_check != 0) ? $pelamar->jurusan_doktoral : '-'}}</span></td>
                        <td class="text-center"><span>{{ ($files_check != 0) ? $pelamar->lulus_doktoral : '-'}}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        <h5 class="mt-1 mb-2 text-primary"><i class="fas fa-users me-2"></i>Pengusul Calon Kalangan</h5>
        <div class="table-responsive">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <th class="w-50">Organisasi Pengusul</th>
                        <td><span>{{ ($files_check != 0) ? $pelamar->org_pengusul : '-'}}</span></td>
                    </tr>
                    <tr>
                        <th>Rekomendasi Pakar-1</th>
                        <td><span>{{ ($files_check != 0) ? $pelamar->rek_pakar1 : '-'}}</span></td>
                    </tr>
                    <tr>
                        <th>Rekomendasi Pakar-2</th>
                        <td><span>{{ ($files_check != 0) ? $pelamar->rek_pakar2 : '-'}}</span></td>
                    </tr>
                    <tr>
                        <th>Rekomendasi Pakar-3</th>
                        <td><span>{{ ($files_check != 0) ? $pelamar->rek_pakar3 : '-'}}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h5 class="mt-1 mb-2 text-primary"><i class="fas fa-users me-2"></i>Pengalaman</h5>
        <div class="table-responsive">
            <table class="table table-sm">
                <tbody>
                    @if ($pengalaman->count() != 0)
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        @foreach ($pengalaman->get() as $idx => $pe)
                            <tr>
                                <td>{{ $idx+1 }}</td>
                                <td>{{ $pe->nama_jabatan }}</td>
                                <td>{{ $pe->unit_kerja }}</td>
                                <td>{{ $pe->tmt_jabatan }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="4">-</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>