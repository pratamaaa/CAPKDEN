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

        <form id="uploadForm" class="form-horizontal" method="POST"action="{{ route('storeUserFiles') }}"
            enctype="multipart/form-data">
            @csrf
            <!-- Card Upload KTP/SIM/PASPOR -->
            <div class="mt-2">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Dokumen Identitas</h6>
                    </div>
                    <div class="card-body row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Data
                            <span class="jenis_identitas fw-semibold">(KTP/SIM/PASPOR)</span>
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <label class="badge badge-danger mt-2">Wajib</label>
                                <input type="file" name="ktp" accept="application/pdf" class="form-control-file"
                                    required>
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Card Pendidikan -->
            <div class="mb-2 mt-2">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">Riwayat Pendidikan</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <div>
                            <label class="col-form-label badge badge-warning">SARJANA (S1)</label>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Nama Universitas
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Nama Universitas"
                                name="universitas_sarjana" value="{{ old('universitas_sarjana') }}" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Jurusan
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Jurusan" name="jurusan_sarjana"
                                value="{{ old('jurusan_sarjana') }}" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Tahun Lulus
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Tahun Lulus" name="lulus_sarjana"
                                value="{{ old('lulus_sarjana') }}" required>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Data
                            <span class="jenis_identitas fw-semibold">(Ijazah Sarjana)</span>
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <label class="badge badge-danger mt-2">Wajib</label>
                                <input type="file" name="ijazah_sarjana" accept="application/pdf"
                                    class="form-control-file" required>
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>

                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Data
                            <span class="jenis_identitas fw-semibold">(Transkrip Sarjana)</span>
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <label class="badge badge-danger mt-2">Wajib</label>
                                <input type="file" name="transkrip_sarjana" accept="application/pdf"
                                    class="form-control-file" required>
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>

                    </div>

                    <div class="mb-2">
                        <div>
                            <label class="col-form-label badge badge-warning">Magister (S2)</label>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Nama Universitas
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Nama Universitas"
                                name="universitas_magister" value="{{ old('universitas_magister') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Jurusan
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Jurusan" name="jurusan_magister"
                                value="{{ old('jurusan_magister') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Tahun Lulus
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Tahun Lulus"
                                name="lulus_magister" value="{{ old('lulus_magister') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Data
                            <span class="jenis_identitas fw-semibold">(Ijazah Magister)</span>
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <input type="file" name="ijazah_magister" accept="application/pdf"
                                    class="form-control-file">
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Data
                            <span class="jenis_identitas fw-semibold">(Transkrip Magister)</span>
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <input type="file" name="transkrip_sarjana" accept="application/pdf"
                                    class="form-control-file">
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div>
                            <label class="col-form-label badge badge-warning">Doktoral (S3)</label>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Nama Universitas
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Nama Universitas"
                                name="universitas_doktoral" value="{{ old('universitas_doktoral') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Jurusan
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Jurusan" name="jurusan_doktoral"
                                value="{{ old('jurusan_doktoral') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Tahun Lulus
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Tahun Lulus"
                                name="lulus_doktoral" value="{{ old('lulus_doktoral') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Data
                            <span class="jenis_identitas fw-semibold">(Ijazah Doktoral)</span>
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <input type="file" name="ijazah_doktoral" accept="application/pdf"
                                    class="form-control-file">
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Data
                            <span class="jenis_identitas fw-semibold">(Transkrip Doktoral)</span>
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <input type="file" name="transkrip_doktoral" accept="application/pdf"
                                    class="form-control-file">
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Pengusul -->
            <div class="mb-4 mt-2">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">Pengusul Calon Kalangan</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <div>
                            <label class="col-form-label badge badge-warning">Organisasi Pengusul</label>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Nama Organisasi Pengusul
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Organisasi Pengusul"
                                name="org_pengusul" value="{{ old('org_pengusul') }}" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Upload Dokumen</label>
                        <div class="col-lg-9">
                            <div class="d-flex flex-wrap align-items-center">
                                <input type="file" name="upl_org" accept="application/pdf"
                                    class="form-control me-3" required style="max-width: 300px;"
                                    onkeyup="set_pengusul(this)">

                                <a href="{{ route('template.download', ['type' => 'pengusul']) }}"
                                    class="btn btn-secondary me-3 mb-2">
                                    Download Template
                                </a>

                                <small class="form-text text-muted mb-2"
                                    style="background-color: #ccffcc; padding: 4px 8px; border-radius: 4px;">
                                    Format file: <strong>PDF</strong> — Maks. 2MB
                                </small>
                            </div>
                        </div>
                    </div>

                    <script>
                        function set_pengusul(ini) {
                            var vals = $(ini).val();
                            if (vals != '') { // ketika isi
                                $('input[name="rek_pakar1"]').attr('required', true);
                                $('input[name="rek_pakar2"]').removeAttr('required');
                                $('input[name="rek_pakar3"]').removeAttr('required');

                                $('.info_wajib1').show();
                                $('.info_wajib2').hide();
                                $('.info_wajib3').hide();

                            } else { // Ketika Kosong
                                $('input[name="rek_pakar1"]').attr('required', true);
                                $('input[name="rek_pakar2"]').attr('required', true);
                                $('input[name="rek_pakar3"]').attr('required', true);

                                $('.info_wajib1').show();
                                $('.info_wajib2').show();
                                $('.info_wajib3').show();
                            }
                        }
                    </script>

                    <div class="mb-2">
                        <div>
                            <label class="col-form-label badge badge-warning">Rekomendasi Pakar</label>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Nama Pakar
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Rekomendasi Pakar-1"
                                name="rek_pakar1" value="{{ old('rek_pakar1') }}" required>
                            <span class="info_wajib1 text-danger" style="display:none;">* Harus diisi</span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-lg-3 col-form-label">Upload Dokumen</label>
                        <div class="col-lg-9">
                            <div class="d-flex flex-wrap align-items-center">
                                <input type="file" name="upl_rek_pakar1" accept="application/pdf"
                                    class="form-control me-3" style="max-width: 300px;">

                                <a href="{{ route('template.download', ['type' => 'pakar']) }}"
                                    class="btn btn-secondary me-3 mb-2">
                                    Download Template
                                </a>

                                <small class="form-text text-muted mb-2"
                                    style="background-color: #ccffcc; padding: 4px 8px; border-radius: 4px;">
                                    Format file: <strong>PDF</strong> — Maks. 2MB
                                </small>
                            </div>
                        </div>
                    </div>


                    <hr>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Nama Pakar
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Rekomendasi Pakar-2"
                                name="rek_pakar2" value="{{ old('rek_pakar2') }}">
                            <span class="info_wajib1 text-danger" style="display:none;">* Harus diisi</span>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Dokumen
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <input type="file" name="upl_rek_pakar2" accept="application/pdf"
                                    class="form-control-file">
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Nama Pakar
                        </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" placeholder="Rekomendasi Pakar-3"
                                name="rek_pakar3" value="{{ old('rek_pakar3') }}">
                            <span class="info_wajib1 text-danger" style="display:none;">* Harus diisi</span>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Dokumen
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <input type="file" name="upl_rek_pakar3" accept="application/pdf"
                                    class="form-control-file">
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Card Dokumen Pendukung -->
            <div class="mt-2">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Dokumen Tambahan</h6>
                    </div>

                    <div class="card-body row mb-2">
                        <label class="col-lg-3 col-form-label">Surat Lamaran
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <label class="badge badge-danger mt-2">Wajib</label>
                                <input type="file" name="ktp" accept="application/pdf"
                                    class="form-control-file" required>
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>
                    </div>

                    <div class="card-body row mb-2">
                        <label class="col-lg-3 col-form-label">Upload Data
                            <span class="jenis_identitas fw-semibold">(KTP/SIM/PASPOR)</span>
                        </label>
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="mb-3">
                                <label class="badge badge-danger mt-2">Wajib</label>
                                <input type="file" name="ktp" accept="application/pdf"
                                    class="form-control-file" required>
                            </div>
                            <small class="form-text text-muted mt-2 ms-3"
                                style="background-color: #ccffcc; padding: 2px 5px; border-radius: 3px;">
                                Format file: <strong>PDF</strong> — Maks. 2MB
                            </small>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
