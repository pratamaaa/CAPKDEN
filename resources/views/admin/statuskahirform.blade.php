<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="statusAkhirModalLabel">Perbarui Status Akhir Pelamar: {{ $user->name ?? 'N/A' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
    </div>
    <form action="{{ route('admin.update_status_akhir', $user->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Penting! Laravel butuh ini untuk metode PUT --}}

        <div class="modal-body">
            <div class="mb-3">
                <label for="administrasi_status" class="form-label">Status Administrasi Berkas</label>
                <input type="text" class="form-control" id="administrasi_status"
                    value="{{ $item->administrasi_status ?? '-' }}" readonly>
            </div>
            <div class="mb-3">
                <label for="administrasi_catatan" class="form-label">Catatan Administrasi Berkas</label>
                <textarea class="form-control" id="administrasi_catatan" rows="3" readonly>{{ $item->administrasi_catatan ?? '-' }}</textarea>
            </div>

            <hr> {{-- Garis pemisah --}}

            <div class="mb-3">
                <label for="status_akhir" class="form-label">Status Akhir Verifikasi</label>
                <select class="form-select" id="status_akhir" name="status_akhir" required>
                    <option value="">Pilih Status</option>
                    <option value="lulus" {{ optional($item)->status_akhir == 'lulus' ? 'selected' : '' }}>Lulus
                    </option>
                    <option value="tidak lulus" {{ optional($item)->status_akhir == 'tidak lulus' ? 'selected' : '' }}>
                        Tidak Lulus</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="catatan_akhir" class="form-label">Catatan Akhir</label>
                <textarea class="form-control" id="catatan_akhir" name="catatan_akhir" rows="3">{{ optional($item)->catatan_akhir }}</textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Simpan Status Akhir</button>
        </div>
    </form>
</div>
