@extends('layout/dashadmin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">

    <!-- 1. Total Pelamar -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalPelamar }}</h3>
                <p>Total Seluruh Pelamar</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ url('/daftar-pelamar') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- 3. Sudah Submit Final -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $sudahSubmitFinal }}</h3>
                <p>Sudah Submit Final</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-upload"></i>
            </div>
            <a href="{{ url('/verifikasi') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- 4. Belum Submit Final -->
    {{-- <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $belumSubmitFinal }}</h3>
                <p>Belum Submit Final</p>
            </div>
            <div class="icon">
                <i class="fas fa-file"></i>
            </div>
            <a href="{{ url('/daftarpelamar?status_data=0') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> --}}

    <!-- 5. Sudah Diverifikasi -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $sudahVerifikasi }}</h3>
                <p>Sudah Diverifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-check"></i>
            </div>
            <a href="{{ url('/verifikasi/sudah') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- 6. Belum Diverifikasi -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $belumVerifikasi }}</h3>
                <p>Belum Diverifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-times"></i>
            </div>
            <a href="{{ url('/verifikasi/belum') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- 7. Lulus Administrasi -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalLulusAdministrasi }}</h3>
                <p>Memenuhi Syarat</p>
            </div>
            <div class="icon">
                <i class="fas fa-check"></i>
            </div>
            <a href="{{ url('/verifikasi/lulus') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- 7. Lulus Administrasi -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalTidakLulusAdministrasi }}</h3>
                <p>Tidak Memenuhi Syarat</p>
            </div>
            <div class="icon">
                <i class="fas fa-ban"></i>
            </div>
            <a href="{{ url('/verifikasi/tidaklulus') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h3 class="card-title">Rekap Pelamar per Kalangan</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped" id="example1">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>Kalangan</th>
                                                <th>Formasi</th>
                                                <th>Total Pelamar</th>
                                                <th>Submit Final</th>
                                                <th>Memenuhi Syarat</th>
                                                <th>Tidak Memenuhi Syarat</th>
                                                <th>Lulus Administrasi</th>
                                                <th>Tidak Lulus Administrasi</th>
                                                {{-- <th>Lulus Wawancara</th>
                                                <th>Tidak Lulus Wawancara</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $kuotaKalangan = [
                                                'Akademisi' => 2,
                                                'Industri' => 2,
                                                'Konsumen' => 2,
                                                'Lingkungan Hidup' => 1,
                                                'Teknologi' => 1,
                                            ];
                                        @endphp

                                        @php
                                            $belumMemilih = $kalanganDataPelamar->firstWhere('kalangan', 'Tidak Memilih');
                                            $kalanganTersaring = $kalanganDataPelamar->filter(fn($item) => $item->kalangan !== 'Tidak Memilih');
                                        @endphp

                                        <tbody class="text-center">
                                            @foreach($kalanganTersaring as $kalangan)
                                            <tr>
                                                <td>{{ $kalangan->kalangan ?? '-' }}</td>
                                                <td>{{ $kuotaKalangan[$kalangan->kalangan] ?? '-' }}</td>
                                                <td>{{ $kalangan->total_pelamar }}</td>
                                                <td>{{ $kalangan->submit_final }}</td>
                                                <td>{{ $kalangan->lulus_administrasi }}</td>
                                                <td>{{ $kalangan->tidak_lulus_administrasi }}</td>
                                                <td>{{ $kalangan->status_akhir_lulus }}</td>
                                                <td>{{ $kalangan->status_akhir_tidak_lulus }}</td>
                                                {{-- <td>{{ $kalangan->lulus_wawancara }}</td>
                                                <td>{{ $kalangan->tidak_lulus_wawancara }}</td> --}}
                                            </tr>
                                            @endforeach

                                            @if($belumMemilih)
                                            <tr class="table-danger">
                                                <td>{{ $belumMemilih->kalangan }}</td>
                                                <td>{{ $kuotaKalangan[$belumMemilih->kalangan] ?? '-' }}</td>
                                                <td>{{ $belumMemilih->total_pelamar }}</td>
                                                <td>{{ $belumMemilih->submit_final }}</td>
                                                <td>{{ $belumMemilih->lulus_administrasi }}</td>
                                                <td>{{ $belumMemilih->tidak_lulus_administrasi }}</td>
                                                <td>{{ $belumMemilih->status_akhir_lulus }}</td>
                                                <td>{{ $belumMemilih->status_akhir_tidak_lulus }}</td>
                                                {{-- <td>{{ $belumMemilih->lulus_wawancara }}</td>
                                                <td>{{ $belumMemilih->tidak_lulus_wawancara }}</td> --}}
                                            </tr>
                                            @endif

                                            <!-- Baris total -->
                                            <tr class="table-success font-weight-bold">
                                                <td>Total</td>
                                                <td>8</td>
                                                <td>{{ $totalPelamar }}</td>
                                                <td>{{ $totalSubmitFinal }}</td>
                                                <td>{{ $totalLulusAdministrasi }}</td>
                                                <td>{{ $totalTidakLulusAdministrasi }}</td>
                                                <td>{{ $totalLulusAkhir }}</td>
                                                <td>{{ $totalTidakLulusAkhir }}</td>
                                                {{-- <td>{{ $totalLulusWawancara }}</td>
                                                <td>{{ $totalTidakLulusWawancara }}</td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-6">

                            <div class="card card-info">
                                <div class="card-header">
                                  <h3 class="card-title">Total Pelamar</h3>
                                </div>
                            </div>
                            
                            <!-- Pie Chart -->
                        </div>

                        <div class="col-md-6">

                            <div class="card card-info">
                                <div class="card-header">
                                  <h3 class="card-title">Status Pelamar</h3>
                                </div>
                            </div>
                            
                            <!-- Bar Chart (perbandingan lulus) -->
                        </div>
                      </div>
                    </div>
                </section> --}}
                
                <!-- /.content -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
