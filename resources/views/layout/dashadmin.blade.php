<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CAPK DEN</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bs/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('bs/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('bs/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('bs/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bs/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('bs/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('bs/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('bs/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bs/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bs/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bs/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bs/dist/css/adminlte.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script  script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .progress-bar {
            transition: width 0.4s ease-in-out;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

    <style>
        /* Accordion yang tidak aktif (collapsed) */
        .accordion-button.collapsed {
            background-color: #d4edda !important; /* Hijau muda */
            color: #155724 !important; /* Hijau tua */
        }
    
        /* Accordion aktif */
        .accordion-button:not(.collapsed) {
            background-color: #198754 !important; /* Bootstrap green */
            color: white !important;
        }
    
        /* Border item agar rapi */
        .accordion-item {
            border: 1px solid #c3e6cb;
        }
    </style>
    
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('bs/dist/img/den.png') }}" alt="logoDEN" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">

                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('bs/dist/img/Logo-DEN.png') }}" alt="Logo" class="" width="100%"
                    height="100%">

            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="info">
                        <small> {{ $greeting }},
                        </small>
                        <span class="d-block"><b>Selamat Datang di Aplikasi <br> CAPK DEN</b></span>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        @if (auth()->user()->role === 'administrator' || auth()->user()->role === 'verifikator')
                            <li class="nav-item menu-open">
                                <a href="{{ url('/admin') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->role === 'user')
                            <li class="nav-item">
                                <a href="{{ url('/user') }}" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Beranda
                                    </p>
                                </a>

                            </li>
                        @endif

                        @if (auth()->user()->role === 'user')
                            <li class="nav-header">PROFILE</li>
                            <li class="nav-item">
                                <a href="{{ url('/updatedata') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Update Data Diri

                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/updateberkas') }}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Upload Kelengkapan
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('statusberkas') }}" class="nav-link">
                                    <i class="nav-icon fas fa-clipboard-check"></i>
                                    <p>
                                        Status Berkas
                                    </p>
                                </a>

                            </li>

                        @endif

                        @if (auth()->user()->role === 'administrator' || auth()->user()->role === 'verifikator')
                            <li class="nav-header">MENU UTAMA</li>
                            <li class="nav-item">
                                <a href="{{ url('/daftarpelamar') }}" class="nav-link">
                                    <i class="nav-icon far fa-list-alt"></i>
                                    <p>
                                        Daftar Pelamar
                                    </p>
                                </a>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-check-square"></i>
                                    <p>
                                        Verifikasi Data
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a> 
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                      <a href="../UI/general.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sudah Verifikasi</p>
                                      </a>
                                    </li>
                                    <li class="nav-item">
                                      <a href="../UI/icons.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Belum Verifikasi</p>
                                      </a>
                                    </li>
                                </ul>     
                            </li>
                        @endif

                        </li>
                        <li class="nav-header">PENGATURAN</li>

                        @if (auth()->user()->role === 'administrator')
                            <li class="nav-item">
                                <a href="{{ url('/pengguna') }}" class="nav-link">
                                    <i class="nav-icon far fa-user-circle"></i>
                                    <p>
                                        Pengguna
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/upl_pengumuman') }}" class="nav-link">
                                    <i class="nav-icon far fa-file"></i>
                                    <p>
                                        Pengumuman
                                    </p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="pages/gallery.html" class="nav-link">
                                <i class="nav-icon fas fa-lock"></i>
                                <p>
                                    Ganti Password
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">Keluar</li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="nav-link">
                                <i class="nav-icon far fa-arrow-alt-circle-right"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>

                    </ul>
                    </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')
        <footer class="main-footer">
            <strong>Copyright &copy; 2025 Panitia Seleksi APK DEN.</strong>

            <div class="float-right d-none d-sm-inline-block">
                <b>Versi</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (Untuk Modal Berfungsi) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('bs/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('bs/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('bs/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('bs/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('bs/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('bs/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('bs/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('bs/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('bs/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('bs/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('bs/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('bs/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('bs/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('bs/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (Segera Update Data Diri dan Dokumen Anda) -->
    <script src="{{ asset('bs/dist/js/pages/dashboard.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('bs/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('bs/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('bs/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.editButton').click(function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let username = $(this).data('username');
                let nik = $(this).data('nik');
                let email = $(this).data('email');
                let role = $(this).data('role');

                $('#edit_nama').val(nama);
                $('#edit_username').val(username);
                $('#edit_nik').val(nik);
                $('#edit_email').val(email);
                $('#edit_role').val(role);

                $('#editForm').attr('action', '/pengguna/update/' + id);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.edit-pengumuman-btn').click(function() {
                var id = $(this).data('id');
                var title = $(this).data('title');

                $('#edit-pengumuman-id').val(id);
                $('#edit-pengumuman-title').val(title);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.delete-pengumuman-btn').click(function() {
                var id = $(this).data('id');
                var title = $(this).data('title');

                $('#delete-pengumuman-id').val(id);
                $('#delete-pengumuman-title').text(title);
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let deleteId = '';

            $('.deleteButton').click(function() {
                deleteId = $(this).data('id');
                let nama = $(this).data('nama');
                $('#delete_nama').text(nama);
                $('#deleteConfirmModal').modal('show');
            });

            $('#confirmDelete').click(function() {
                $.ajax({
                    url: '/pengguna/delete/' + deleteId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#deleteConfirmModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#userTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>

    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            var areaChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                        label: 'Digital Goods',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label: 'Electronics',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Chrome',
                    'IE',
                    'FireFox',
                    'Safari',
                    'Opera',
                    'Navigator',
                ],
                datasets: [{
                    data: [700, 500, 400, 600, 300, 100],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = $.extend(true, {}, barChartData)

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

            new Chart(stackedBarChartCanvas, {
                type: 'bar',
                data: stackedBarChartData,
                options: stackedBarChartOptions
            })
        })
    </script>

<script>
    $(function() {
        $("#example1").DataTable({
            scrollX: true,
            responsive: false, // matikan jika kamu pakai colspan
            autoWidth: false,
            buttons: ["excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('bs/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bs/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bs/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('bs/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bs/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('bs/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bs/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('bs/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('bs/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('bs/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('bs/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('bs/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

@if (session('status_updated'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Data Diri Sudah Pernah Diisi',
        text: '{{ session('status_updated') }}',
        toast: true,
        position: 'center',
        timer: 8000,
        timerProgressBar: true,
        showConfirmButton: false
    });
</script>



@endif

</body>

</html>
