<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Status Kelengkapan Berkas</h3>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Dokumen</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1.</td>
                    <td class="text-center">KTP/SIM/PASPOR</td>
                    <td class="text-center">
                        @if (!empty($userFiles->ktp))
                            <span class="badge bg-success">Sudah Upload</span>
                        @else
                            <span class="badge bg-danger">Belum Upload</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-center">2.</td>
                    <td class="text-center">Ijazah Sarjana</td>
                    <td class="text-center">
                        @if (!empty($userFiles->ijazah_sarjana))
                            <span class="badge bg-success">Sudah Upload</span>
                        @else
                            <span class="badge bg-danger">Belum Upload</span>
                        @endif
                    </td>
                </tr>
                {{-- Tambah baris lainnya sesuai kebutuhan --}}
            </tbody>
        </table>
    </div>
</div>
