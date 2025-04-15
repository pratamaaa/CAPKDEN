    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Kelengkapan Berkas</h3>

        </div>

        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Menampilkan error validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="container">
            <h3 class="text-center mb-4"></h3>

            <!-- Indikator Progress -->
            <div class="progress mb-4">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" id="progress-bar">Step 1
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="uploadForm" class="form-horizontal" method="POST"action="{{ route('storeUserFiles') }}"
                enctype="multipart/form-data">
                @csrf

                {{-- STEP 1: KTP/SIM/PASPOR --}}
                <div class="step {{ $activeStep == 1 ? 'active' : '' }}" id="step-1">
                    <div class="card border-success mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">1. Upload Data KTP/SIM/PASPOR</h5>
                        </div>
                        <div class="card-body">
                            {{-- Hidden step identifier --}}
                            <input type="hidden" name="step" value="1">

                            {{-- Input file KTP/SIM/PASPOR --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Dokumen</label>
                                <div class="col-sm-6 d-flex align-items-center">
                                    <input type="file" name="ktp" accept="application/pdf"
                                        class="form-control-file" required>
                                    <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- STEP 2: Riwayat Pendidikan --}}
                <div class="step {{ $activeStep == 2 ? 'active' : '' }}" id="step-2">
                    <h5>2. Riwayat Pendidikan</h5>
                    <input type="hidden" name="step" value="2">

                    <div class="accordion mb-4" id="pendidikanAccordion">

                        {{-- S1 --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingS1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseS1" aria-expanded="true" aria-controls="collapseS1">
                                    Sarjana (S1)
                                </button>
                            </h2>
                            <div id="collapseS1" class="accordion-collapse collapse show" aria-labelledby="headingS1"
                                data-bs-parent="#pendidikanAccordion">
                                <div class="accordion-body">

                                    <div class="form-group mb-3">
                                        <label>Universitas</label>
                                        <input type="text" name="universitas_sarjana" class="form-control"
                                            value="{{ old('universitas_sarjana') }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Jurusan</label>
                                        <input type="text" name="jurusan_sarjana" class="form-control"
                                            value="{{ old('jurusan_sarjana') }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Tahun Lulus</label>
                                        <input type="text" name="lulus_sarjana" class="form-control"
                                            value="{{ old('lulus_sarjana') }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Ijazah (PDF)</label>
                                        <input type="file" name="ijazah_sarjana" accept="application/pdf"
                                            class="form-control-file">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Transkrip (PDF)</label>
                                        <input type="file" name="transkrip_sarjana" accept="application/pdf"
                                            class="form-control-file">
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- S2 --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingS2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseS2" aria-expanded="false" aria-controls="collapseS2">
                                    Magister (S2)
                                </button>
                            </h2>
                            <div id="collapseS2" class="accordion-collapse collapse" aria-labelledby="headingS2"
                                data-bs-parent="#pendidikanAccordion">
                                <div class="accordion-body">

                                    <div class="form-group mb-3">
                                        <label>Universitas</label>
                                        <input type="text" name="universitas_magister" class="form-control"
                                            value="{{ old('universitas_magister') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Jurusan</label>
                                        <input type="text" name="jurusan_magister" class="form-control"
                                            value="{{ old('jurusan_magister') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Tahun Lulus</label>
                                        <input type="text" name="lulus_magister" class="form-control"
                                            value="{{ old('lulus_magister') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Ijazah (PDF)</label>
                                        <input type="file" name="ijazah_magister" accept="application/pdf"
                                            class="form-control-file">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Transkrip (PDF)</label>
                                        <input type="file" name="transkrip_magister" accept="application/pdf"
                                            class="form-control-file">
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- S3 --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingS3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseS3" aria-expanded="false" aria-controls="collapseS3">
                                    Doktoral (S3)
                                </button>
                            </h2>
                            <div id="collapseS3" class="accordion-collapse collapse" aria-labelledby="headingS3"
                                data-bs-parent="#pendidikanAccordion">
                                <div class="accordion-body">

                                    <div class="form-group mb-3">
                                        <label>Universitas</label>
                                        <input type="text" name="universitas_doktoral" class="form-control"
                                            value="{{ old('universitas_doktoral') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Jurusan</label>
                                        <input type="text" name="jurusan_doktoral" class="form-control"
                                            value="{{ old('jurusan_doktoral') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Tahun Lulus</label>
                                        <input type="text" name="lulus_doktoral" class="form-control"
                                            value="{{ old('lulus_doktoral') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Ijazah (PDF)</label>
                                        <input type="file" name="ijazah_doktoral" accept="application/pdf"
                                            class="form-control-file">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Transkrip (PDF)</label>
                                        <input type="file" name="transkrip_doktoral" accept="application/pdf"
                                            class="form-control-file">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="step {{ $activeStep == 3 ? 'active' : '' }}" id="step-3">
                    <h5 class="mb-3">3. Pengusul Calon Kalangan</h5>
                    <input type="hidden" name="step" value="3">
                    <div class="accordion" id="accordionPengusul">

                        {{-- Organisasi Pengusul --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOrg">
                                <button class="accordion-button bg-success text-white" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOrg" aria-expanded="true"
                                    aria-controls="collapseOrg">
                                    Organisasi Pengusul
                                </button>
                            </h2>
                            <div id="collapseOrg" class="accordion-collapse collapse show"
                                aria-labelledby="headingOrg" data-bs-parent="#accordionPengusul">
                                <div class="accordion-body">
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-3 col-form-label">Nama Organisasi</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="org_pengusul" class="form-control"
                                                value="{{ old('org_pengusul') }}" onkeyup="set_pengusul(this)" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-3 col-form-label">Upload Surat Dukungan</label>
                                        <div class="col-sm-5 d-flex align-items-center">
                                            <input type="file" name="upl_org" accept="application/pdf"
                                                class="form-control-file" required>
                                            <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<script>
    function set_pengusul(ini){
        var vals = $(ini).val();
        if(vals!=''){ // ketika isi
            $('input[name="rek_pakar1"]').attr('required',true);
            $('input[name="rek_pakar2"]').removeAttr('required');
            $('input[name="rek_pakar3"]').removeAttr('required');

            $('.info_wajib1').show();
            $('.info_wajib2').hide();
            $('.info_wajib3').hide();

        }else{ // Ketika Kosong
            $('input[name="rek_pakar1"]').attr('required',true);
            $('input[name="rek_pakar2"]').attr('required',true);
            $('input[name="rek_pakar3"]').attr('required',true);

            $('.info_wajib1').show();
            $('.info_wajib2').show();
            $('.info_wajib3').show();
        }
    }
</script>
                        {{-- Pakar 1 --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPakar1">
                                <button class="accordion-button collapsed bg-light" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapsePakar1" aria-expanded="false"
                                    aria-controls="collapsePakar1">
                                    Rekomendasi Pakar-1
                                </button>
                            </h2>
                            <div id="collapsePakar1" class="accordion-collapse collapse"
                                aria-labelledby="headingPakar1" data-bs-parent="#accordionPengusul">
                                <div class="accordion-body">
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-3 col-form-label">Nama Pakar</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="rek_pakar1" class="form-control"
                                                value="{{ old('rek_pakar1') }}" required>
                                                <span class="info_wajib1 text-danger" style="display:none;">* Harus diisi</span>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-3 col-form-label">Upload Surat Rekomendasi</label>
                                        <div class="col-sm-5 d-flex align-items-center">
                                            <input type="file" name="upl_rek_pakar1" accept="application/pdf"
                                                class="form-control-file" required>
                                            <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Pakar 2 --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPakar2">
                                <button class="accordion-button collapsed bg-light" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapsePakar2" aria-expanded="false"
                                    aria-controls="collapsePakar2">
                                    Rekomendasi Pakar-2
                                </button>
                            </h2>
                            <div id="collapsePakar2" class="accordion-collapse collapse"
                                aria-labelledby="headingPakar2" data-bs-parent="#accordionPengusul">
                                <div class="accordion-body">
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-3 col-form-label">Nama Pakar</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="rek_pakar2" class="form-control"
                                                value="{{ old('rek_pakar2') }}" required>
                                                <span class="info_wajib2 text-danger" style="display:none;">* Harus diisi</span>

                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-3 col-form-label">Upload Surat Rekomendasi</label>
                                        <div class="col-sm-5 d-flex align-items-center">
                                            <input type="file" name="upl_rek_pakar2" accept="application/pdf"
                                                class="form-control-file" required>
                                            <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Pakar 3 --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPakar3">
                                <button class="accordion-button collapsed bg-light" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapsePakar3" aria-expanded="false"
                                    aria-controls="collapsePakar3">
                                    Rekomendasi Pakar-3
                                </button>
                            </h2>
                            <div id="collapsePakar3" class="accordion-collapse collapse"
                                aria-labelledby="headingPakar3" data-bs-parent="#accordionPengusul">
                                <div class="accordion-body">
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-3 col-form-label">Nama Pakar</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="rek_pakar3" class="form-control"
                                                value="{{ old('rek_pakar3') }}" required>
                                                <span class="info_wajib3 text-danger" style="display:none;">* Harus diisi</span>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-3 col-form-label">Upload Surat Rekomendasi</label>
                                        <div class="col-sm-5 d-flex align-items-center">
                                            <input type="file" name="upl_rek_pakar3" accept="application/pdf"
                                                class="form-control-file" required>
                                            <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="step {{ $activeStep == 4 ? 'active' : '' }}" id="step-4">
                    <div class="card mb-3">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">4. Dokumen Tambahan</h5>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="step" value="4">

                            {{-- Surat Lamaran --}}
                            <div class="form-group row mb-4">
                                <label class="col-sm-5 col-form-label">Surat Lamaran</label>
                                <div class="col-sm-7">
                                    <input type="file" name="lamaran" accept="application/pdf" class="form-control" required>
                                    <div class="mt-2 d-flex flex-column align-items-start">
                                        <span class="badge bg-danger mb-1">PDF, max 1MB</span>
                                        <a href="{{ asset('templates/lamaran.pdf') }}" class="text-decoration-underline text-primary small" download>
                                            Unduh Template
                                        </a>
                                    </div>
                                </div>
                            </div>             
                            
                            {{-- CV --}}
                            <div class="form-group row mb-3">
                                <label class="col-sm-5 col-form-label">Daftar Riwayat Hidup (CV)</label>
                                <div class="col-sm-5 d-flex align-items-center">
                                    <input type="file" name="cv" accept="application/pdf"
                                        class="form-control-file" required>
                                    <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                </div>
                            </div>

                            {{-- Surat Pernyataan Tidak Merangkap Jabatan --}}
                            <div class="form-group row mb-3">
                                <label class="col-sm-5 col-form-label">Surat Pernyataan Tidak Merangkap Jabatan</label>
                                <div class="col-sm-5 d-flex align-items-center">
                                    <input type="file" name="rangkap_jabatan" accept="application/pdf"
                                        class="form-control-file" required>
                                    <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                </div>
                            </div>

                            {{-- Surat Pernyataan sedang tidak menjalani proses pidana / pernah dipidana --}}
                            <div class="form-group row mb-3">
                                <label class="col-sm-5 col-form-label">Surat Pernyataan Tidak Sedang Menjalani Proses
                                    Pidana atau Pernah Dipidana Penjara Berdasarkan Putusan Pengadilan yang Telah
                                    Berkekuatan Hukum Tetap</label>
                                <div class="col-sm-5 d-flex align-items-center">
                                    <input type="file" name="pidana" accept="application/pdf"
                                        class="form-control-file" required>
                                    <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                </div>
                            </div>

                            {{-- Penulisan Makalah --}}
                            <div class="form-group row mb-3">
                                <label class="col-sm-5 col-form-label">Penulisan Makalah</label>
                                <div class="col-sm-5 d-flex align-items-center">
                                    <input type="file" name="makalah" accept="application/pdf"
                                        class="form-control-file" required>
                                    <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                </div>
                            </div>

                            {{-- Surat Keterangan Sehat Jasmani dan Rohani --}}
                            <div class="form-group row mb-3">
                                <label class="col-sm-5 col-form-label">Surat Keterangan Sehat Jasmani dan
                                    Rohani</label>
                                <div class="col-sm-5 d-flex align-items-center">
                                    <input type="file" name="surat_sehat" accept="application/pdf"
                                        class="form-control-file" required>
                                    <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                </div>
                            </div>

                            {{-- SKCK --}}
                            <div class="form-group row mb-3">
                                <label class="col-sm-5 col-form-label">SKCK</label>
                                <div class="col-sm-5 d-flex align-items-center">
                                    <input type="file" name="skck" accept="application/pdf"
                                        class="form-control-file" required>
                                    <small class="badge bg-danger ms-2">PDF, max 1MB</small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </div>
        </form>

        <!-- Tombol Navigasi -->
        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-secondary" id="prevBtn" disabled>Previous</button>
            <button class="btn btn-primary" id="nextBtn">Next</button>
        </div>

        <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-warning">
                  <h5 class="modal-title" id="confirmSubmitLabel">Konfirmasi Pengiriman</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                  Apakah Anda yakin ingin mengirimkan dokumen sekarang?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Ya, Kirim</button>
                </div>
              </div>
            </div>
          </div>
          
    </div>
    <script>
        $(document).ready(function() {
            let currentStep = 0;
            let steps = $(".step");
            let progressBar = $("#progress-bar");

            function updateStep() {
                steps.removeClass("active");
                $(steps[currentStep]).addClass("active");

                let progress = ((currentStep + 1) / steps.length) * 100;
                progressBar.css("width", progress + "%");
                progressBar.text("Step " + (currentStep + 1));

                $("#prevBtn").prop("disabled", currentStep === 0);
                $("#nextBtn").text(currentStep === steps.length - 1 ? "Submit" : "Next");
            }

            $("#nextBtn").click(function() {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    updateStep();
                } else {
                    // Tampilkan modal konfirmasi
                    $('#confirmSubmitModal').modal('show');
                }
            });

            $("#prevBtn").click(function() {
                if (currentStep > 0) {
                    currentStep--;
                    updateStep();
                }
            });

            $("#confirmSubmitBtn").click(function () {
            $("#confirmSubmitModal").modal('hide');
            $("#uploadForm").submit();
            });

            
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fileInputs = document.querySelectorAll('input[type="file"]');

            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const file = this.files[0];
                    const feedback = document.createElement("small");
                    feedback.classList.add("text-danger", "ms-2");

                    // Hapus feedback lama (jika ada)
                    const existingFeedback = this.parentNode.querySelector(".text-danger");
                    if (existingFeedback) {
                        existingFeedback.remove();
                    }

                    // Validasi: hanya PDF
                    if (file && file.type !== "application/pdf") {
                        feedback.innerText = "File harus berformat PDF.";
                        this.parentNode.appendChild(feedback);
                        this.value = ''; // Reset input
                        return;
                    }

                    // Validasi: max 1MB
                    if (file && file.size > 1024 * 1024) {
                        feedback.innerText = "Ukuran file maksimal 1MB.";
                        this.parentNode.appendChild(feedback);
                        this.value = ''; // Reset input
                        return;
                    }

                    // Tampilkan ukuran file jika valid
                    const sizeInKb = (file.size / 1024).toFixed(1);
                    const validFeedback = document.createElement("small");
                    validFeedback.classList.add("text-success", "ms-2");
                    validFeedback.innerText = `✔️ File OK (${sizeInKb} KB)`;
                    this.parentNode.appendChild(validFeedback);
                });
            });
        });
    </script>
