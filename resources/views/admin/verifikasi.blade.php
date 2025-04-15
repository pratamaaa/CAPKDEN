@extends('layout/dashadmin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Verifikasi Pelamar</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">


                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card card-primary card-tabs">
                                        <div class="card-header p-0 pt-1">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-one-home-tab"
                                                        data-toggle="pill" href="#custom-tabs-one-home" role="tab"
                                                        aria-controls="custom-tabs-one-home" aria-selected="true">Rekap
                                                        Data</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-profile" role="tab"
                                                        aria-controls="custom-tabs-one-profile" aria-selected="false">Sudah
                                                        Verifikasi</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-messages" role="tab"
                                                        aria-controls="custom-tabs-one-messages" aria-selected="false">Belum
                                                        Verifikasi</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-one-home"
                                                    role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                    @include('verifikasi.rekap')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                                    aria-labelledby="custom-tabs-one-profile-tab">
                                                    @include('verifikasi.sudahrekap')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                                    aria-labelledby="custom-tabs-one-messages-tab">
                                                    @include('verifikasi.belumrekap')
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>

                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
@endsection
