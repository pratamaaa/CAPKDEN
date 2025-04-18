@extends('layout/main')
@section('content')
    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Kontak Kami</h6>
                        <h4>Dewan Energi Nasional</h4>
                        <h5 style="margin-top:-15px;">Sekretariat Jenderal</h5>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-dec">
                                    <img src="{{ asset('bs/assets/images/contact-dec-v3.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div id="map">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1976542827983!2d106.82752941532395!3d-6.23765906282019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3c2bb43b917%3A0xba600cb1460efcc!2sDewan+Energi+Nasional!5e0!3m2!1sid!2sid!4v1526453755722"
                                        width="100%" height="636px" frameborder="0" style="border:0"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="fill-form">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/phone-icon.png') }}"
                                                        alt="">
                                                    <a href="#">021-52921621</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/message.png') }}" alt="">
                                                    <a href="#">panselden@den.go.id</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/connections.png') }}"
                                                        alt="">
                                                    <a href="#">www.den.go.id</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ asset('bs/assets/images/location-icon.png') }}"
                                                        alt="">
                                                    <a href="#">Gedung Badan Pengembangan Sumber Daya Manusia
                                                        (BPSDM) ESDM Lt. 4 <br>
                                                        Jl. Jenderal Gatot Subroto Kav.49 Jakarta Selatan 12950</a>
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
@endsection
