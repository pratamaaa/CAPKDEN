@extends('layout/main')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h4>Pengumuman</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <div class="container">
                        <div class="row">

                            <!-- Card Box "Daftar" -->
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header text-white" style="background-color: #1F3BB3;">
                                        <h5>Daftar Pengumuman</h5>
                                    </div>
                                    <div class="card-body" style="padding-bottom:40px;">
                                        @foreach ($pengumumans as $pengumuman)
                                            <div class="list-group-item list-group-item-action" style="cursor: pointer;margin-top:12px;" onclick="loadPdfPreview('{{ asset('storage/' . $pengumuman->file_path) }}');">
                                                <i class="fas fa-file-pdf text-danger"></i> {{ $pengumuman->title }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Card Box "Preview" -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header text-white" style="background-color: #1F3BB3;">
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
        </div>
    </div>

    <script>
        function loadPdfPreview(fileUrl) {
            document.getElementById("pdf-preview").src = fileUrl;
        }
    </script>
@endsection
