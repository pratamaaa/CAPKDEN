<form action="{{ route('statusakhirsave') }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user_id ?? '' }}">

    <div class="modal-header">
        <h5 class="modal-title" id="verifikasiModalLabel">Verifikasi Administrasi Akhir</h5>
    </div>

    <div class="modal-body">
        <div class="mb-3">
            <label for="status_akhir" class="form-label">Status Verifikasi Berkas:</label>
            <select name="status_akhir" id="status_akhir" class="form-select" required>
                <option value="">-- Pilih Status Akhir --</option>
                <option value="lulus"
                    {{ old('status_akhir', $data->status_akhir ?? '') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak lulus"
                    {{ old('status_akhir', $data->status_akhir ?? '') == 'tidak lulus' ? 'selected' : '' }}>Tidak Lulus
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label for="catatan_akhir" class="form-label">Catatan Akhir:</label>
            <textarea id="catatan_akhir" name="catatan_akhir" class="form-control" rows="5">{{ old('catatan_akhir', $data->catatan_akhir ?? '') }}</textarea>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan Verifikasi</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
</form>
