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
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalPelamar }}</h3>

                                <p>Total Pelamar</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ url('/daftarpelamar') }}" class="small-box-footer">Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                   
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $sudahVerifikasi }}</h3>
                                <p>Sudah Verifikasi Administrasi</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="{{ url('/daftarpelamar') }}" class="small-box-footer">Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $belumVerifikasi }}</h3>
                                <p>Belum Verifikasi Administrasi</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <a href="{{ url('/daftarpelamar') }}" class="small-box-footer">Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
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
                                                <th>Total Pelamar</th>
                                                <th>Lulus Administrasi</th>
                                                <th>Tidak Lulus Administrasi</th>
                                                <th>Lulus Wawancara</th>
                                                <th>Tidak Lulus Wawancara</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach($kalanganData as $kalangan)
                                            <tr>
                                                <td>{{ $kalangan->kalangan ?? '-' }}</td>
                                                <td>{{ $kalangan->total_pelamar }}</td>
                                                <td>{{ $kalangan->lulus_administrasi }}</td>
                                                <td>{{ $kalangan->tidak_lulus_administrasi }}</td>
                                                <td>{{ $kalangan->lulus_wawancara }}</td>
                                                <td>{{ $kalangan->tidak_lulus_wawancara }}</td>
                                            </tr>
                                            @endforeach
                                    
                                            <!-- Baris total -->
                                            <tr class="table-success font-weight-bold">
                                                <td>Total</td>
                                                <td>{{ $totalPelamar }}</td>
                                                <td>{{ $totalLulusAdministrasi }}</td>
                                                <td>{{ $totalTidakLulusAdministrasi }}</td>
                                                <td>{{ $totalLulusWawancara }}</td>
                                                <td>{{ $totalTidakLulusWawancara }}</td>
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
