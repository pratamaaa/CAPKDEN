@php
    $activeStep = session('active_step', old('step', 1));
@endphp

@extends('layout/dashadmin')
@section('content')

    <!-- Main content -->
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('user.layout-user.upload')
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const fileInputs = document.querySelectorAll('input[type="file"]');
                        const uploadForm = document.getElementById("uploadForm");
                
                        fileInputs.forEach(input => {
                            input.addEventListener('change', function () {
                                const file = this.files[0];
                                const wrapper = this.parentNode;
                
                                // Hapus feedback lama
                                wrapper.querySelectorAll("small").forEach(el => el.remove());
                                wrapper.querySelectorAll(".progress").forEach(el => el.remove());
                
                                // Validasi
                                if (file) {
                                    if (file.type !== "application/pdf") {
                                        const error = document.createElement("small");
                                        error.classList.add("text-danger", "ms-2");
                                        error.innerText = "File harus PDF.";
                                        wrapper.appendChild(error);
                                        this.value = '';
                                        return;
                                    }
                
                                    if (file.size > 1024 * 1024) {
                                        const error = document.createElement("small");
                                        error.classList.add("text-danger", "ms-2");
                                        error.innerText = "Ukuran file maksimal 1MB.";
                                        wrapper.appendChild(error);
                                        this.value = '';
                                        return;
                                    }
                
                                    // Progress bar mini
                                    const progress = document.createElement("div");
                                    progress.className = "progress w-100 mt-2";
                                    progress.innerHTML = `
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                                             role="progressbar" style="width: 100%; height: 8px;"></div>
                                    `;
                                    wrapper.appendChild(progress);
                
                                    // Preview ikon
                                    const success = document.createElement("small");
                                    success.classList.add("text-success", "ms-2");
                                    const sizeInKb = (file.size / 1024).toFixed(1);
                                    success.innerHTML = `📄 ${file.name} (${sizeInKb} KB)`;
                                    wrapper.appendChild(success);
                                }
                            });
                        });
                
                        // Animasi loading submit
                        uploadForm.addEventListener("submit", function (e) {
                            const submitBtn = uploadForm.querySelector("button[type=submit]");
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = `
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Mengunggah...
                            `;
                        });
                    });
                </script>
                
            </div>
        </section>
    </div>

@endsection
