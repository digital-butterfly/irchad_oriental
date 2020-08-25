@extends('front-office.layouts.master')

@section('content')

<!-- START ABOUT-HEADER -->
<section class="bg-pages-title">
    <div class="home-bg-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center text-white">
                    <h1 class="text-white">Programme</h1>
                    <p class="mt-3 mb-0 text-uppercase">IRCHAD réunit un comité d'experts multidisciplinaire chargé de guider et de former les jeunes porteurs de projet.</p>
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
                    <h3 class="title-heading">Un programme simple, exhaustif et efficace</h3>
                    <span class="title-icon">
                        <i class="mdi mdi-dots-horizontal"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-display1 text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">Soumission du projet</h5>
                    <p class="text-muted mt-3">Inscription et validation du projet.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-portfolio text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">Incubation</h5>
                    <p class="text-muted mt-3">Incubation, formation et conseil.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="services-box text-center p-3 mt-4">
                    <div class="services-icon">
                        <i class="pe-7s-graph text-custom"></i>
                    </div>
                    <h5 class="mt-3 f-18">Mise en place sur le marché</h5>
                    <p class="text-muted mt-3">Financement pouvant atteindre 200 000 Dirhams et début de l'activité.</p>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- END SERVICES -->

<!-- START TEAM -->
<section class="section bg-light" id="team">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Des stratégies à court, à moyen et à long terme</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    {{-- <p class="title-desc text-muted">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p> --}}
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-1.jpg" class="img-fluid" alt="">
                    </div>
                    <h5 class="mt-4">Un établissement dédié</h5>
                    <p class="text-muted text-uppercase mt-2">Construction, aménagement et mise en service de laplateforme physique des jeunes de Al Hoceima pouraccompagnerles
                        jeunes actives.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-2.jpg" class="img-fluid" alt="">
                    </div>
                    <h5 class="mt-4">Un accompagnement rapproché</h5>
                    <p class="text-muted text-uppercase mt-2">Acquisition des ressources humaines nécessaires pour encourager la création de nouvelles entreprises par les
                        jeunes et pour faciliter l’auto-entreprenariat.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="mt-4 text-center">
                    <div class="team-img">
                        <img src="images/front-office/team/img-3.jpg" class="img-fluid" alt="">
                    </div>
                    <h5 class="mt-4">Une plateforme provisoire</h5>
                    <p class="text-muted text-uppercase mt-2">Mise à disposition d’ une plateforme provisoire dédiée à la réception des jeunes au sein du Centre Régional de Al Hoceima.</p>
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
