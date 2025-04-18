@extends('layout/dashadmin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Kelengkapan Berkas</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        @if (session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Perhatian!</strong> {{ session('warning') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card card-success card-tabs">
                                        <div class="card-header p-0 pt-1">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-one-home-tab"
                                                        data-toggle="pill" href="#custom-tabs-one-home" role="tab"
                                                        aria-controls="custom-tabs-one-home" aria-selected="true">Data
                                                        Pendidikan</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-profile" role="tab"
                                                        aria-controls="custom-tabs-one-profile" aria-selected="false">Data
                                                        Pengalaman</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-messages" role="tab"
                                                        aria-controls="custom-tabs-one-messages"
                                                        aria-selected="false">Pengusul Kalangan</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-setting-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-setting" role="tab"
                                                        aria-controls="custom-tabs-one-setting"
                                                        aria-selected="false">Dokumen Pendukung</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-one-home"
                                                    role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                    @include('user.layout-berkas.pendidikan')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                                    aria-labelledby="custom-tabs-one-profile-tab">
                                                    @include('user.layout-berkas.pengalaman')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                                    aria-labelledby="custom-tabs-one-messages-tab">
                                                    @include('user.layout-berkas.pengusul')
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-setting" role="tabpanel"
                                                    aria-labelledby="custom-tabs-one-setting-tab">
                                                    @include('user.layout-berkas.dakung')
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const activeTab = "{{ session('active_tab') }}";
                                            if (activeTab) {
                                                document.querySelector(`a[href="#custom-tabs-one-${activeTab}"]`)?.click();
                                            }
                                        });
                                    </script>
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
