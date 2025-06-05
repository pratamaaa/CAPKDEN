<form id="uploadFormPengusul" class="form-horizontal" method="POST"action="{{ route('storeUserFiles') }}"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="tab" value="pengusul">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Card Pengusul -->
    <div class="mb-3 mt-3">
        <div class="card">
            <div class="card-body p-4">
                <div class="alert alert-warning d-flex align-items-start gap-3 p-3" role="alert"
                    style="border-radius: 8px;">
                    <i class="fas fa-exclamation-triangle fa-lg text-warning mt-1"></i>
                    <div>
                        <h6 class="mb-1 fw-bold text-dark">Perhatian sebelum mengisi!</h6>
                        <ul class="mb-0 ps-3 text-dark">
                            <li>Jika Anda memiliki dukungan dari <strong>Organisasi Pengusul (Lembaga Pendidikan, Organisasi Profesi, atau Asosiasi)</strong>, maka <strong>Rekomendasi
                                    Pakar tidak wajib diisi</strong>.</li>
                            <li>Jika Anda <strong>tidak</strong> memiliki dukungan dari <strong>Organisasi Pengusul (Lembaga Pendidikan, Organisasi Profesi, atau Asosiasi)</strong></>, maka
                                <strong>Rekomendasi Pakar wajib 3 (tiga)</strong>.
                            </li>
                            <li>File diharuskan menggunakan format <strong>PDF</strong>.</li>
                            <li>Ukuran maksimum file <strong>2 MB</strong>.
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="card-header text-success mb-3" style="background-color: #d4edda; border-radius: 5px;">
                    <h6 class="mb-0 fw-bold">Organisasi Pengusul Calon Kalangan</h6>
                </div>

                <div class="mb-3 row">
                    <label class="col-lg-3 col-form-label">Nama Organisasi Pengusul</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" placeholder="Organisasi Pengusul" name="org_pengusul"
                        value="{{ $userFiles != null ? $userFiles->org_pengusul : old('org_pengusul') }}" required>
                    </div>
                </div>

                @foreach (['upl_org' => 'Organisasi Pengusul'] as $name => $label)
                    <div class="mb-3 row">
                        <label class="col-lg-3 col-form-label">Upload Dokumen
                            <span class="fw-semibold">({{ $label }})</span>
                        </label>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <input type="file" name="{{ $name }}" accept="application/pdf"
                                    class="form-control me-2" id="{{ $name }}_input" required>
                            
                                <a href="{{ route('template.download', ['type' => 'orgpengusul']) }}"
                                    class="badge bg-success text-decoration-none" target="_blank">
                                    <i class="fa fa-download me-1"></i> Download Template
                                </a>
                            </div>
                            
                            <div id="{{ $name }}_preview_container" class="mb-3">
                                <span id="{{ $name }}_filename" class="text-muted small d-block"></span>
                            
                                <iframe id="{{ $name }}_preview_iframe"
                                    src="{{ $userFiles != null && $userFiles->$name != null ? asset('storage/' . $userFiles->$name) : '' }}"
                                    style="width: 100%; height: 300px; border: 1px solid #ccc; display: {{ $userFiles != null && $userFiles->$name != null ? 'block' : 'none' }};">
                                </iframe>
                            </div>
                            
                        </div>
                    </div>
                @endforeach

                <div class="card-header text-success mt-4 mb-3" style="background-color: #d4edda; border-radius: 5px;">
                    <h6 class="mb-0 fw-bold">Rekomendasi Pakar</h6>
                </div>

                @foreach (['rek_pakar1' => 'Rekomendasi Pakar-1', 'rek_pakar2' => 'Rekomendasi Pakar-2', 'rek_pakar3' => 'Rekomendasi Pakar-3'] as $name => $label)
                    <div class="mb-3 row">
                        <label class="col-lg-3 col-form-label">{{ $label }}</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="{{ $name }}"
                                placeholder="{{ $label }}" value="{{ old($name, data_get($userFiles, $name)) }}">
                        </div>
                    </div>
                @endforeach

                @foreach (['upl_rek_pakar1' => 'Rekomendasi Pakar-1', 'upl_rek_pakar2' => 'Rekomendasi Pakar-2', 'upl_rek_pakar3' => 'Rekomendasi Pakar-3'] as $name => $label)
                    <div class="mb-3 row">
                        <label class="col-lg-3 col-form-label">Upload Data <span
                                class="fw-semibold">({{ $label }})</span></label>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                <input type="file" name="{{ $name }}" accept="application/pdf"
                                    class="form-control me-2" id="{{ $name }}_input" required>
                            
                                <a href="{{ route('template.download', ['type' => 'pakar']) }}"
                                    class="badge bg-success text-decoration-none" target="_blank">
                                    <i class="fa fa-download me-1"></i> Download Template
                                </a>
                            </div>
                            
                            <div id="{{ $name }}_preview_container" class="mb-3">
                                <span id="{{ $name }}_filename" class="text-muted small d-block"></span>
                            
                                <iframe id="{{ $name }}_preview_iframe"
                                    src="{{ $userFiles != null && $userFiles->$name != null ? asset('storage/' . $userFiles->$name) : '' }}"
                                    style="width: 100%; height: 300px; border: 1px solid #ccc; display: {{ $userFiles != null && $userFiles->$name != null ? 'block' : 'none' }};">
                                </iframe>
                            </div>

                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <div class="mt-6">
        {{-- <button type="submit" form="uploadFormPengusul" class="btn btn-success px-4 py-2">
            <i class="fa fa-upload" aria-hidden="true"></i> Simpan & Upload
        </button> --}}
        {{-- <button type="submit" form="uploadFormPengusul" class="btn btn-success px-4 py-2"
            {{ $userFiles != null && $userFiles->status_data == 1 ? 'disabled' : '' }}>
            <i class="fa fa-upload" aria-hidden="true"></i> Simpan & Upload
            {{ $userFiles != null && $userFiles->status_data == 1 ? '(Berkas Sudah Di Submit)' : '' }}
        </button> --}}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previewFields = ['upl_org', 'upl_rek_pakar1', 'upl_rek_pakar2', 'upl_rek_pakar3'];

            previewFields.forEach(function(name) {
                const input = document.getElementById(`${name}_input`);
                const filenameDisplay = document.getElementById(`${name}_filename`);
                const previewIframe = document.getElementById(`${name}_preview_iframe`);
                const previewContainer = document.getElementById(`${name}_preview_container`);

                if (input && previewIframe) {
                    input.addEventListener('change', function() {
                        if (this.files.length > 0) {
                            const file = this.files[0];
                            filenameDisplay.textContent = `File terpilih: ${file.name}`;

                            const fileURL = URL.createObjectURL(file);
                            previewIframe.src = fileURL;
                            previewIframe.style.display = 'block';
                        } else {
                            filenameDisplay.textContent = '';
                            previewIframe.src = '';
                            previewIframe.style.display = 'none';
                        }
                    });
                }
            });
        });
    </script>

    <script>
        document.querySelector('button[form="uploadFormPengusul"]').addEventListener('click', function(e) {
            e.preventDefault(); // Cegah submit langsung

            Swal.fire({
                title: 'Yakin ingin mengunggah data?',
                text: "Pastikan semua dokumen sudah lengkap.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Upload Sekarang!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('uploadFormPengusul').submit();
                }
            });
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#28a745'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
    <!-- End Card Pengusul -->
</form>
