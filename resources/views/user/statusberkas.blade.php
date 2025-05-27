@extends('layout/dashadmin')
@section('content')
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Status Kelengkapan Berkas</h3>
                            </div>

                            <div class="alert alert-warning d-flex align-items-start gap-3 p-3" role="alert"
                    style="border-radius: 8px;">
                    <i class="fas fa-exclamation-triangle fa-lg text-warning mt-1"></i>
                    <div>
                        <h6 class="mb-1 fw-bold text-dark">Perhatian sebelum <strong>SUBMIT FINAL!</strong></h6>
                        <ul class="mb-0 ps-3 text-dark">
                            <li>Seluruh dokumen wajib diisi dan diunggah/ upload.</li>
                            <li>Dokumen terkait Riwayat Pendidikan yang wajib diisi dan diunggah adalah data pendidikan Sarjana (S1).</li>
                            <li>Dokumen terkait Rekomendasi Pengusul wajib diisi dan diunggah dengan ketentuan:</li>
                            <p>1. Jika Anda memiliki dukungan dari <strong>Lembaga Pendidikan, Organisasi Profesi, atau Asosiasi</strong>, maka <strong>Rekomendasi
                                Pakar cukup 1 (satu) surat</strong>. <br>
                        2. Jika Anda <strong>tidak</strong> memiliki dukungan dari <strong>Lembaga Pendidikan, Organisasi Profesi, atau Asosiasi</strong></>, maka
                            <strong>Rekomendasi Pakar wajib 3 (tiga) surat</strong>.</p>
                        </li>
                        </ul>
                    </div>
                </div>
                            <div class="card-body">
                                @if ($success)
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ $success }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Dokumen</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $dokumenList = [
                                            'ktp' => 'KTP/SIM/PASPOR <span class="text-danger">*</span>',
                                            'ijazah_sarjana' => 'Ijazah Sarjana <span class="text-danger">*</span>',
                                            'ijazah_magister' => 'Ijazah Magister',
                                            'ijazah_doktoral' => 'Ijazah Doktoral',
                                            'upl_org' => 'Organisasi Pengusul',
                                            'upl_rek_pakar1' => 'Rekomendasi Pakar-1',
                                            'upl_rek_pakar2' => 'Rekomendasi Pakar-2',
                                            'upl_rek_pakar3' => 'Rekomendasi Pakar-3',
                                            'lamaran' => 'Surat Lamaran <span class="text-danger">*</span>',
                                            'rangkap_jabatan' => 'Surat Pernyataan 3 Poin <span class="text-danger">*</span>',
                                            'cv' => 'Daftar Riwayat Hidup (CV) <span class="text-danger">*</span>',
                                            'pidana' =>
                                                'Surat Pernyataan Tidak Sedang Menjalani Proses Pidana atau Pernah Dipidana Penjara Berdasarkan Putusan Pengadilan yang Telah Berkekuatan Hukum Tetap <span class="text-danger">*</span>',
                                            'surat_sehat' => 'Surat Keterangan Sehat Jasmani dan Rohani <span class="text-danger">*</span>',
                                            'skck' => 'SKCK <span class="text-danger">*</span>',
                                            'persetujuan' => 'Surat Persetujuan dari Pimpinan',
                                        ];
                                        $no = 1;
                                    @endphp

                                    <tbody>
                                        @foreach ($dokumenList as $field => $label)
                                            <tr>
                                                <td class="text-center">{{ $no++ }}.</td>
                                                <td class="text-center">{!! $label !!}</td>

                                                <td class="text-center">
                                                    @if (!empty($userFiles->$field))
                                                        <span class="badge bg-success">Sudah Upload</span>
                                                    @else
                                                        <span class="badge bg-danger">Belum Upload</span>
                                                    @endif
                                                <td class="text-center">
                                                    @if (!empty($userFiles->{$field}))
                                                        <div class="btn-group" role="group">
                                                            <!-- Tombol Preview -->
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalPreview{{ $field }}">
                                                            <i class="fas fa-eye"></i>
                                                            </button>

                                                            <!-- Tombol Edit -->
                                                            <button type="button" class="btn btn-sm btn-primary"
                                                             {{ ($userFiles != null && $userFiles->status_data == 1) ? 'disabled' : '' }}
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalEdit{{ $field }}">
                                                                <i class="fas fa-pen"></i>
                                                            </button>

                                                            <!-- Tombol Hapus -->
                                                            <form
                                                                action="{{ route('userfiles.destroy', ['field' => $field]) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                {{ ($userFiles != null && $userFiles->status_data == 1) ? 'disabled' : '' }}
                                                                    onclick="return confirm('Yakin ingin menghapus dokumen ini?')">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>

                                                            <!-- Modal Preview -->
                                                            <div class="modal fade" id="modalPreview{{ $field }}" tabindex="-1"
                                                            aria-labelledby="modalPreviewLabel{{ $field }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalPreviewLabel{{ $field }}">
                                                                            Pratinjau Dokumen: {{ $label }}
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                            aria-label="Tutup"></button>
                                                                    </div>
                                                                    @php

                                                                        $filePath = $userFiles->{$field};
                                                                        $fullPath = public_path(
                                                                            'storage/' . $filePath,
                                                                        );
                                                                    @endphp
                                                                    <div class="modal-body">
                                                                        
                                                                        @if (!empty($filePath) && file_exists($fullPath))
                                                                            <embed src="{{ asset('storage/' . $filePath) }}" type="application/pdf"
                                                                                width="100%" height="600px" />
                                                                        @else
                                                                            <div class="alert alert-warning">Dokumen tidak ditemukan atau belum diupload.</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>

                                                            <!-- Modal Edit -->
                                                            <div class="modal fade" id="modalEdit{{ $field }}"
                                                                tabindex="-1"
                                                                aria-labelledby="modalEditLabel{{ $field }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form
                                                                            action="{{ route('userfiles.update', ['field' => $field]) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')

                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="modalEditLabel{{ $field }}">
                                                                                    Edit
                                                                                    Dokumen: {{ $label }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Tutup"></button>
                                                                            </div>

                                                                            @php

                                                                                $filePath = $userFiles->{$field};
                                                                                $fullPath = public_path(
                                                                                    'storage/' . $filePath,
                                                                                );
                                                                            @endphp
                                                                            <div class="modal-body">
                                                                                <p><strong>Dokumen Saat Ini {{$field}}:</strong></p>

                                                                                @if (!empty($filePath) && file_exists($fullPath))
                                                                                    <embed
                                                                                        src="{{ asset('storage/' . $filePath) }}"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="300px" />
                                                                                @else
                                                                                    <div class="alert alert-warning">Dokumen
                                                                                        tidak ditemukan atau belum diupload.
                                                                                    </div>
                                                                                @endif

                                                                                <div class="mt-3">
                                                                                    <label for="file_{{ $field }}"
                                                                                        class="form-label">Ganti File (PDF,
                                                                                        max
                                                                                        1MB):</label>
                                                                                    <input type="file" name="dokumen"
                                                                                        id="file_{{ $field }}"
                                                                                        class="form-control"
                                                                                        accept="application/pdf">
                                                                                </div>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Simpan
                                                                                    Perubahan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <span><span class="text-danger"><strong>*</strong></span> wajib di upload</span>

                                <hr>
                                <form
                                action="{{ route('userfiles.updatestatus', ['field' => $userFiles->id]) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                {{-- <button type="submit" class="btn btn-success px-4 py-2"
                                {{ ($userFiles != null && $userFiles->status_data == 1) ? 'disabled' : '' }}
                                onclick="return confirm('Yakin ingin Menyelesaikan dokumen ini?')">
                                    <i class="fa fa-upload" aria-hidden="true"></i> Submit Final
                                </button> --}}
                                <button type="button" class="btn btn-success px-4 py-2"
                                    id="submitFinalBtn"
                                    {{ ($userFiles != null && $userFiles->status_data == 1) ? 'disabled' : '' }}>
                                    <i class="fa fa-upload" aria-hidden="true"></i> Submit Final
                                </button>

                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        document.getElementById('submitFinalBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'Selesaikan Dokumen?',
                text: "Pastikan semua dokumen sudah lengkap sebelum disubmit. Jika sudah submit, data Anda tidak bisa diubah lagi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Submit!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Cari form terdekat dan submit
                    this.closest('form').submit();
                }
            });
        });
    </script>
    
    <!-- Modal -->
<!-- Modal Final Submit -->
<div class="modal fade" id="finalSubmitModal" tabindex="-1" aria-labelledby="finalSubmitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="finalSubmitModalLabel">Registrasi Berhasil!</h5>
      </div>
      <div class="modal-body text-center">
        <p>Terima kasih, Anda telah menyelesaikan proses registrasi.</p>
        <a href="{{ url('/datapelamar_pdf') }}?uuid={{ Auth::user()->uuid }}" 
            class="btn btn-primary mb-3" target="_blank">
            Download Resume
        </a>
      </div>
      <div class="modal-footer justify-content-center">
        <a href="{{ route('statusberkas') }}" class="btn btn-secondary">Selesai</a>
      </div>
    </div>
  </div>
</div>

@if(session('final_submit'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('finalSubmitModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
  });
</script>
@endif

@endsection
