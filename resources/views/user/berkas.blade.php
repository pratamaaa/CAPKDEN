@extends('layout/dashadmin')
@section('content')

    <!-- Main content -->
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
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
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%;"
                                        id="progress-bar">Step 1</div>
                                </div>

                                <form id="uploadForm" class="form-horizontal" method="POST"
                                    action="{{ route('storeUserFiles') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Step 1: Pendidikan -->
                                    <div class="step active">
                                        <h5>1. Upload Data KTP/SIM/PASPOR</h5>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Upload Dokumen</label>

                                            <div class="col-sm-4 d-flex align-items-center">
                                                <input type="file" name="pas_foto" class="form-control-file" required>
                                                <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Step 2: Pendidikan -->
                                    <div class="step">
                                        <h5>2. Pendidikan</h5>

                                        <div class="container">
                                            <!-- Sarjana (Tetap Aktif) -->
                                            <div class="form-group row align-items-center mb-3">
                                                <div class="col-sm-1 text-end">
                                                    <label class="badge bg-warning">Sarjana</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" name="universitas_sarjana" class="form-control"
                                                        placeholder="Universitas">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" name="jurusan_sarjana" class="form-control"
                                                        placeholder="Jurusan">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" name="tahun_lulus_sarjana" class="form-control"
                                                        placeholder="Tahun Lulus">
                                                </div>
                                                <div class="col-sm-4 d-flex gap-2">
                                                    <div class="mb-3">
                                                        <label for="formFileSm" class="form-label">Upload Ijazah</label>
                                                        <input class="form-control form-control-sm" id="formFileSm"
                                                            type="file">
                                                        <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formFileSm" class="form-label">Upload Transkrip
                                                        </label>
                                                        <input class="form-control form-control-sm" id="formFileSm"
                                                            type="file">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Checkbox untuk Magister -->
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="checkMagister">
                                                <label class="form-check-label">Isi Data Magister</label>
                                            </div>

                                            <!-- Magister -->
                                            <div class="form-group row align-items-center mb-3">
                                                <div class="col-sm-1 text-end">
                                                    <label class="badge bg-warning">Magister</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" id="universitas_magister" class="form-control"
                                                        placeholder="Universitas" disabled>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" id="jurusan_magister" class="form-control"
                                                        placeholder="Jurusan" disabled>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" id="tahun_lulus_magister" class="form-control"
                                                        placeholder="Tahun Lulus" disabled>
                                                </div>
                                                <div class="col-sm-4 d-flex gap-2">
                                                    <div class="mb-3">
                                                        <label for="formFileSm" class="form-label">Upload Ijazah</label>
                                                        <input class="form-control form-control-sm" id="ijazah_magister"
                                                            type="file" disabled>
                                                        <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formFileSm" class="form-label">Upload Transkrip
                                                        </label>
                                                        <input class="form-control form-control-sm" id="transkrip_magister"
                                                            type="file" disabled>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Checkbox untuk Doktoral -->
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="checkDoktoral">
                                                <label class="form-check-label">Isi Data Doktoral</label>
                                            </div>

                                            <!-- Doktoral -->
                                            <div class="form-group row align-items-center mb-3">
                                                <div class="col-sm-1 text-end">
                                                    <label class="badge bg-warning">Doktoral</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" id="universitas_doktoral" class="form-control"
                                                        placeholder="Universitas" disabled>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" id="jurusan_doktoral" class="form-control"
                                                        placeholder="Jurusan" disabled>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" id="tahun_lulus_doktoral" class="form-control"
                                                        placeholder="Tahun Lulus" disabled>
                                                </div>
                                                <div class="col-sm-4 d-flex gap-2">
                                                    <div class="mb-3">
                                                        <label for="formFileSm" class="form-label">Upload Ijazah</label>
                                                        <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                            type="file" disabled>
                                                        <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formFileSm" class="form-label">Upload Transkrip
                                                        </label>
                                                        <input class="form-control form-control-sm"
                                                            id="transkrip_doktoral" type="file" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            document.getElementById("checkMagister").addEventListener("change", function() {
                                                let disabled = !this.checked;
                                                document.getElementById("universitas_magister").disabled = disabled;
                                                document.getElementById("jurusan_magister").disabled = disabled;
                                                document.getElementById("tahun_lulus_magister").disabled = disabled;
                                                document.getElementById("ijazah_magister").disabled = disabled;
                                                document.getElementById("transkrip_magister").disabled = disabled;
                                            });

                                            document.getElementById("checkDoktoral").addEventListener("change", function() {
                                                let disabled = !this.checked;
                                                document.getElementById("universitas_doktoral").disabled = disabled;
                                                document.getElementById("jurusan_doktoral").disabled = disabled;
                                                document.getElementById("tahun_lulus_doktoral").disabled = disabled;
                                                document.getElementById("ijazah_doktoral").disabled = disabled;
                                                document.getElementById("transkrip_doktoral").disabled = disabled;
                                            });
                                        </script>


                                    </div>

                                    <!-- Step 3: Organisasi Pengusul -->
                                    <div class="step">
                                        <h5>3. Organisasi Pengusul</h5>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Organisasi Pengusul</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="nama_lengkap"
                                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                    placeholder="Organisasi Pengusul" value="{{ old('nama_lengkap') }}">
                                                @error('nama_lengkap')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-4 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <label for="formFileSm" class="form-label">Upload Rekomendasi</label>
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Rekomendasi Pakar</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="nama_lengkap"
                                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                    placeholder="Rekomendasi Pakar-1" value="{{ old('nama_lengkap') }}">
                                                @error('nama_lengkap')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-4 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <label for="formFileSm" class="form-label">Upload Rekomendasi</label>
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>

                                            <div class="col-sm-4">
                                                <input type="text" name="nama_lengkap"
                                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                    placeholder="Rekomendasi Pakar-2" value="{{ old('nama_lengkap') }}">
                                                @error('nama_lengkap')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-4 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <label for="formFileSm" class="form-label">Upload Rekomendasi</label>
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>

                                            <div class="col-sm-4">
                                                <input type="text" name="nama_lengkap"
                                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                    placeholder="Rekomendasi Pakar-3" value="{{ old('nama_lengkap') }}">
                                                @error('nama_lengkap')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-4 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <label for="formFileSm" class="form-label">Upload Rekomendasi</label>
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Step 4: Dokumen Pendukung -->
                                    <div class="step">
                                        <h5>4. Dokumen Pendukung</h5>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Surat Lamaran</label>

                                            <div class="col-sm-6 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                                {{-- <small class="badge bg-danger ms-2">PDF, min 500kb max 1mb</small> --}}
                                                <small a href="#" class="btn btn-secondary ms-2">Download
                                                    Template</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Surat Pernyataan tidak Rangkap
                                                Jabatan</label>

                                            <div class="col-sm-6 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                                {{-- <small class="badge bg-danger ms-2">PDF, min 500kb max 1mb</small> --}}
                                                <small a href="#" class="btn btn-secondary ms-2">Download
                                                    Template</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Curiculum Vitae</label>

                                            <div class="col-sm-6 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                                {{-- <small class="badge bg-danger ms-2">PDF, min 500kb max 1mb</small> --}}
                                                <small a href="#" class="btn btn-secondary ms-2">Download
                                                    Template</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Surat Pernyataan sedang tidak menjalani
                                                proses pidana / pernah dipidana</label>

                                            <div class="col-sm-6 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                                {{-- <small class="badge bg-danger ms-2">PDF, min 500kb max 1mb</small> --}}
                                                <small a href="#" class="btn btn-secondary ms-2">Download
                                                    Template</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Penulisan Makalah</label>
                                            <div class="col-sm-6 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                                {{-- <small class="badge bg-danger ms-2">PDF, min 500kb max 1mb</small> --}}
                                                <small a href="#" class="btn btn-secondary ms-2">Download
                                                    Template</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Surat Keterangan Sehat Jasmani dan
                                                Rohani</label>
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                                {{-- <small class="badge bg-danger ms-2">PDF, min 500kb max 1mb</small> --}}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">SKCK</label>
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <div class="mb-3">
                                                    <small class="badge bg-danger">PDF, min 500kb max 1mb</small>
                                                    <input class="form-control form-control-sm" id="ijazah_doktoral"
                                                        type="file" disabled>
                                                </div>
                                                {{-- <small class="badge bg-danger ms-2">PDF, min 500kb max 1mb</small> --}}
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Step 5: Review & Submit -->
                                    <div class="step">
                                        <h5>5. Review & Submit</h5>
                                        <p>Pastikan semua dokumen telah diupload dengan benar sebelum mengirim.</p>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                                <!-- Tombol Navigasi -->
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-secondary" id="prevBtn" disabled>Previous</button>
                                    <button class="btn btn-primary" id="nextBtn">Next</button>
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
                                            $("#uploadForm").submit();
                                        }
                                    });

                                    $("#prevBtn").click(function() {
                                        if (currentStep > 0) {
                                            currentStep--;
                                            updateStep();
                                        }
                                    });

                                    $("#uploadForm").submit(function(e) {
                                        e.preventDefault();
                                        alert("Dokumen berhasil diupload!");
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
