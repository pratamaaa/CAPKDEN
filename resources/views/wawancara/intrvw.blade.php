@extends('layout/dashadmin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Input Hasil Wawancara</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="padding:15px">

                            <div class="card-body table-responsive p-0" style="overflow-x: auto;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="header-row">
                                            <th class="align-top text-center" rowspan="2" style="width: 25px;">No</th>
                                            <th class="align-top text-center" rowspan="2">Foto</th>
                                            <th class="align-top text-center" rowspan="2" style="width: 250px;">Nama</th>
                                            <th class="align-top text-center" rowspan="2">Calon Kalangan</th>

                                            <!-- Header Pendidikan -->
                                            <th class="align-top text-center" colspan="2">Parameter-1</th>
                                            <th class="align-top text-center" colspan="2">Parameter-2</th>
                                            <th class="align-top text-center" colspan="2">Parameter-3</th>
                                            <th class="align-top text-center" colspan="2">Parameter-4</th>

                                            <th class="align-top text-center" rowspan="2">Aksi</th>
                                        </tr>
                                        <tr class="header-row">
                                            <!-- Pendidikan -->
                                            <th class="align-top text-center" style="width: 25px;">Kriteria</th>
                                            <th class="align-top text-center" style="width: 25px;">Nilai</th>
                                            <th class="align-top text-center" style="width: 25px;">Kriteria</th>
                                            <th class="align-top text-center" style="width: 25px;">Nilai</th>
                                            <th class="align-top text-center" style="width: 25px;">Kriteria</th>
                                            <th class="align-top text-center" style="width: 25px;">Nilai</th>
                                            <th class="align-top text-center" style="width: 25px;">Kriteria</th>
                                            <th class="align-top text-center" style="width: 25px;">Nilai</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($pelamar->count() != 0)
                                            @foreach ($pelamar->get() as $nourut => $pel)
                                                <tr>
                                                    <td style="width: 25px;">{{ $nourut + 1 }}</td>
                                                    <td style="width: 150px;">
                                                        @if ($pel->pas_foto != '')
                                                            <img src="{{ asset('uploads/pas_foto/' . $pel->pas_foto) }}"
                                                                width="100">
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>
                                                    <td style="width: 400px;">
                                                        @php
                                                            if ($pel->gelar_depan == '' || $pel->gelar_depan == '-') {
                                                                $gelardepan = '';
                                                            } else {
                                                                $gelardepan = $pel->gelar_depan;
                                                            }

                                                            if (
                                                                $pel->gelar_belakang == '' ||
                                                                $pel->gelar_belakang == '-'
                                                            ) {
                                                                $gelarbelakang = '';
                                                            } else {
                                                                $gelarbelakang = $pel->gelar_belakang;
                                                            }

                                                            $namalengkap_pelamar =
                                                                $gelardepan . ' ' . $pel->name . ', ' . $gelarbelakang;

                                                            echo $namalengkap_pelamar;
                                                        @endphp
                                                    </td>
                                                    <td style="width: 50px;">
                                                        {{ $pel->kalangan != '' ? $pel->kalangan : '' }}</td>
                                                    @php
                                                        $berkaspelamar = Bantuan::berkaspelamar($pel->user_id);
                                                    @endphp
                                                    <td style="width: 50px;">
                                                        @if ($berkaspelamar->count() != 0)
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>
                                                    <td style="width: 50px;">
                                                        @if ($berkaspelamar->count() != 0)
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>

                                                    <td style="width: 50px;">
                                                        @if ($berkaspelamar->count() != 0)
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>
                                                    <td style="width: 50px;">
                                                        @if ($berkaspelamar->count() != 0)
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>

                                                    <td style="width: 50px;">
                                                        @if ($berkaspelamar->count() != 0)
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>
                                                    <td style="width: 50px;">
                                                        @if ($berkaspelamar->count() != 0)
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>

                                                    <td style="width: 50px;">
                                                        @if ($berkaspelamar->count() != 0)
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>
                                                    <td style="width: 50px;">
                                                        @if ($berkaspelamar->count() != 0)
                                                        @else
                                                            <span class="badge bg-danger">Belum diisi</span>
                                                        @endif
                                                    </td>

                                                    <td style="width: 100px; text-center">
                                                        <button class="btn btn-primary btn-sm preview-btn"
                                                            onclick="detailPelamar({{ $pel->user_id }})"
                                                            data-bs-toggle="modal" data-bs-target="#modalpelamar">Input
                                                            Nilai</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="12">Data tidak tersedia</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>


                                <div class="modal fade" id="modalpelamar" tabindex="-1" aria-labelledby="previewModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div id="modalpelamar_content" class="modal-content shadow rounded-4 border-0">
                                        </div>
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
        function detailPelamar(user_id) {
            $('#modalpelamar').modal('show').find('#modalpelamar_content').load("{{ url('pelamardetail') }}?userid=" +
                user_id);
        }
    </script>
@endsection
