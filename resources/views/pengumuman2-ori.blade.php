@extends('layout/main')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="row">
                    <!-- Card Box "Daftar" -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h5>Daftar Pengumuman</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($pengumumans as $pengumuman)
                                    <div class="list-group-item list-group-item-action" style="cursor: pointer;"
                                        onclick="loadPdfPreview('{{ asset('storage/' . $pengumuman->file_path) }}')">
                                        <i class="fas fa-file-pdf text-danger"></i> {{ $pengumuman->title }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Card Box "Preview" -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5>Preview Dokumen</h5>
                            </div>
                            <div class="card-body">
                                <iframe id="pdf-preview" src="" width="100%" height="500px"
                                    style="border: none;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="container mt-4">
                <div class="row">
                         <!-- Card Box "Daftar" -->
                         <div class="col-md-3">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5>Daftar Pengumuman</h5>
                                </div>
                                <div class="card-body">
                                    @foreach ($pengumumans as $pengumuman)
                                        <div class="list-group-item list-group-item-action" style="cursor: pointer;"
                                            onclick="loadPdfPreview('{{ asset('storage/' . $pengumuman->file_path) }}')">
                                            <i class="fas fa-file-pdf text-danger"></i> {{ $pengumuman->title }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Card Box "Preview" -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5>Preview Dokumen</h5>
                                </div>
                                <div class="card-body">
                                    <iframe id="pdf-preview" src="" width="100%" height="500px"
                                        style="border: none;"></iframe>
                                </div>
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </div> --}}

    <script>
        function loadPdfPreview(fileUrl) {
            document.getElementById("pdf-preview").src = fileUrl;
        }
    </script>
@endsection
