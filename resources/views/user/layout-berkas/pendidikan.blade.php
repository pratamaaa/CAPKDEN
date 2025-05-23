<form id="uploadForm" class="form-horizontal" method="POST"action="{{ route('storeUserFiles') }}"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="tab" value="pendidikan">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Card Pendidikan -->
    <div class="mb-3 mt-3">
        <div class="card">
            <div class="card-body p-4">
                <div class="alert alert-warning d-flex align-items-start gap-3 p-3" role="alert"
                    style="border-radius: 8px;">
                    <i class="fas fa-exclamation-triangle fa-lg text-warning mt-1"></i>
                    <div>
                        <h6 class="mb-1 fw-bold text-dark">Perhatian sebelum mengisi!</h6>
                        @php
                            use Carbon\Carbon;
                            Carbon::setLocale('id');
                        @endphp
                        <ul class="mb-0 ps-3 text-dark">
                            <li>File diharuskan menggunakan format <strong>PDF</strong>.</li>
                            <li>Ukuran maksimum file <strong>2 MB</strong>.</li>

                            @isset($userFiles->updated_at)
                                <li>
                                    Terakhir Update pada:
                                    {{ Carbon::parse($userFiles->updated_at)->translatedFormat('j F Y') }}
                                </li>
                            @endisset

                        </ul>
                    </div>
                </div>
                <div class="card-header text-success mb-3" style="background-color: #d4edda; border-radius: 5px;">
                    <h6 class="mb-0 fw-bold">Sarjana (S1)</h6>
                </div>

                <div class="mb-3 row">
                    <label class="col-lg-3 col-form-label">Nama Universitas <span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" name="universitas_sarjana"
                            placeholder="Nama Universitas"
                            value="{{ $userFiles != null ? $userFiles->universitas_sarjana : old('universitas_sarjana') }}"
                            required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-lg-3 col-form-label">Jurusan <span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" name="jurusan_sarjana" placeholder="Jurusan"
                            value="{{ $userFiles != null ? $userFiles->jurusan_sarjana : old('jurusan_sarjana') }}"
                            required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-lg-3 col-form-label">Tahun Lulus <span class="text-danger">*</span></label>
                    <div class="col-lg-2">
                        <input type="text" class="form-control" name="lulus_sarjana" placeholder="Tahun Lulus"
                            value="{{ $userFiles != null ? $userFiles->lulus_sarjana : old('lulus_sarjana') }}"
                            required>
                    </div>
                </div>

                @foreach (['ijazah_sarjana' => 'Ijazah Sarjana'] as $name => $label)
                <div class="mb-3 row">
                    <label class="col-lg-3 col-form-label">Upload Dokumen
                        <span class="fw-semibold">({{ $label }})</span>
                    </label>
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <input type="file" name="{{ $name }}" accept="application/pdf"
                                class="form-control" id="{{ $name }}_input" required>
                            
                            @if (isset($templateLinks[$name]))
                                <a href="{{ $templateLinks[$name] }}" class="badge bg-success text-decoration-none" target="_blank">
                                    <i class="fa fa-download me-1"></i> Download Template
                                </a>
                            @endif
                        </div>
            
                        <div id="{{ $name }}_preview_container" class="mt-2">
                            <span id="{{ $name }}_filename"
                                class="text-muted small d-block mt-1"></span>
                            <iframe id="{{ $name }}_preview_iframe"
                                src="{{ $userFiles != null && $userFiles->$name != null ? asset('storage/' . $userFiles->$name) : '' }}"
                                style="width: 100%; height: 300px; border: 1px solid #ccc; display: {{ $userFiles != null && $userFiles->$name != null ? 'block' : 'none' }};"></iframe>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="card-header text-success mt-4 mb-3" style="background-color: #d4edda; border-radius: 5px;">
                    <h6 class="mb-0 fw-bold">Magister (S2)</h6>
                </div>

                @foreach (['universitas_magister' => 'Nama Universitas', 'jurusan_magister' => 'Jurusan', 'lulus_magister' => 'Tahun Lulus'] as $name => $label)
    <div class="mb-3 row">
        <label class="col-lg-3 col-form-label">{{ $label }}</label>
        <div class="col-lg-4">
            <input type="text" class="form-control" name="{{ $name }}"
                placeholder="{{ $label }}" value="{{ old($name, data_get($userFiles, $name)) }}">
        </div>
    </div>
@endforeach

                @foreach (['ijazah_magister' => 'Ijazah Magister'] as $name => $label)
                <div class="mb-3 row">
                    <label class="col-lg-3 col-form-label">Upload Dokumen
                        <span class="fw-semibold">({{ $label }})</span>
                    </label>
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <input type="file" name="{{ $name }}" accept="application/pdf"
                                class="form-control" id="{{ $name }}_input" required>
                            
                            @if (isset($templateLinks[$name]))
                                <a href="{{ $templateLinks[$name] }}" class="badge bg-success text-decoration-none" target="_blank">
                                    <i class="fa fa-download me-1"></i> Download Template
                                </a>
                            @endif
                        </div>
            
                        <div id="{{ $name }}_preview_container" class="mt-2">
                            <span id="{{ $name }}_filename"
                                class="text-muted small d-block mt-1"></span>
                            <iframe id="{{ $name }}_preview_iframe"
                                src="{{ $userFiles != null && $userFiles->$name != null ? asset('storage/' . $userFiles->$name) : '' }}"
                                style="width: 100%; height: 300px; border: 1px solid #ccc; display: {{ $userFiles != null && $userFiles->$name != null ? 'block' : 'none' }};"></iframe>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="card-header text-success mt-4 mb-3" style="background-color: #d4edda; border-radius: 5px;">
                    <h6 class="mb-0 fw-bold">Doktoral (S3)</h6>
                </div>

                @foreach (['universitas_doktoral' => 'Nama Universitas', 'jurusan_doktoral' => 'Jurusan', 'lulus_doktoral' => 'Tahun Lulus'] as $name => $label)
    <div class="mb-3 row">
        <label class="col-lg-3 col-form-label">{{ $label }}</label>
        <div class="col-lg-4">
            <input type="text" class="form-control" name="{{ $name }}"
                placeholder="{{ $label }}" value="{{ old($name, data_get($userFiles, $name)) }}">
        </div>
    </div>
@endforeach

                @foreach (['ijazah_doktoral' => 'Ijazah Doktoral'] as $name => $label)
                <div class="mb-3 row">
                    <label class="col-lg-3 col-form-label">Upload Dokumen
                        <span class="fw-semibold">({{ $label }})</span>
                    </label>
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <input type="file" name="{{ $name }}" accept="application/pdf"
                                class="form-control" id="{{ $name }}_input" required>
                            
                            @if (isset($templateLinks[$name]))
                                <a href="{{ $templateLinks[$name] }}" class="badge bg-success text-decoration-none" target="_blank">
                                    <i class="fa fa-download me-1"></i> Download Template
                                </a>
                            @endif
                        </div>
            
                        <div id="{{ $name }}_preview_container" class="mt-2">
                            <span id="{{ $name }}_filename"
                                class="text-muted small d-block mt-1"></span>
                            <iframe id="{{ $name }}_preview_iframe"
                                src="{{ $userFiles != null && $userFiles->$name != null ? asset('storage/' . $userFiles->$name) : '' }}"
                                style="width: 100%; height: 300px; border: 1px solid #ccc; display: {{ $userFiles != null && $userFiles->$name != null ? 'block' : 'none' }};"></iframe>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-6">
        {{-- <button type="submit" form="uploadForm" class="btn btn-success px-4 py-2"
            {{ $userFiles != null && $userFiles->status_data == 1 ? 'disabled' : '' }}>
            <i class="fa fa-upload" aria-hidden="true"></i> Simpan & Upload
            {{ $userFiles != null && $userFiles->status_data == 1 ? '(Berkas Sudah Di Submit)' : '' }}
        </button> --}}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previewFields = ['ijazah_sarjana', 'transkrip_sarjana', 'ijazah_magister', 'transkrip_magister',
                'ijazah_doktoral', 'transkrip_doktoral'
            ];

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
        document.querySelector('button[form="uploadForm"]').addEventListener('click', function(e) {
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
                    document.getElementById('uploadForm').submit();
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

    <!-- End Card Pendidikan -->
</form>
