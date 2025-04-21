@extends('layout/dashadmin')
@section('content')

    <!-- Main content -->
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Update Data Diri</h3>
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

                            @if ($profile)
                                <div class="alert alert-info">
                                    <strong>Info:</strong> Anda telah mengisi data diri sebelumnya.
                                    @if($profile->updated_at)
                                        Terakhir diperbarui: {{ $profile->updated_at->format('d M Y') }}.
                                    @endif
                                </div>
                             @endif

                            <!-- Form -->
                            <form id="uploadForm" class="form-horizontal" method="POST" action="{{ route('storeUserProfile') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap"
                                                value="{{ auth()->user()->name }}" readonly>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" name="gelar_depan" class="form-control" placeholder="Gelar Depan" required>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" name="gelar_belakang" class="form-control" placeholder="Gelar Belakang" required>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">NIK</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="nik" class="form-control" value="{{ auth()->user()->nik }}" readonly>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="tempat_lahir" class="form-control"
                                                value="{{ auth()->user()->tempat_lahir }}" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" name="tanggal_lahir" class="form-control"
                                                value="{{ auth()->user()->tanggal_lahir }}" readonly>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="jenis_kelamin" required>
                                                <option selected>- Pilih -</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-5">
                                            <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat" required></textarea>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">No. Handphone (WA)</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="no_handphone" class="form-control" required>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pas Foto</label>
                                        <div class="col-sm-3">
                                            <input type="file" name="pas_foto" id="pas_foto" accept="image/*" class="form-control">
                                            <small class="form-text text-muted mt-1 px-2 py-1" 
                                            style="background-color: #e0f7fa; color: #006064; border-left: 4px solid #00bcd4; border-radius: 4px; display: inline-block;">
        Format <strong>JPEG, PNG, JPG</strong>, Max 2 MB.
    </small>
    <div class="mt-2">
        <img id="preview_foto" src="{{ $userProfile->pas_foto_url ?? '' }}" 
             alt="Preview Pas Foto" 
             style="max-height: 200px; display: {{ isset($userProfile->pas_foto_url) ? 'block' : 'none' }};">
    </div>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Upload KTP</label>
                                        <div class="col-sm-3">
                                            <input type="file" name="file_ktp" id="file_ktp" accept="application/pdf" class="form-control">
                                            <small class="form-text text-muted mt-1 px-2 py-1" 
       style="background-color: #e0f7fa; color: #006064; border-left: 4px solid #00bcd4; border-radius: 4px; display: inline-block;">
    Format <strong>PDF</strong>, Max. 2 MB.
</small>

                                            <div class="mt-2" id="ktp_preview" style="display: none;">
                                                <iframe id="ktp_iframe" src="" width="100%" height="400px" style="border: 1px solid #ccc;"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                        

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Kalangan</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="kalangan">
                                                <option selected>- Pilih Calon Kalangan -</option>
                                                <option value="Akademisi">Akademisi</option>
                                                <option value="Industri">Industri</option>
                                                <option value="Teknologi">Teknologi</option>
                                                <option value="Lingkungan Hidup">Lingkungan Hidup</option>
                                                <option value="Konsumen">Konsumen</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                </div>
                                

                                <!-- Tombol Submit -->
                                <div class="card-footer">
                                    {{-- <button type="submit" form="uploadForm" class="btn btn-success px-4 py-2">
                                        <i class="fa fa-upload" aria-hidden="true"></i> Simpan & Upload
                                    </button> --}}
                                    <button type="submit" form="uploadForm" class="btn btn-success px-4 py-2"
            {{ $userFiles != null && $userFiles->status_data == 1 ? 'disabled' : '' }}>
            <i class="fa fa-upload" aria-hidden="true"></i> Simpan & Upload
            {{ $userFiles != null && $userFiles->status_data == 1 ? '(Berkas Sudah Di Submit)' : '' }}
        </button>
                                </div>

                            </form>
                            <script>
                                document.getElementById('file_ktp').addEventListener('change', function(e) {
                                    const file = e.target.files[0];
                                    const preview = document.getElementById('ktp_preview');
                                    const iframe = document.getElementById('ktp_iframe');
                            
                                    if (file && file.type === "application/pdf") {
                                        const reader = new FileReader();
                            
                                        reader.onload = function(e) {
                                            iframe.src = e.target.result;
                                            preview.style.display = 'block';
                                        }
                            
                                        reader.readAsDataURL(file);
                                    } else {
                                        iframe.src = '';
                                        preview.style.display = 'none';
                                    }
                                });
                            </script>                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        document.getElementById('pas_foto').addEventListener('change', function(e) {
            const preview = document.getElementById('preview_foto');
            const file = e.target.files[0];
    
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
  <script>
    document.querySelector('button[form="uploadForm"]').addEventListener('click', function (e) {
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

    
@endsection
