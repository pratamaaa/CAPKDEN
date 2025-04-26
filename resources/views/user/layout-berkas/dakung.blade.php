<form id="uploadFormPendukung" class="form-horizontal" method="POST"action="{{ route('storeUserFiles') }}"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="tab" value="pendukung">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Card Dokumen Pendukung -->
    <div class="mb-3 mt-3">
        <div class="card">
            <div class="card-body p-4">
                <div class="alert alert-warning d-flex align-items-start gap-3 p-3" role="alert"
                    style="border-radius: 8px;">
                    <i class="fas fa-exclamation-triangle fa-lg text-warning mt-1"></i>
                    <div>
                        <h6 class="mb-1 fw-bold text-dark">Perhatian sebelum mengisi!</h6>
                        <ul class="mb-0 ps-3 text-dark">
                            <li>File diharuskan menggunakan format <strong>PDF</strong>.</li>
                            <li>Ukuran maksimum file <strong>2 MB</strong>.
                            </li>
                        </ul>
                    </div>
                </div>

                @php
    $dokumenPendukung = [
        'lamaran' => 'Surat Lamaran',
        'rangkap_jabatan' => 'Surat Pernyataan 3 Point',
        'cv' => 'Daftar Riwayat Hidup (CV)',
        'pidana' => 'Surat Pernyataan Tidak Sedang Menjalani Proses Pidana atau Pernah Dipidana',
        'surat_sehat' => 'Surat Keterangan Sehat Jasmani dan Rohani',
        'skck' => 'SKCK',
        'persetujuan' => 'Surat Persetujuan dari Pimpinan',
    ];

    $templateLinks = [
        'lamaran' => route('template.download', ['type' => 'lamaran']),
        'rangkap_jabatan' => route('template.download', ['type' => 'pernyataan_3_point']),
        'cv' => route('template.download', ['type' => 'cv']),
        'pidana' => route('template.download', ['type' => 'pidana']),
    ];
@endphp

@foreach ($dokumenPendukung as $name => $label)
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
        <button type="submit" form="uploadFormPendukung" class="btn btn-success px-4 py-2"
            {{ $userFiles != null && $userFiles->status_data == 1 ? 'disabled' : '' }}>
            <i class="fa fa-upload" aria-hidden="true"></i> Simpan & Upload
            {{ $userFiles != null && $userFiles->status_data == 1 ? '(Berkas Sudah Di Submit)' : '' }}
        </button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previewFields = ['lamaran', 'rangkap_jabatan', 'cv', 'pidana', 'makalah', 'surat_sehat', 'skck','surat_persetujuan'];

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
        document.querySelector('button[form="uploadFormPendukung"]').addEventListener('click', function(e) {
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
                    document.getElementById('uploadFormPendukung').submit();
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
    <!-- End Card Pendukung -->
</form>
