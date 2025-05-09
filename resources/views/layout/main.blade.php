<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>CAPK DEN</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bs/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('bs/assets/css/fontawesome.css ') }}">
    <link rel="stylesheet" href="{{ asset('bs/assets/css/templatemo-digimedia-v3.css ') }}">
    <link rel="stylesheet" href="{{ asset('bs/assets/css/animated.css ') }}">
    <link rel="stylesheet" href="{{ asset('bs/assets/css/owl.css ') }}">
    <link rel="shortcut icon" href="{{ asset('bs/assets/images/den.png') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bs/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('bs/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bs/dist/css/adminlte.min.css') }}">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DPT9R5PBQ7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-DPT9R5PBQ7');
</script>
</head>

<body>
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('bs/assets/images/logo-den.png') }}" alt=""
                                style="width: 320px;">
                        </a>

                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{ url('/') }}" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="{{ url('/pengumuman') }}">Pengumuman</a></li>
                            <li class="scroll-to-section"><a href="{{ url('/kontak') }}">Kontak Kami</a></li>
                            <li class="scroll-to-section"><div class="border-first-button"><a href="{{ url('/login') }}">Login</a></div></li>
                            {{-- <li class="scroll-to-section">
                                <div class="border-first-button">
                                    <a href="{{ url('/login') }}">LOGIN</a>
                                </div>
                            </li> --}}
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    @yield('content')
    <!-- End Content -->

    <!-- Pengumuman -->
    {{-- @yield('pengumuman') --}}
    <!-- End Pengumuman -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright © 2025 Sekretariat Jenderal Dewan Energi Nasional.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- End Footer -->

    <!-- Scripts -->
    <script src="{{ asset('bs/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bs/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bs/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('bs/assets/js/animation.js') }}"></script>
    <script src="{{ asset('bs/assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('bs/assets/js/custom.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('bs/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('bs/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('bs/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
