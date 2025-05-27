@extends('layout/main')
@section('content')
<div id="header">
  <style>
    .carousel-container {
    width: 100vw;
    max-height: 100%;
    position: relative;
    overflow: hidden;
  }

  .carousel-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
    z-index: 0;
  }

  .carousel-slide.active {
    opacity: 1;
    z-index: 1;
  }

  .carousel-img {
    width: 100%;
    height: auto;
    display: block;
  }

    .carousel-indicator {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: rgba(255,255,255,0.6);
      margin: 0 5px;
      cursor: pointer;
      border: none;
      transition: background-color 0.3s ease;
    }

    .carousel-indicator.active {
      background-color: rgba(255,255,255,1);
    }
  </style>

  <div id="customCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('bs/assets/images/7.png') }}" class="d-block w-100" alt="Slide 1">
      </div>
      {{-- <div class="carousel-item">
        <img src="{{ asset('bs/assets/images/slidebannerden3.png') }}" class="d-block w-100" alt="Slide 2">
      </div> --}}
      
    </div>

    <!-- Optional Next/Prev controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#customCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>


  <script>
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.carousel-indicator');
    let currentIndex = 0;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.remove('active');
        indicators[i].classList.remove('active');
      });
      slides[index].classList.add('active');
      indicators[index].classList.add('active');
      currentIndex = index;
    }

    function goToSlide(index) {
      showSlide(index);
    }

    function nextSlide() {
      currentIndex = (currentIndex + 1) % slides.length;
      showSlide(currentIndex);
    }

    // Autoplay
    setInterval(nextSlide, 3000);
  </script>
</div>

<div class="anchor">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
        
        <div class="col-lg-12">
          <div class="anchor-pad">
            <div class="row">
              <div class="col-lg-3" style="background">
                <div class="info-post">
                  <div class="icon">
                    <a href="#tugasfungsi">
                      <img src="{{ asset('bs/assets/images/anchor/tugasfungsi.png') }}" class="mb10" alt="">
                      Tugas dan Fungsi
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="info-post">
                  <div class="icon">
                    <a href="#apk">
                      <img src="{{ asset('bs/assets/images/anchor/apk.png') }}" class="mb10" alt="">
                      APK DEN
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="info-post">
                  <div class="icon">
                    <a href="#alurseleksi">
                      <img src="{{ asset('bs/assets/images/anchor/syarat.png') }}" class="mb10" alt="">
                      Alur Seleksi
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="info-post">
                  <div class="icon">
                    <a href="#persyaratan">
                      <img src="{{ asset('bs/assets/images/anchor/alurseleksi.png') }}" class="mb10" alt="">
                      Persyaratan
                    </a>
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
</div>

<div id="tugasfungsi" class="about section" style="margin-top:-150px;padding-top:100px;padding-bottom: 100px;background-image: url({{ asset('bs/assets/images/blog-left-dec.jpg') }});background-size: cover;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-4">
            <div class="about-left-image  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
              <img src="{{ asset('bs/assets/images/den.png') }}" alt="" style="width: 80%;">
            </div>
          </div>
          <div class="col-lg-8 align-self-center  wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
            <div class="about-right-content">
              
              <div class="section-heading">
                <h6>Dewan Energi Nasional</h6>
                <h4>Tugas <em>dan</em> Fungsi</h4>
                <div class="line-dec"></div>
              </div>

              <p style="margin-bottom:10px;">
                Sesuai dengan amanat UU No. 30 Tahun 2007, negara telah mengamanatkan dibentuknya suatu Dewan Energi Nasional (DEN)
                yang anggotanya terdiri dari 7 (tujuh) Menteri yang secara langsung bertanggungjawab atas penyediaan, transportasi, 
                penyaluran, dan pemanfaatan energi serta 8 (delapan) anggota dari Unsur Pemangku Kepentingan.  
                Dewan Energi Nasional yang dibentuk melalui Peraturan Presiden Nomor 26 Tahun 2008, diberi tugas untuk :
              </p>
              <ul class="orderedlist">
                <li class="orderedlist-decimal">Merancang dan merumuskan kebijakan energi nasional untuk ditetapkan oleh Pemerintah dengan persetujuan DPR</li>
                <li class="orderedlist-decimal">Menetapkan Rencana Umum Energi Nasional</li>
                <li class="orderedlist-decimal">Menetapkan langkah-langkah penanggulangan kondisi krisis dan darurat energi</li>
                <li class="orderedlist-decimal">Mengawasi pelaksanaan kebijakan di bidang energi yang bersifat lintas sektoral</li>
              </ul>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="apk" class="services section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
          <h6 class="whitecolor">Anggota DEN</h6>
          <h4 class="whitecolor">Dari Pemangku Kepentingan (APK)</h4>
          {{-- <div class="line-dec whitecolor"></div> --}}
        </div>
      </div>

      <div class="col-lg-12">
        <div class="naccs">
          <div class="grid">
            <div class="row">
              <div class="col-lg-12">
                <div class="menu">
                  <div class="first-thumb active">
                    <div class="thumb">
                      <span class="icon"><img src="{{ asset('bs/assets/images/academic.png') }}" alt=""></span>
                      Kalangan Akademisi<br><br>
                    </div>
                  </div>
                  <div>
                    <div class="thumb">                 
                      <span class="icon"><img src="{{ asset('bs/assets/images/eco-factory.png') }}" alt=""></span>
                      Kalangan <br>Industri<br><br>
                    </div>
                  </div>
                  <div>
                    <div class="thumb">                 
                      <span class="icon"><img src="{{ asset('bs/assets/images/renewable-energy.png') }}" alt=""></span>
                      Kalangan <br>Teknologi<br><br>
                    </div>
                  </div>
                  <div>
                    <div class="thumb">                 
                      <span class="icon"><img src="{{ asset('bs/assets/images/planet-earth.png') }}" alt=""></span>
                      Kalangan Lingkungan Hidup
                    </div>
                  </div>
                  <div class="last-thumb">
                    <div class="thumb">                 
                      <span class="icon"><img src="{{ asset('bs/assets/images/person.png') }}" alt=""></span>
                      Kalangan Konsumen<br><br>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-12">
                <ul class="nacc">
                  <li class="active">
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>Kalangan Akademisi</h4>
                              <p>Mewakili perguruan tinggi dan lembaga penelitian, berperan dalam memberikan perspektif ilmiah dan akademik dalam kebijakan energi.</p>
                              <div class="ticks-list">
                                <span ><i class="fa fa-check"></i> Memberikan kajian ilmiah dan akademik dalam penyusunan Kebijakan Energi Nasional (KEN) dan Rencana Umum Energi Nasional (RUEN)</span>
                                <span><i class="fa fa-check"></i> Melakukan riset dan analisis terkait teknologi energi, sumber daya energi, serta dampak ekonomi dan sosial dari kebijakan energi</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="{{ asset('bs/assets/images/services-image-02.jpg') }}" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>Kalangan Industri</h4>
                              <p>Mewakili sektor industri yang terlibat dalam produksi, distribusi, dan konsumsi energi</p>
                              <div class="ticks-list">
                                <span><i class="fa fa-check"></i> Mewakili kepentingan dunia usaha dalam penyediaan dan pemanfaatan energi.</span> 
                                <span><i class="fa fa-check"></i> Memberikan masukan terkait kebutuhan energi industri serta efisiensi energi dalam proses produksi</span> 
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="{{ asset('bs/assets/images/services-image.jpg') }}" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>Kalangan Teknologi</h4>
                              <p>Berkontribusi dalam pengembangan inovasi dan teknologi energi, termasuk energi baru dan terbarukan</p>
                              <div class="ticks-list">
                                <span><i class="fa fa-check"></i> Mengembangkan inovasi dan teknologi untuk mendukung diversifikasi sumber energi</span> 
                                <span><i class="fa fa-check"></i> Berperan dalam penelitian dan pengembangan (R&D) terkait energi, termasuk energi baru dan terbarukan</span> 
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="{{ asset('bs/assets/images/services-image-03.jpg') }}" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>Kalangan Lingkungan Hidup</h4>
                              <p>Mengedepankan aspek keberlanjutan dan dampak lingkungan dalam kebijakan energi nasional</p>
                              <div class="ticks-list">
                                <span><i class="fa fa-check"></i> Mengawasi dampak lingkungan dari kebijakan energi nasional</span> 
                                <span><i class="fa fa-check"></i> Mendorong transisi energi dari fosil ke energi bersih dan berkelanjutan</span> 
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="{{ asset('bs/assets/images/services-image-04.jpg') }}" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>Kalangan Konsumen</h4>
                              <p>Mewakili kepentingan pengguna energi, baik dari sektor rumah tangga, komersial, maupun industri</p>
                              <div class="ticks-list">
                                <span><i class="fa fa-check"></i> Mewakili kepentingan pengguna energi, termasuk rumah tangga, komersial, dan industri kecil-menengah</span> 
                                <span><i class="fa fa-check"></i> Mengawal implementasi kebijakan subsidi energi agar tepat sasaran</span> 
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="{{ asset('bs/assets/images/services-image.jpg') }}" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="alurseleksi" class="free-quote">
  <div class="container">
    <div class="row">
      
      <div class="col-lg-4 offset-lg-4">
        <div class="section-heading  wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
          <h6>Rekrutmen Dewan Energi Nasional</h6>
          <h4>Alur & Jadwal Seleksi</h4>
          <div class="line-dec"></div>
        </div>
      </div>
      
      
      <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
        <form id="contact" action="" method="post">
          <div class="row">
            <div class="col-lg-12">
              <div class="fill-form">
                <div class="row" style="padding-left: 30px !important;">
                  @for ($i=0; $i < count($jadwalseleksi); $i++)
                    <div class="col-lg-3">
                      <div class="info-post">
                        <div class="blog-post">
                          <div class="down-content">
                            <span class="category" style="font-size: 13px !important;font-weight:bold;">{{ $jadwalseleksi[$i]['tanggal']}}</span>
                            <br><br>
                            @php
                                echo $jadwalseleksi[$i]['judul']; 
                            @endphp
                          </div>
                        </div>
                      </div>
                    </div>
                  @endfor
                  
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<div id="persyaratan" class="contact-us section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
          <h4>Persyaratan <em>Pendaftaran</em></h4>
          <div class="line-dec"></div>
        </div>
      </div>
      
      <section class="content">
        <div class="row">
            <div class="col-12" id="accordion">
              @if ($syarat->count() != 0)
                  @foreach ($syarat->get() as $sya)
                    <div class="card card-warning card-outline">
                      <a class="d-block w-100" data-toggle="collapse" href="#{{ $sya->element_id }}" style="color: #ffffff !important;">
                        <div class="card-header" style="background-color: #1F3BB3 !important;">
                            <h4 class="card-title w-100">
                                {{ $sya->persyaratan }}
                            </h4>
                        </div>
                      </a>
                      <div id="{{ $sya->element_id }}" class="collapse {{ ($sya->urutan == 1 ? 'show' : '') }}" data-parent="#accordion">
                        <div class="card-body">
                          @php
                              echo $sya->deskripsi;
                          @endphp
                        </div>
                      </div>
                    </div>        
                  @endforeach
              @endif
            </div>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection
