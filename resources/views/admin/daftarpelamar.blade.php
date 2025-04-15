@extends('layout/dashadmin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Pelamar</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="overflow-x: auto;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="header-row">
                                            <th class="align-top text-center" rowspan="2">No</th>
                                            <th class="align-top text-center" rowspan="2">Foto</th>
                                            <th class="align-top text-center" rowspan="2" style="width: 250px;">Nama</th>
                                            <th class="align-top text-center" rowspan="2">Calon Kalangan</th>
                                
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
                                        @foreach($data as $index => $d)
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
                                
                                            <td style="width: 200px;">
                                                @if($d->userFiles?->universitas_sarjana)
                                                    <strong>{{ $d->userFiles->universitas_sarjana }}</strong><br>
                                                    {{ $d->userFiles->jurusan_sarjana }}<br>
                                                    {{ $d->userFiles->lulus_sarjana }}
                                                @else
                                                    <span class="badge bg-danger">Belum diisi</span>
                                                @endif
                                            </td>
                                
                                            <td style="width: 200px;">
                                                @if($d->userFiles?->universitas_magister)
                                                    <strong>{{ $d->userFiles->universitas_magister }}</strong><br>
                                                    {{ $d->userFiles->jurusan_magister }}<br>
                                                    {{ $d->userFiles->lulus_magister }}
                                                @else
                                                    <span class="badge bg-danger">Belum diisi</span>
                                                @endif
                                            </td>
                                
                                            <td style="width: 200px;">
                                                @if($d->userFiles?->universitas_doktoral)
                                                    <strong>{{ $d->userFiles->universitas_doktoral }}</strong><br>
                                                    {{ $d->userFiles->jurusan_doktoral }}<br>
                                                    {{ $d->userFiles->lulus_doktoral }}
                                                @else
                                                    <span class="badge bg-danger">Belum diisi</span>
                                                @endif
                                            </td>
                                
                                            <td>{!! $d->userFiles->org_pengusul ?? '<span class="badge bg-danger">Belum diisi</span>' !!}</td>
                                            <td>{!! $d->userFiles->rek_pakar1 ?? '<span class="badge bg-danger">Belum diisi</span>' !!}</td>
                                            <td>{!! $d->userFiles->rek_pakar2 ?? '<span class="badge bg-danger">Belum diisi</span>' !!}</td>
                                            <td>{!! $d->userFiles->rek_pakar3 ?? '<span class="badge bg-danger">Belum diisi</span>' !!}</td>
                                
                                            <td>
                                                <button class="btn btn-primary btn-sm preview-btn" data-bs-toggle="modal" data-bs-target="#previewModal"
                                                    data-nama="{{ $d->name ?? 'Belum diisi' }}"
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
                                                    data-universitas-magister="{{ $d->userFiles->universitas_magister ?? 'Belum diisi' }}"
                                                    data-jurusan-magister="{{ $d->userFiles->jurusan_magister ?? 'Belum diisi' }}"
                                                    data-lulus-magister="{{ $d->userFiles->lulus_magister ?? 'Belum diisi' }}"
                                                    data-universitas-doktoral="{{ $d->userFiles->universitas_doktoral ?? 'Belum diisi' }}"
                                                    data-jurusan-doktoral="{{ $d->userFiles->jurusan_doktoral ?? 'Belum diisi' }}"
                                                    data-lulus-doktoral="{{ $d->userFiles->lulus_doktoral ?? 'Belum diisi' }}"
                                                    data-org-pengusul="{{ $d->userFiles->org_pengusul ?? 'Belum diisi' }}"
                                                    data-rek-pakar1="{{ $d->userFiles->rek_pakar1 ?? 'Belum diisi' }}"
                                                    data-rek-pakar2="{{ $d->userFiles->rek_pakar2 ?? 'Belum diisi' }}"
                                                    data-rek-pakar3="{{ $d->userFiles->rek_pakar3 ?? 'Belum diisi' }}"
                                                    data-foto="{{ asset('uploads/pas_foto/' . ($d->userProfile->pas_foto ?? 'default.jpg')) }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                
                                <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content shadow rounded-4 border-0">
                                  
                                        <!-- Modal Header -->
                                        <div class="modal-header bg-secondary text-white rounded-top">
                                            <img src="{{ asset('bs/dist/img/den.png') }}" alt="Logo DEN" style="width: 36px; height: auto; margin-right: 4px;">

                                            <h5 class="modal-title" id="previewModalLabel">
                                                <i class="fas fa-user-circle me-2"></i> Detail Pelamar
                                            </h5>
                                            <a href="" class="btn btn-primary" id="downloadPdfBtn">
                                                <i class="fas fa-download"></i> Download PDF
                                            </a>
                                          
                                        </div>
                                  
                                        <!-- Modal Body -->
                                        <div class="modal-body p-0">
                                          <div class="row g-0">
                                  
                                            <!-- Sidebar Info -->
                                            <div class="col-md-4 bg-light text-dark text-center py-4 border-end">
                                              <img id="previewFoto" src="" class="img-thumbnail rounded-circle border mb-3 shadow-sm" style="width: 120px; height: 120px; object-fit: cover;" alt="Foto Profile">
                                              <h5 id="previewNama">Nama Lengkap</h5>
                                              <p class="text-muted" id="previewKalangan">Kalangan</p>
                                              <hr>
                                              <div class="text-start px-4 small">
                                                <p><i class="fas fa-id-card me-2 text-muted"></i><strong>NIK</strong><br><span id="previewNik"></span></p>
                                                <p><i class="fas fa-calendar-alt me-2 text-muted"></i><strong>TTL</strong><br><span id="previewTtl"></span></p>
                                                <p><i class="fas fa-venus-mars me-2 text-muted"></i><strong>Jenis Kelamin</strong><br><span id="previewJk"></span></p>
                                                <p><i class="fas fa-phone me-2 text-muted"></i><strong>No. HP</strong><br><span id="previewHp"></span></p>
                                                <p><i class="fas fa-envelope me-2 text-muted"></i><strong>Email</strong><br><span id="previewEmail"></span></p>
                                                <p><i class="fas fa-map-marker-alt me-2 text-muted"></i><strong>Alamat</strong><br><span id="previewAlamat"></span></p>
                                              </div>
                                            </div>
                                  
                                            <!-- Konten Kanan -->
                                            <div class="col-md-8 p-4 bg-light rounded-end">
                                                <h5 class="mb-4 text-primary"><i class="fas fa-graduation-cap me-2"></i>Pendidikan</h5>
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
                                                                <td><span id="previewSarjanaUniv"></span></td>
                                                                <td><span id="previewSarjanaJurusan"></span></td>
                                                                <td class="text-center"><span id="previewSarjanaLulus"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Magister</b></td>
                                                                <td><span id="previewMagisterUniv"></span></td>
                                                                <td><span id="previewMagisterJurusan"></span></td>
                                                                <td class="text-center"><span id="previewMagisterLulus"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Doktoral</b></td>
                                                                <td><span id="previewDoktoralUniv"></span></td>
                                                                <td><span id="previewDoktoralJurusan"></span></td>
                                                                <td class="text-center"><span id="previewDoktoralLulus"></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            
                                                <h5 class="mt-5 mb-4 text-primary"><i class="fas fa-users me-2"></i>Pengusul Calon Kalangan</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <tbody>
                                                            <tr>
                                                                <th class="w-50">Organisasi Pengusul</th>
                                                                <td><span id="previewOrgPengusul"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Rekomendasi Pakar-1</th>
                                                                <td><span id="previewPakar1"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Rekomendasi Pakar-2</th>
                                                                <td><span id="previewPakar2"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Rekomendasi Pakar-3</th>
                                                                <td><span id="previewPakar3"></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                
                                
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        document.querySelectorAll(".preview-btn").forEach(button => {
                                            button.addEventListener("click", function () {
                                                const gelarDepan = this.getAttribute("data-gelar-depan") || '';
const nama = this.getAttribute("data-nama") || '';
const gelarBelakang = this.getAttribute("data-gelar-belakang") || '';
document.getElementById("previewNama").innerText = `${gelarDepan} ${nama} ${gelarBelakang}`.replace(/\s+/g, ' ').trim();

                                                document.getElementById("previewKalangan").innerText = this.getAttribute("data-kalangan");
                                                document.getElementById("previewNik").innerText = this.getAttribute("data-nik");
                                                document.getElementById("previewTtl").innerText = this.getAttribute("data-ttl");
                                                document.getElementById("previewJk").innerText = this.getAttribute("data-jk");
                                                document.getElementById("previewHp").innerText = this.getAttribute("data-hp");
                                                document.getElementById("previewEmail").innerText = this.getAttribute("data-email") || 'Belum diisi';

                                                document.getElementById("previewAlamat").innerText = this.getAttribute("data-alamat");
                                                document.getElementById("previewFoto").src = this.getAttribute("data-foto");
                                
                                                document.getElementById("previewSarjanaUniv").innerText = this.getAttribute("data-universitas-sarjana");
                                                document.getElementById("previewSarjanaJurusan").innerText = this.getAttribute("data-jurusan-sarjana");
                                                document.getElementById("previewSarjanaLulus").innerText = this.getAttribute("data-lulus-sarjana");
                                
                                                document.getElementById("previewMagisterUniv").innerText = this.getAttribute("data-universitas-magister");
                                                document.getElementById("previewMagisterJurusan").innerText = this.getAttribute("data-jurusan-magister");
                                                document.getElementById("previewMagisterLulus").innerText = this.getAttribute("data-lulus-magister");
                                
                                                document.getElementById("previewDoktoralUniv").innerText = this.getAttribute("data-universitas-doktoral");
                                                document.getElementById("previewDoktoralJurusan").innerText = this.getAttribute("data-jurusan-doktoral");
                                                document.getElementById("previewDoktoralLulus").innerText = this.getAttribute("data-lulus-doktoral");
                                
                                                document.getElementById("previewOrgPengusul").innerText = this.getAttribute("data-org-pengusul");
                                                document.getElementById("previewPakar1").innerText = this.getAttribute("data-rek-pakar1");
                                                document.getElementById("previewPakar2").innerText = this.getAttribute("data-rek-pakar2");
                                                document.getElementById("previewPakar3").innerText = this.getAttribute("data-rek-pakar3");
                                            });
                                        });
                                    });
                                </script>

                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
document.getElementById("downloadPdfBtn").addEventListener("click", function () {
    let { jsPDF } = window.jspdf;
    let doc = new jsPDF();

    let nama = document.getElementById("previewNama").innerText || "Calon";
    let kalangan = document.getElementById("previewKalangan").innerText || "Kalangan";
    let filename = nama.replace(/\s+/g, "_") + "_" + kalangan.replace(/\s+/g, "_") + ".pdf";

    doc.setFontSize(14);
    doc.text("Data Pelamar", 10, 10);
    doc.setFontSize(12);

    let y = 20;
    let data = [
        `Nama Lengkap: ${nama}`,
        `Calon Kalangan: ${document.getElementById("previewKalangan").innerText}`,
        `NIK: ${document.getElementById("previewNik").innerText}`,
        `TTL: ${document.getElementById("previewTtl").innerText}`,
        `Jenis Kelamin: ${document.getElementById("previewJk").innerText}`,
        `No. HP: ${document.getElementById("previewHp").innerText}`,
        `Email: ${document.getElementById("previewEmail").innerText}`,
        `Alamat: ${document.getElementById("previewAlamat").innerText}`,
        ``,
        `PENDIDIKAN`,
        `Sarjana: ${document.getElementById("previewSarjanaUniv").innerText}, ${document.getElementById("previewSarjanaJurusan").innerText}, ${document.getElementById("previewSarjanaLulus").innerText}`,
        `Magister: ${document.getElementById("previewMagisterUniv").innerText}, ${document.getElementById("previewMagisterJurusan").innerText}, ${document.getElementById("previewMagisterLulus").innerText}`,
        `Doktoral: ${document.getElementById("previewDoktoralUniv").innerText}, ${document.getElementById("previewDoktoralJurusan").innerText}, ${document.getElementById("previewDoktoralLulus").innerText}`,
        ``,
        `PENGUSUL`,
        `Organisasi Pengusul: ${document.getElementById("previewOrgPengusul").innerText}`,
        `Rekomendasi Pakar 1: ${document.getElementById("previewPakar1").innerText}`,
        `Rekomendasi Pakar 2: ${document.getElementById("previewPakar2").innerText}`,
        `Rekomendasi Pakar 3: ${document.getElementById("previewPakar3").innerText}`
    ];

    data.forEach(line => {
        doc.text(line, 10, y);
        y += 7;
    });

    doc.save(filename);
});
</script>

                            
                            </div>
                            
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
@endsection
