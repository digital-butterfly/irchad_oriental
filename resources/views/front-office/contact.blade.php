@extends('front-office.layouts.master')

@section('content')

<!-- START CONTACT-HEADER -->
<section class="bg-pages-title">
    <div class="home-bg-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center text-white">
                    <h1 class="text-white">Contactez Nous</h1>
                    {{-- <p class="mt-3 mb-0 text-uppercase">get in touch with us</p> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CONTACT-HEADER -->

<!-- START CONTACT -->
<section class="section pt-0 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-details text-center bg-white p-5 mt-3">
                    <div class="contact-icon">
                        <i class="pe-7s-map-marker text-custom"></i>
                    </div>
                    <h5 class="mt-2">Irchad@Home</h5>
                    <p class="text-muted mt-3">362 Oujda Avenue Salt Lake City, UT 84104</p>
                    <p class="text-muted mt-3">+01 656-525-125</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-details text-center bg-white p-5 mt-3">
                    <div class="contact-icon">
                        <i class="pe-7s-map-marker text-custom"></i>
                    </div>
                    <h5 class="mt-2">Irchad@Office</h5>
                    <p class="text-muted  mt-3">4779 Oujda Avenue Fayetteville, City NC 28306</p>
                    <p class="text-muted mt-3">+01 656-525-125</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-details text-center bg-white p-5 mt-3">
                    <h5 class="mt-2">Irchad@Contact</h5>
                    <div class="mt-4">
                        <p class="text-muted mb-2">Inquries:- <a href="" class="text-custom"> hello@irchad.in</a></p>
                        <p class="text-muted mb-2">Careers:- <a href="" class="text-custom"> hr@irchad.in</a></p>
                        <p class="text-muted mb-2">Media:- <a href="" class="text-custom"> pr@irchad.in</a></p>
                        <p class="text-muted mb-2">Support:- <a href="" class="text-custom"> help@irchad.in</a></p>
                    </div>
                    <div class="mt-4">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="#"><i class="mdi mdi-facebook facebook footer-social-icon"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="mdi mdi-twitter twitter footer-social-icon"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="mdi mdi-google google footer-social-icon"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="mdi mdi-apple apple footer-social-icon"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CONTACT -->

<!-- START CONTACT-FORM -->
<section class="section pt-0 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Formulaire de Contact</h3>
                <div class="custom-form mt-5">
                    <div id="message"></div>
                    <form method="post" action="php/contact.php" name="contact-form" id="contact-form">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="name" id="name" type="text" class="form-control" placeholder="Votre prénom...">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="last name" id="sarname" type="text" class="form-control" placeholder="Votre nom de famille...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Votre email...">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="number" id="number" type="number" class="form-control" placeholder="Votre téléphone...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea name="comments" id="comments" rows="7" class="form-control" placeholder="Votre message..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <input type="submit" id="submit" name="send" class="submitBnt btn btn-custom" value="Envoyer Message">
                                <div id="simple-msg"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- END CONTACT-FORM -->

@endsection