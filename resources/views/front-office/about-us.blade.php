@extends('front-office.layouts.master')

@section('content')

<!-- START ABOUT-HEADER -->
<section class="bg-pages-title">
    <div class="home-bg-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center text-white">
                    <h1 class="text-white">{{__('about.À Propos')}}</h1>
                    <p class="mt-3 mb-0 text-uppercase">{{__('about.IRCHAD est une solution digitale dédiée à l’entreprenariat, afin de créer votre entreprise en suivant un parcours intuitif et ergonomique,étape par étape. Il a été initié par l’association provinciale d’appui des activités de proximité (APAAP) de la province d\'Al Hoceima, afin de viabiliser les projets appuyés par l’INDH, dans le cadre du 3ème programme initié par l’INDH, « ARIEJ Amélioration du Revenu et Inclusion Économique des Jeunes ».')}}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END ABOUT-HEADER -->

<!-- START SERVICES -->
<section class="section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">{{__('about.IRCHAD est votre nouvelle boîte à outils digitale qui répond à vos besoins pour assurer le continuum de création de votre entreprise. À travers IRCHAD, nous allons :')}}</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
{{--                    <p class="title-desc text-muted">Le programme IRCHAD met à la disposition des jeunes porteurs de projet un accompagnement complet, dans un environnement--}}
{{--                        innovant et évolutif, allant de l'élaboration de l'idée initiale du projet jusqu'à sa mise en place sur le marché.--}}
{{--                    </p>--}}
                </div>
            </div>
        </div>



        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-way text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">{{__('about.Améliorer l’orientation des porteurs de projets surtout via le digital')}}</h5>
                    {{-- <p class="text-muted mt-3">Printing and typesetting been industrys standard dummy text ever since when unknown printer took galley type scrambled book.</p> --}}
                </div>
            </div>

            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-wallet text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">{{__('about.Faciliter l’intégration des jeunes dans le tissu économique de la province')}}</h5>
                    {{-- <p class="text-muted mt-3">Printing and typesetting been industrys standard dummy text ever since when unknown printer took galley type scrambled book.</p> --}}
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-culture text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">{{__('about.Assurer une meilleure coordination des offres d\'accompagnement à tous les stades de création de l’entreprise')}}</h5>
                    {{-- <p class="text-muted mt-3">Printing and typesetting been industrys standard dummy text ever since when unknown printer took galley type scrambled book.</p> --}}
                </div>
            </div>

            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-light text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">{{__('about.Résoudre les problématiques économiques et sociales de la province')}}</h5>
                    {{-- <p class="text-muted mt-3">Printing and typesetting been industrys standard dummy text ever since when unknown printer took galley type scrambled book.</p> --}}
                </div>
            </div>

        </div>

    </div>
</section>
<!-- END SERVICES -->

<!-- START TEAM -->
{{-- <section class="section bg-light" id="team">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Smart Team</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    <p class="title-desc text-muted">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-3">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-1.jpg" class="img-fluid" alt="">
                    </div>
                    <h5 class="mt-4">Albert Beaudoin</h5>
                    <p class="text-muted text-uppercase mt-2">- Ceo</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-2.jpg" class="img-fluid" alt="">
                    </div>
                    <h5 class="mt-4">Diana Jefferson</h5>
                    <p class="text-muted text-uppercase mt-2">- Designer</p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-3.jpg" class="img-fluid" alt="">
                    </div>
                    <h5 class="mt-4">Donald Johnson</h5>
                    <p class="text-muted text-uppercase mt-2">- Developer</p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-4.jpg" class="img-fluid rounded" alt="">
                    </div>
                    <h5 class="mt-4">Susan Roberson</h5>
                    <p class="text-muted text-uppercase mt-2">- Manager</p>
                </div>
            </div>

        </div>
    </div>
</section> --}}
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
