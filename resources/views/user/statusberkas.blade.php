@extends('layout/dashadmin')
@section('content')
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Status Kelengkapan Berkas</h3>
                            </div>
                            <div class="card-body">
                                @if ($success)
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ $success }}
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
                                            'ktp' => 'KTP/SIM/PASPOR',
                                            'ijazah_sarjana' => 'Ijazah Sarjana',
                                            'transkrip_sarjana' => 'Transkrip Sarjana',
                                            'ijazah_magister' => 'Ijazah Magister',
                                            'transkrip_magister' => 'Transkrip Magister',
                                            'ijazah_doktoral' => 'Ijazah Doktoral',
                                            'transkrip_doktoral' => 'Transkrip Doktoral',
                                            'upl_org' => 'Organisasi Pengusul',
                                            'upl_rek_pakar1' => 'Rekomendasi Pakar-1',
                                            'upl_rek_pakar2' => 'Rekomendasi Pakar-2',
                                            'upl_rek_pakar3' => 'Rekomendasi Pakar-3',
                                            'lamaran' => 'Surat Lamaran',
                                            'rangkap_jabatan' => 'Surat Pernyataan Tidak Merangkap Jabatan',
                                            'cv' => 'Daftar Riwayat Hidup (CV)',
                                            'pidana' =>
                                                'Surat Pernyataan Tidak Sedang Menjalani Proses Pidana atau Pernah Dipidana Penjara Berdasarkan Putusan Pengadilan yang Telah Berkekuatan Hukum Tetap',
                                            'makalah' => 'Penulisan Makalah',
                                            'surat_sehat' => 'Surat Keterangan Sehat Jasmani dan Rohani',
                                            'skck' => 'SKCK',
                                        ];
                                        $no = 1;
                                    @endphp

                                    <tbody>
                                        @foreach ($dokumenList as $field => $label)
                                            <tr>
                                                <td class="text-center">{{ $no++ }}.</td>
                                                <td class="text-center">{{ $label }}</td>
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
                                                                                <p><strong>Dokumen Saat Ini:</strong></p>

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
