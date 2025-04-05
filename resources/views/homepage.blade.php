@extends('layout/main')
@section('content')
    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="">
                <div class="" data-wow-duration="1s" data-wow-delay="0.5s">
                    <img src="{{ asset('bs/assets/images/sliderbanner.png') }}" alt="">
                </div>
            </div>

        </div>
    </div>

    <div id="about" class="about section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="about-left-image  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="{{ asset('bs/assets/images/den.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-10 align-self-center  wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <div class="about-right-content">
                                <div class="section-heading">
                                    <h6>Dewan Energi Nasional</h6>
                                    <h4>Tugas dan <em>Fungsi</em></h4>
                                    <div class="line-dec"></div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="blog-posts__">

                                            <article class="post post-large">
                                                <div class="post-content ratajustify">

                                                    Sesuai dengan amanat UU No. 30 Tahun 2007, negara telah
                                                    mengamanatkan dibentuknya suatu Dewan Energi Nasional (DEN) yang
                                                    anggotanya terdiri dari 7 (tujuh) Menteri yang secara langsung
                                                    bertanggungjawab atas penyediaan, transportasi, penyaluran, dan
                                                    pemanfaatan energi serta 8 (delapan) anggota dari Unsur Pemangku
                                                    Kepentingan. &nbsp;Dewan Energi Nasional yang dibentuk melalui
                                                    Peraturan Presiden Nomor 26 Tahun 2008, diberi tugas untuk :
                                                    <br>

                                                    <ol>
                                                        <li>1. Merancang dan merumuskan kebijakan energi nasional untuk
                                                            ditetapkan oleh Pemerintah dengan persetujuan DPR.</li>
                                                        <li>2. Menetapkan Rencana Umum Energi Nasional.</li>
                                                        <li>3. Menetapkan langkah-langkah penanggulangan kondisi krisis
                                                            dan darurat energi.</li>
                                                        <li>4. Mengawasi pelaksanaan kebijakan di bidang energi yang
                                                            bersifat lintas sektoral.</li>
                                                    </ol>
                                                </div>
                                            </article>
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

    <div id="services" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Anggota DEN</h6>
                        <h4>Dari Pemangku <em>Kepentingan</em></h4>
                        <div class="line-dec"></div>
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
                                                <span class="icon"><img src="{{ asset('bs/assets/images/academic.png') }}"
                                                        alt=""></span>
                                                Kalangan Akademisi
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img
                                                        src="{{ asset('bs/assets/images/eco-factory.png') }}"
                                                        alt=""></span>
                                                Kalangan <br>Industri
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img src="{{ asset('bs/assets/images/nano.png') }}"
                                                        alt=""></span>
                                                Kalangan Teknologi
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img
                                                        src="{{ asset('bs/assets/images/planet-earth.png') }}"
                                                        alt=""></span>
                                                Kalangan Lingkungan Hidup
                                            </div>
                                        </div>
                                        <div class="last-thumb">
                                            <div class="thumb">
                                                <span class="icon"><img src="{{ asset('bs/assets/images/person.png') }}"
                                                        alt=""></span>
                                                Kalangan Konsumen
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
                                                        <div class="col-lg-8 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Kalangan Akademisi</h4>
                                                                <span>Mewakili perguruan tinggi dan lembaga penelitian,
                                                                    berperan dalam memberikan perspektif ilmiah dan
                                                                    akademik dalam kebijakan energi.
                                                                    <p></p>
                                                                </span>

                                                                <span><i class="fa fa-check"></i>Memberikan kajian
                                                                    ilmiah dan akademik dalam penyusunan Kebijakan
                                                                    Energi Nasional (KEN) dan Rencana Umum Energi
                                                                    Nasional (RUEN).</span>
                                                                <p></p>
                                                                <span><i class="fa fa-check"></i> Melakukan riset dan
                                                                    analisis terkait teknologi energi, sumber daya
                                                                    energi, serta dampak ekonomi dan sosial dari
                                                                    kebijakan energi.</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('bs/assets/images/education.jpg') }}"
                                                                    alt="">
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
                                                        <div class="col-lg-8 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Kalangan Industri</h4>
                                                                <span>Mewakili sektor industri yang terlibat dalam
                                                                    produksi, distribusi, dan konsumsi energi.<p></p>
                                                                </span>
                                                                <div class="ticks-list">
                                                                    <span><i class="fa fa-check"></i> Mewakili
                                                                        kepentingan dunia usaha dalam penyediaan dan
                                                                        pemanfaatan energi.</span>
                                                                    <span><i class="fa fa-check"></i> Memberikan
                                                                        masukan terkait kebutuhan energi industri serta
                                                                        efisiensi energi dalam proses produksi.</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('bs/assets/images/industry.png') }}"
                                                                    alt="">
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
                                                        <div class="col-lg-8 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Kalangan Teknologi</h4>
                                                                <span>Berkontribusi dalam pengembangan inovasi dan
                                                                    teknologi energi, termasuk energi baru dan
                                                                    terbarukan.<p></p></span>
                                                                <div class="ticks-list">
                                                                    <span><i class="fa fa-check"></i> Mengembangkan
                                                                        inovasi dan teknologi untuk mendukung
                                                                        diversifikasi sumber energi.</span>
                                                                    <span><i class="fa fa-check"></i> Berperan dalam
                                                                        penelitian dan pengembangan (R&D) terkait
                                                                        energi, termasuk energi baru dan
                                                                        terbarukan.</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('bs/assets/images/tech.png') }}"
                                                                    alt="">
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
                                                        <div class="col-lg-8 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Kalangan Lingkungan Hidup</h4>
                                                                <span>Mengedepankan aspek keberlanjutan dan dampak
                                                                    lingkungan dalam kebijakan energi nasional.<p></p>
                                                                </span>
                                                                <div class="ticks-list">
                                                                    <span><i class="fa fa-check"></i> Mengawasi dampak
                                                                        lingkungan dari kebijakan energi
                                                                        nasional.</span>
                                                                    <span><i class="fa fa-check"></i> Mendorong
                                                                        transisi energi dari fosil ke energi bersih dan
                                                                        berkelanjutan.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('bs/assets/images/environment.jpg') }}"
                                                                    alt="">
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
                                                        <div class="col-lg-8 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Kalangan Konsumen</h4>
                                                                <span>Mewakili kepentingan pengguna energi, baik dari
                                                                    sektor rumah tangga, komersial, maupun industri.<p>
                                                                    </p></span>
                                                                <div class="ticks-list">
                                                                    <span><i class="fa fa-check"></i> Mewakili
                                                                        kepentingan pengguna energi, termasuk rumah
                                                                        tangga, komersial, dan industri
                                                                        kecil-menengah.</span>
                                                                    <span><i class="fa fa-check"></i> Mengawal
                                                                        implementasi kebijakan subsidi energi agar tepat
                                                                        sasaran.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ asset('bs/assets/images/consumer.jpg') }}"
                                                                    alt="">
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

    <div id="free-quote" class="free-quote">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading  wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h4>Alur & Jadwal Seleksi</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-dec">
                                    <img src="{{ asset('bs/assets/images/candidate.png') }}" alt="">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="fill-form">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/register.png') }}"
                                                        alt="">
                                                    <a href="#">PENDAFTARAN</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/task.png') }}" alt="">
                                                    <a href="#">SELEKSI ADMINISTRASI</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/advertisement.png') }}"
                                                        alt="">
                                                    <a href="#">PENGUMUMAN <br>HASIL SELEKSI ADMINISTRASI</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/compare.png') }}"
                                                        alt="">
                                                    <a href="#">MASA SANGGAH</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/check-list.png') }}"
                                                        alt="">
                                                    <a href="#">SELEKSI ASSESMENT</a>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/criteria.png') }}"
                                                        alt="">
                                                    <a href="#">PENGUMUMAN HASIL SELEKSI ASSESMENT</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/meeting.png') }}"
                                                        alt="">
                                                    <a href="#">WAWANCARA</a>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/announcement.png') }}"
                                                        alt="">
                                                    <a href="#">PENGUMUMAN HASIL WAWANCARA</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/interview.png') }}"
                                                        alt="">
                                                    <a href="#">FIT AND PROPER TEST</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/finish.png') }}" alt="">
                                                    <a href="#">PENGUMUMAN HASIL</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/documentation.png') }}"
                                                        alt="">
                                                    <a href="#">PENGUMPULAN BERKAS ASLI</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/goal.png') }}" alt="">
                                                    <a href="#">PENGANGKATAN</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h3>PERSYARATAN</h3>
                        <h6>PENYARINGAN ANGGOTA DEWAN ENERGI NASIONAL
                            DARI PEMANGKU KEPENTINGAN
                            PERIODE 2026-2030
                        </h6>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <section class="content">
                    <div class="row">
                        <div class="col-12" id="accordion">
                            <div class="card card-primary card-outline">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            1. Persyaratan Umum
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        <style>
                                            table {
                                                border-collapse: collapse;
                                                width: 100%;
                                            }

                                            th,
                                            td {
                                                border: 0px;
                                                padding: 8px;
                                                vertical-align: top;
                                                /* Menjadikan teks rata atas */
                                            }

                                            td:first-child {
                                                width: 1%;
                                                /* Lebar kolom nomor */
                                                text-align: left;
                                                font-weight: bold;
                                            }
                                        </style>

                                        <table>
                                            <tr>
                                                <td>a.</td>
                                                <td>Warga Negara Indonesia;</td>
                                            </tr>
                                            <tr>
                                                <td>b.</td>
                                                <td>Setia kepada Pancasila dan Undang-Undang Dasar Negara Republik Indonesia
                                                    Tahun 1945;</td>
                                            </tr>
                                            <tr>
                                                <td>c.</td>
                                                <td>Mempunyai integritas dan dedikasi yang tinggi;</td>
                                            </tr>
                                            <tr>
                                                <td>d.</td>
                                                <td>Mempunyai pendidikan paling rendah Sarjana Strata Satu, dan/atau
                                                    berpengalaman serta memiliki kemampuan profesionalisme di bidang energi
                                                    sebagaimana diatur dalam persyaratan khusus;</td>
                                            </tr>
                                            <tr>
                                                <td>e.</td>
                                                <td>Tidak pernah dihukum karena melakukan tindak pidana kejahatan dijatuhi
                                                    pidana penjara;</td>
                                            </tr>
                                            <tr>
                                                <td>f.</td>
                                                <td>Sehat jasmani dan rohani; dan</td>
                                            </tr>
                                            <tr>
                                                <td>g.</td>
                                                <td>Diusulkan oleh lembaga pendidikan, organisasi profesi, atau asosiasi
                                                    sebagaimana diatur dalam persyaratan khusus</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary card-outline">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            2. Persyaratan Khusus
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td>a.</td>
                                                <td>Diutamakan mempunyai pengalaman paling sedikit 10 (sepuluh) tahun dan
                                                    memiliki kemampuan profesionalisme di bidang energi yang terkait dengan
                                                    bidang supply, demand, distribusi, dan/ atau pemanfaatan energi, dengan
                                                    latar belakang :</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>1. Sebagai anggota akademi dan/ atau berprofesi sebagai dosen bagi yang
                                                    berasal dari kalangan akademisi;</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>2. Pernah atau sedang bekerja di bidang industri energi bagi yang
                                                    berasal dari kalangan industri;</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>3. Pernah atau sedang bekerja di bidang perekayasaan teknologi energi
                                                    bagi yang berasal dari kalangan teknologi;</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>4. Pernah atau sedang bekerja di bidang lingkungan hidup di bidang
                                                    energi bagi yang berasal dari kalangan lingkungan hidup; dan</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>5. Sebagai pengguna barang dan/atau jasa yang berkaitan dengan bidang
                                                    energi bagi yang berasal dari kalangan konsumen energi,</td>
                                            </tr>
                                            <tr>
                                                <td>b.</td>
                                                <td>Berusia paling rendah 45 (empat puluh lima) tahun pada saat pendaftaran;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>c.</td>
                                                <td>Diusulkan secara tertulis oleh lembaga pendidikan, organisasi profesi,
                                                    atau asosiasi yang telah berdiri paling sedikit 5 (lima) tahun dan
                                                    memiliki keterkaitan langsung dengan kegiatan di bidang supply, demand,
                                                    distribusi, dan/ atau pemanfaatan energi yang dibuktikan dengan salinan
                                                    AD/ ART atau akta pendirian, dan/ atau direkomendasikan oleh 3 (tiga)
                                                    pakar di bidang energi;</td>
                                            </tr>
                                            <tr>
                                                <td>d.</td>
                                                <td>Bagi peserta yang dinyatakan lulus seluruh tahapan Penyaringan Calon APK
                                                    DEN Periode 2020-2025, wajib menandatangani <b>Surat Pernyataan Tidak
                                                        Rangkap Jabatan</b> bermeterai Rp 10.000,-.</td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary card-outline">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            3. Persyaratan Administrasi
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat
                                        massa quis enim.
                                    </div>
                                </div>
                            </div>
                            <div class="card card-warning card-outline">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            4. Tata Cara Pendaftaran
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapseFour" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                                    </div>
                                </div>
                            </div>
                            <div class="card card-warning card-outline">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            6. Tahapan Penyaringan
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapseFive" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis
                                        eu pede mollis pretium.
                                    </div>
                                </div>
                            </div>
                            <div class="card card-warning card-outline">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            7. Tata Cara Pengajuan Lamaran
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapseSix" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                        eleifend tellus.
                                    </div>
                                </div>
                            </div>
                            <div class="card card-danger card-outline">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseSeven">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            8. Pelaksanaan Penyaringan
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapseSeven" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>
            </div>
        </div>
    </div>
@endsection
