@props(['index', 'field', 'label', 'file' => null])

<tr>
    <td class="text-center">{{ $index }}.</td>
    <td>{!! $label !!}</td>

    <td class="text-center">
        @if ($file && $file->file_path)
            <span class="badge bg-success">Sudah Upload</span>
        @else
            <span class="badge bg-danger">Belum Upload</span>
        @endif
    </td>

    <td class="text-center">
        @if ($file)
            <a href="{{ route('edit.file', $file->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-pen"></i>
            </a>
            <form action="{{ route('delete.file', $file->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Yakin ingin menghapus file ini?')">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        @else
            <form action="{{ route('upload.file', ['field' => $field]) }}" method="POST" enctype="multipart/form-data"
                class="d-inline" id="form_{{ $field }}">
                @csrf
                <input type="file" name="file_upload" style="display: none;" id="input_{{ $field }}"
                    onchange="uploadFile('{{ $field }}')">

                <div id="progress_{{ $field }}" class="progress" style="height: 4px; display: none;">
                    <div class="progress-bar" role="progressbar" style="width: 0%" id="bar_{{ $field }}"></div>
                </div>

                <button type="button" class="btn btn-sm btn-success"
                    onclick="document.getElementById('input_{{ $field }}').click()">
                    <i class="fas fa-upload"></i>
                </button>
            </form>
        @endif
    </td>
</tr>

@once
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            function uploadFile(field) {
                const form = document.getElementById('form_' + field);
                const input = document.getElementById('input_' + field);
                const progress = document.getElementById('progress_' + field);
                const bar = document.getElementById('bar_' + field);

                const file = input.files[0];
                if (!file) return;

                const formData = new FormData(form);
                formData.append('file_upload', file);

                const xhr = new XMLHttpRequest();
                xhr.open('POST', form.action, true);
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                progress.style.display = 'block';
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        let percent = (e.loaded / e.total) * 100;
                        bar.style.width = percent + '%';
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        toastr.success('Upload berhasil!');
                        bar.style.width = '100%';
                        setTimeout(() => progress.style.display = 'none', 1000);
                        location.reload();
                    } else {
                        toastr.error('Upload gagal!');
                        progress.style.display = 'none';
                    }
                };

                xhr.send(formData);
            }
        </script>
    @endpush
@endonce
