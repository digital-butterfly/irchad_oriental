@extends('front-office.layouts.master')

@section('content')

<!-- START ABOUT-HEADER -->
<section class="bg-pages-title">
    <div class="home-bg-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center text-white">
                    <h1 class="text-white">Formations</h1>
                    <p class="mt-3 mb-0 text-uppercase">IRCHAD réunit un comité d'experts multidisciplinaire chargé de guider et de former les jeunes porteurs de projet.

                            Nos experts ont longuement abordé la question : "comment faire des jeunes d'aujourd'hui des managers performants ?"

                            Nous sommes convaincus que pour soutenir l'humain et contribuer au développement de l'économie, il est essentiel de munir les jeunes de compétences
                                utiles et ce grâce à une formation de qualité qui assure l'équilibre et le bon fonctionnement de tout un écosystème.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END ABOUT-HEADER -->


<!-- START SERVICES -->
{{--     <section class="section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Nous accompagnons les porteurs de projet dans leur évolution</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    <p class="title-desc text-muted">Le programme IRCHAD met à la disposition des jeunes porteurs de projet un accompagnement complet, dans un environnement
                        innovant et évolutif, allant de l'élaboration de l'idée initiale du projet jusqu'à sa mise en place sur le marché.

                        IRCHAD est un programme d'accompagnement, d'incubation et de financement. Notre but est de :
                    </p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-way text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">Orienter les porteurs d'idées grâce à des dispositifs d'écoute, de formation, de conseil et de financement</h5>
                    <p class="text-muted mt-3">Printing and typesetting been industrys standard dummy text ever since when unknown printer took galley type scrambled book.</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-wallet text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">Améliorer les revenus des jeunes</h5>
                    <p class="text-muted mt-3">Printing and typesetting been industrys standard dummy text ever since when unknown printer took galley type scrambled book.</p>
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-culture text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">Intégrer les jeunes dans le tissu économique du pays</h5>
                    <p class="text-muted mt-3">Printing and typesetting been industrys standard dummy text ever since when unknown printer took galley type scrambled book.</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-light text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">Résoudre des problématiques économiques et sociales</h5>
                    <p class="text-muted mt-3">Printing and typesetting been industrys standard dummy text ever since when unknown printer took galley type scrambled book.</p>
                </div>
            </div>

        </div>

    </div>
</section> --}}
<!-- END SERVICES -->

<!-- START TEAM -->
<section class="section bg-light" id="team">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Nos formations clés</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    {{-- <p class="title-desc text-muted">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p> --}}
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-3">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-1.jpg" class="img-fluid" alt="">
                    </div>
                    <h5 class="mt-4">Management</h5>
                    {{-- <p class="text-muted text-uppercase mt-2">- Ceo</p> --}}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-2.jpg" class="img-fluid" alt="">
                    </div>
                    <h5 class="mt-4">Marketing</h5>
                    {{-- <p class="text-muted text-uppercase mt-2">- Designer</p> --}}
                </div>
            </div>

            <div class="col-lg-3">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-3.jpg" class="img-fluid" alt="">
                    </div>
                    <h5 class="mt-4">Finance</h5>
                    {{-- <p class="text-muted text-uppercase mt-2">- Developer</p> --}}
                </div>
            </div>

            <div class="col-lg-3">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-4.jpg" class="img-fluid rounded" alt="">
                    </div>
                    <h5 class="mt-4">Digital</h5>
                    {{-- <p class="text-muted text-uppercase mt-2">- Manager</p> --}}
                </div>
            </div>

        </div>
    </div>
</section>
<!-- END TEAM -->

<!-- START CLIENT -->
{{-- <section class="section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-5">
                    <h3 class="title-heading">Our Client</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    <p class="title-desc text-muted line-height_1_8">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>

                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="text-center">
                    <div class="client-images mt-5">
                        <img src="images/front-office/client-brand/img-1.png" alt="" class="img-fluid mx-auto d-block">
                    </div>
                    <div class="client-images mt-5">
                        <img src="images/front-office/client-brand/img-2.png" alt="" class="img-fluid mx-auto d-block">
                    </div>
                    <div class="client-images mt-5">
                        <img src="images/front-office/client-brand/img-3.png" alt="" class="img-fluid mx-auto d-block">
                    </div>
                    <div class="client-images mt-5">
                        <img src="images/front-office/client-brand/img-4.png" alt="" class="img-fluid mx-auto d-block">
                    </div>
                    <div class="client-images mt-5">
                        <img src="images/front-office/client-brand/img-5.png" alt="" class="img-fluid mx-auto d-block">
                    </div>
                    <div class="client-images mt-5">
                        <img src="images/front-office/client-brand/img-6.png" alt="" class="img-fluid mx-auto d-block">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- END CLIENT -->

@endsection
