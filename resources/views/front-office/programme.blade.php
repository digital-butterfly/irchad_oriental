@extends('front-office.layouts.master')

@section('content')

<!-- START ABOUT-HEADER -->
<section class="bg-pages-title">
    <div class="home-bg-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center text-white">
                    <h1 class="text-white">{{__('programme.Programme ARIEJ')}}</h1>
                    <p class="mt-3 mb-0">{{__('programme.Le programme ARIEJ est le 3ème programme relevant de la 3ème phase du déploiement de l’INDH 2019-2023. Il a été lancé par sa Majesté le Roi Mohammed VI que Dieu l’Assiste, le 19 septembre 2018. Ce programme vise spécifiquement à réussir l’intégration économique des jeunes et à l’amélioration de leur situation économique et sociale, à travers la mise en place d’un accompagnement complet dédié aux porteurs de projets, durant tout le processus de création d’entreprise.')}}</p>
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
                    <h3 class="title-heading">{{__('programme.ARIEJ consiste en le déploiement des 4 missions listées ci-après :')}}</h3>
                    <span class="title-icon">
                        <i class="mdi mdi-dots-horizontal"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-display1 text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">{{__('programme.1. Sensibilisation, orientation et information')}}</h5>
                    <p class="text-muted mt-3">{{__('programme.Écouter, informer, orienter et sensibiliser les jeunes aux opportunités offertes par l\'entreprenariat en tant que source de revenus et création d\'emplois. Les activités de sensibilisation seront fondamentales pour informer sur le programme et recruter des bénéficiaires potentiels des mécanismes.')}}</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-portfolio text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">{{__('programme.2. Appui Pré-création :')}}</h5>
                    <p class="text-muted mt-3">{{__('programme.Accompagner les jeunes porteurs de projets éligibles dans la préparation de leur projet, afin d’améliorer le niveau de préparation du projet et augmenter les chances de succès de leur activité (formation, appui…).')}}</p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-graph text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">{{__('programme.3. Appui à la création :')}}</h5>
                    <p class="text-muted mt-3">{{__('programme.Accompagner les jeunes dans le choix des structures juridiques adaptées à leurs profiles et aux spécificités de leurs projets.')}}'</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-culture text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">{{__('programme.4. Appui Post-création :')}}</h5>
                    <p class="text-muted mt-3">{{__('programme.Fournir un accompagnement technique aux jeunes entrepreneurs ayant effectivement démarré l’activité, pour améliorer les chances de succès de leur projet et augmenter le taux de survie des entreprises formelles créées.')}}'</p>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- END SERVICES -->

<!-- START TEAM -->
{{--<section class="section bg-light" id="team">--}}
{{--    <div class="container">--}}

{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="text-center">--}}
{{--                    <h3 class="title-heading">Des stratégies à court, à moyen et à long terme</h3>--}}
{{--                    <span class="title-icon">--}}
{{--                    <i class="mdi mdi-dots-horizontal"></i>--}}
{{--                </span>--}}
{{--                    --}}{{-- <p class="title-desc text-muted">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p> --}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row mt-5">--}}
{{--            <div class="col-lg-4">--}}
{{--                <div class="mt-4 text-center">--}}
{{--                    <div class="team-img">--}}
{{--                        <img src="images/front-office/team/img-1.jpg" class="img-fluid" alt="">--}}
{{--                    </div>--}}
{{--                    <h5 class="mt-4">Un établissement dédié</h5>--}}
{{--                    <p class="text-muted text-uppercase mt-2">Construction, aménagement et mise en service de laplateforme physique des jeunes de Al Hoceima pouraccompagnerles--}}
{{--                        jeunes actives.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4">--}}
{{--                <div class="mt-4 text-center">--}}
{{--                    <div class="team-img">--}}
{{--                        <img src="images/front-office/team/img-2.jpg" class="img-fluid" alt="">--}}
{{--                    </div>--}}
{{--                    <h5 class="mt-4">Un accompagnement rapproché</h5>--}}
{{--                    <p class="text-muted text-uppercase mt-2">Acquisition des ressources humaines nécessaires pour encourager la création de nouvelles entreprises par les--}}
{{--                        jeunes et pour faciliter l’auto-entreprenariat.</p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-4">--}}
{{--                <div class="mt-4 text-center">--}}
{{--                    <div class="team-img">--}}
{{--                        <img src="images/front-office/team/img-3.jpg" class="img-fluid" alt="">--}}
{{--                    </div>--}}
{{--                    <h5 class="mt-4">Une plateforme provisoire</h5>--}}
{{--                    <p class="text-muted text-uppercase mt-2">Mise à disposition d’ une plateforme provisoire dédiée à la réception des jeunes au sein du Centre Régional de Al Hoceima.</p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
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
