@extends('front-office.layouts.master')

@section('content')

<!-- START HOME -->
<section class="bg-home" id="home">
    <div class="home-bg-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3 class="home-heading mt-5 pt-5">Une plateforme dédiée aux jeunes porteurs de projets</h3>
                <p class="home-subtitle mx-auto mt-3 f-17">AVous êtes tentés par créer votre entreprise ? A la recherche d’une idée ou d’un accompagnement ? IRCHAD est votre nouvelle plateforme digitale qui vous accompagne dans votre réflexion, de l’idée à la mise en marché.<div class="home-button mt-4">
                    <a href="a-propos" class="btn btn-outline-white mt-3 mr-3">En savoir plus</a>
                    <a href="project-submission" class="btn btn-custom mt-3">Soumissionner un projet maintenant</a>
                </div>
                <div class="home-img">
                    <img src="images/front-office/home-macbook.png" alt="" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END HOME -->

<!-- START CLIENT -->
<section class="section bg-light">
    <div class="container">

        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="text-center">
                    <div class="client-images mt-5">
                        <img src="images/front-office/client-brand/img-4.png" alt="" class="img-fluid mx-auto d-block">
                    </div>
                    <div class="client-images mt-5">
                        <img src="images/front-office/client-brand/img-4.png" alt="" class="img-fluid mx-auto d-block">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CLIENT -->

<!-- START HOW-IT-WORKS -->
<section class="section bg-white" id="how-it-works">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Un Programme à Valeur Ajoutée</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    {{-- <p class="title-desc text-muted line-height_1_8">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 text-center about-left-icon-1">
                <i class="mdi mdi-chevron-right"></i>
            </div>
            <div class="col-lg-6 text-center about-left-icon-2">
                <i class="mdi mdi-chevron-right"></i>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="about-box about-line text-center p-3 mt-4 ">
                    <div class="about-icon">
                        <i class="pe-7s-users text-custom"></i>
                    </div>
                    <div class="about-count">
                        <p class="mb-0">01</p>
                    </div>
                    <h5>Jeunesse</h5>
                    <p class="text-muted mt-3">Un programme visant spécifiquement les jeunes entre 18 et 35 ans.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="about-box about-line text-center p-3 mt-4 ">
                    <div class="about-icon">
                        <i class="pe-7s-cash text-custom"></i>
                    </div>
                    <div class="about-count">
                        <p class="mb-0">02</p>
                    </div>
                    <h5>Revenu</h5>
                    <p class="text-muted mt-3">Amélioration des revenus des jeunes via le lancement d’une nouvelle génération d’initiatives.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="about-box text-center p-3 mt-4 ">
                    <div class="about-icon">
                        <i class="pe-7s-graph1 text-custom"></i>
                    </div>
                    <div class="about-count">
                        <p class="mb-0">03</p>
                    </div>
                    <h5>Économie</h5>
                    <p class="text-muted mt-3">Accélération de l’intégration des jeunes dans le tissu économique du pays.</p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="container">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="programme" class="btn btn-sm btn-custom">Découvrir le Programme <i class="mdi mdi-arrow-right pl-1"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- END HOW-IT-WORKS -->

<!-- START FEATURE-1 -->
<section class="section bg-light" id="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-4">
                    <h3 class="feature-title line-height_1_4">Quels avantages à soumissionner un projet ?</h3>
                    <div class="feature-border bg-custom"></div>

                    <div class="mt-5 p-2">
                        <div class="feature-icon float-left">
                            <i class="mdi mdi-check text-custom"></i>
                        </div>
                        <div class="ml-5">
                            <h5 class="f-18">Espace d'orientation</h5>
                            <p class="text-muted">Un espace d'accueil, d'écoute et d'orientation pour un accompagnement convivial et effectif.</p>
                        </div>
                    </div>

                    <div class="p-2">
                        <div class="feature-icon float-left">
                            <i class="mdi mdi-check text-custom"></i>
                        </div>
                        <div class="ml-5">
                            <h5 class="f-18">Mentors proactifs</h5>
                            <p class="text-muted">Un comité multidisciplinaire pour vous accompagner tout au long de votre projet et pour vous aider à atteindre vos objectifs.</p>
                        </div>
                    </div>

                    <div class="p-2">
                        <div class="feature-icon float-left">
                            <i class="mdi mdi-check text-custom"></i>
                        </div>
                        <div class="ml-5">
                            <h5 class="f-18">Démarches fluides</h5>
                            <p class="text-muted">Des démarches simples et fluides appuyées par les technologies de l'information les plus modernes.</p>
                        </div>
                    </div>

                    <div class="p-2">
                        <div class="feature-icon float-left">
                            <i class="mdi mdi-check text-custom"></i>
                        </div>
                        <div class="ml-5">
                            <h5 class="f-18">Soutien financier</h5>
                            <p class="text-muted">Un soutien financier pouvant aller jusqu'à 200.000 Dirhams par projet.</p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-lg-6">
                <div class="feature-img mt-4">
                    <img src="images/front-office/feature-1.jpg" class="img-fluid rounded" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END FEATURE-1 -->

<!-- START SCREENSHORT-->
{{-- <section class="section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Screenshot</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    <p class="title-desc text-muted">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>
                </div>
            </div>
        </div>

        <!-- Swiper -->
        <div class="row mt-5">
            <div class="col-lg-12 swiper-container pb-5">
                <div class="swiper-wrapper mt-4">
                    <div class="swiper-slide">
                        <img src="images/front-office/screenshot/screenshot-1.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="images/front-office/screenshot/screenshot-2.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="images/front-office/screenshot/screenshot-3.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="images/front-office/screenshot/screenshot-4.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="images/front-office/screenshot/screenshot-5.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="images/front-office/screenshot/screenshot-6.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="images/front-office/screenshot/screenshot-7.jpg" class="img-fluid" alt="">
                    </div>
                </div>

                <!-- Add Arrows  -->
                <div class="swiper-button-next">
                    <i class="mdi mdi-chevron-right"></i>
                </div>
                <div class="swiper-button-prev ">
                    <i class="mdi mdi-chevron-left"></i>
                </div>

            </div>
        </div>

    </div> --}}
</section>
<!-- END SCREENSHORT -->

<!-- START FEATURE-2 -->
{{-- <section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-4">
                    <h3 class="feature-title line-height_1_4">We love make things amazing and simple</h3>
                    <div class="feature-border bg-custom"></div>

                    <div class="mt-5 p-2">
                        <div class="feature-icon float-left">
                            <i class="mdi mdi-check text-custom"></i>
                        </div>
                        <div class="ml-5">
                            <h5 class="f-18">Marketing Performance</h5>
                            <p class="text-muted">Perspiciatis omnissit voluptatem laudantium totam denouncing pleasure unde explicabo.</p>
                        </div>
                    </div>

                    <div class="p-2">
                        <div class="feature-icon float-left">
                            <i class="mdi mdi-check text-custom"></i>
                        </div>
                        <div class="ml-5">
                            <h5 class="f-18">Marketing business</h5>
                            <p class="text-muted">Perspiciatis omnissit voluptatem laudantium totam denouncing pleasure unde explicabo.</p>
                        </div>
                    </div>

                    <div class="p-2">
                        <div class="feature-icon float-left">
                            <i class="mdi mdi-check text-custom"></i>
                        </div>
                        <div class="ml-5">
                            <h5 class="f-18">Creative ideas</h5>
                            <p class="text-muted">Perspiciatis omnissit voluptatem laudantium totam denouncing pleasure unde explicabo.</p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-lg-6">
                <div class="feature-img mt-4">
                    <img src="images/front-office/feature-2.jpg" class="img-fluid rounded" alt="">
                </div>

                <div class="feature-video">
                    <a href="https://vimeo.com/316299998" class="video-play-icon text-white text-center">
                        <i class="mdi mdi-play play-icon-circle play mx-auto"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- END FEATURE-2 -->

<!-- START TESTIMONIAL -->
{{-- <section class="section bg-white" id="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Our Testimonials</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    <p class="title-desc text-muted">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"><img src="images/front-office/testi/img-1.jpg" alt="" class=" testi-img img-fluid rounded mx-auto d-block"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"><img src="images/front-office/testi/img-2.jpg" alt="" class=" testi-img img-fluid rounded mx-auto d-block"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"><img src="images/front-office/testi/img-3.jpg" alt="" class=" testi-img img-fluid rounded mx-auto d-block"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testi text-center p-4">
                                <h5 class="testi-desc line-height_1_8 f-17 font-italic">The European languages are members of the same family Their separate existence is a myth For science, music, sport, etc, europe their pronunciation and their most European languages common words.</h5>
                                <h5 class="f-18 mt-4">Bernard Parsons</h5>
                                <p class="text-muted"> - CEO</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testi text-center p-4">
                                <h5 class="testi-desc line-height_1_8 f-17 font-italic">The European languages are members of the same family Their separate existence is a myth For science, music, sport, etc, europe their pronunciation and their most European languages common words.</h5>
                                <h5 class="f-18 mt-4">Michael Johnson</h5>
                                <p class="text-muted"> - Designer</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testi text-center p-4">
                                <h5 class="testi-desc line-height_1_8 f-17 font-italic">The European languages are members of the same family Their separate existence is a myth For science, music, sport, etc, europe their pronunciation and their most European languages common words.</h5>
                                <h5 class="f-18 mt-4">William Mooneyhan</h5>
                                <p class="text-muted"> - Developer</p>
                            </div>
                        </div>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- END TESTIMONIAL -->

<!-- START CTA -->
<section class="section bg-custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center">
                    <h3 class="text-white">En savoir plus sur le programme IRCHAD</h3>
                    {{-- <p class="f-16 mt-4 text-white">Pour nous contacter ou pour en savoir plus sur le programme IRCHAD</p> --}}
                    <div class="mt-5">
                        <a href="#" class="btn btn-outline-white text-uppercase"><i class="mdi mdi-information-outline"></i> Nous contacter maintenant</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CTA -->

<!-- START PRICING -->
{{-- <section class="section bg-white" id="pricing">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Our Pricing</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    <p class="title-desc text-muted">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="pricing-box bg-white mt-4">

                    <div class="p-4">
                        <div class="float-left">
                            <h4 class="mb-0">Basic</h4>
                            <p class="f-16">Per month</p>
                        </div>
                        <div class="text-right">
                            <h1>
                            <sup><small>$</small></sup>29</h1>
                        </div>

                        <div class="pricing-features mt-5">
                            <div class="mt-4">
                                <div class="pricing-icon float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6 text-muted">Neque porro tha quisquam dolorem psum quia dolor sit amet</p>
                            </div>

                            <div class="mt-4">
                                <div class="pricing-icon float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6 text-muted">Cumque nihil impedit quo minus id quod maxime placeat facere</p>
                            </div>

                            <div class="mt-4">
                                <div class="pricing-icon float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6 text-muted">Farum quidem rerum facilis est expedita distinctio</p>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <a href="#" class="btn btn-sm btn-outline">Order Now</a>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="pricing-box-active bg-white mt-4">

                    <div class="p-4">
                        <div class="float-left">
                            <h4 class="mb-0">Standard</h4>
                            <p class="f-16">Per month</p>
                        </div>
                        <div class="text-right">
                            <h1 class="text-custom">
                            <sup><small>$</small></sup>39</h1>
                        </div>

                        <div class="pricing-features mt-5">
                            <div class="mt-4">
                                <div class="pricing-icon-active float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6">Neque porro tha quisquam dolorem psum quia dolor sit amet</p>
                            </div>

                            <div class="mt-4">
                                <div class="pricing-icon-active float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6">Cumque nihil impedit quo minus id quod maxime placeat facere</p>
                            </div>

                            <div class="mt-4">
                                <div class="pricing-icon-active float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6">Farum quidem rerum facilis est expedita distinctio</p>
                            </div>

                            <div class="mt-4">
                                <div class="pricing-icon-active float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6">Tempora incidunt labo domagnam aliquam quaerat voluptatem</p>
                            </div>

                            <div class="mt-4">
                                <div class="pricing-icon-active float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6">Voluptatibus maiores alia doloribus asperiores repellat</p>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <a href="#" class="btn btn-sm btn-custom">Order Now</a>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="pricing-box bg-white mt-4">

                    <div class="p-4">
                        <div class="float-left">
                            <h4 class="mb-0">Amazing</h4>
                            <p class="f-16">Per month</p>
                        </div>
                        <div class="text-right">
                            <h1>
                            <sup><small>$</small></sup>49</h1>
                        </div>

                        <div class="pricing-features mt-5">
                            <div class="mt-4">
                                <div class="pricing-icon float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6 text-muted">Neque porro tha quisquam dolorem psum quia dolor sit amet</p>
                            </div>

                            <div class="mt-4">
                                <div class="pricing-icon float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6 text-muted">Cumque nihil impedit quo minus id quod maxime placeat facere</p>
                            </div>

                            <div class="mt-4">
                                <div class="pricing-icon float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6 text-muted">Farum quidem rerum facilis est expedita distinctio</p>
                            </div>

                            <div class="mt-4">
                                <div class="pricing-icon float-left mr-2 mb-4">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <p class="line-height_1_6 text-muted">Tempora incidunt labo domagnam aliquam quaerat voluptatem</p>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <a href="#" class="btn btn-sm btn-outline">Order Now</a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section> --}}
<!-- END PRICING -->

<!-- START FAQ -->
<section class="section bg-light" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Questions fréquemment posées</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    {{-- <p class="title-desc text-muted">because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p> --}}
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="mt-4">
                    <div class="faq-icon float-left">
                        <i class="mdi mdi-help-box text-custom h3"></i>
                    </div>
                    <div class="ml-5">
                        <h5 class="f-18">Qui peut soumissionner un projet ?</h5>
                        <p class="faq-answer text-muted">Tous les jeunes âgés entre 18 et 35 ans, en recherche active d’un emploi et qui ne pratiquent aucune activité dans le
                            secteur public ou privé. Les porteurs de projets doivent obligatoirement résider au sein de la Province de Al Hoceima</p>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="faq-icon float-left">
                        <i class="mdi mdi-help-box text-custom h3"></i>
                    </div>
                    <div class="ml-5">
                        <h5 class="f-18">Qui sont les candidats prioritaires ?</h5>
                        <p class="faq-answer text-muted">La priorité est attribué aux jeunes titulaires d’un diplôme universitaire ou de l’Office de la Formation
                            Professionnelle et de la Promotion du Travail (OFPPT), aux jeunes ayant une expérience antérieure dans un domaine particulier et n’ayant jamais
                            bénéficié des avantages du programme de l’INDH.</p>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="faq-icon float-left">
                        <i class="mdi mdi-help-box text-custom h3"></i>
                    </div>
                    <div class="ml-5">
                        <h5 class="f-18">Un projet validé est-il éditable ?</h5>
                        <p class="faq-answer text-muted">Oui. Vous pouvez compléter votre dossier ou le modifier tout en étant accompagné par nos experts et nos mentors.</p>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="faq-icon float-left">
                        <i class="mdi mdi-help-box text-custom h3"></i>
                    </div>
                    <div class="ml-5">
                        <h5 class="f-18">Qu’est-ce qui est considéré comme un projet innovant ?</h5>
                        <p class="faq-answer text-muted">L’innovation est toute chose nouvellement introduite. Toutes les innovations sont considérées (technologie, concept,
                            procédé, commercialisation etc.)</p>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="faq-icon float-left">
                        <i class="mdi mdi-help-box text-custom h3"></i>
                    </div>
                    <div class="ml-5">
                        <h5 class="f-18">Dois-je céder des parts sociales à IRCHAD et à l’INDH suite à leur contribution au financement du projet ?</h5>
                        <p class="faq-answer text-muted">Aucunement. IRCHAD et l’INDH sont des organismes à but non lucratif et dont la finalité est le dynamisme de la
                            croissance.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mt-4">
                    <div class="faq-icon float-left">
                        <i class="mdi mdi-help-box text-custom h3"></i>
                    </div>
                    <div class="ml-5">
                        <h5 class="f-18">Comment se fait la sélection des projets ?</h5>
                        <p class="faq-answer text-muted">Une fois que vous avez rempli le formulaire d’inscription, vos données sont vérifiées par nos équipes. Lorsque vos
                            données seront validées, vous serez convié à l’une de nos plateformes physiques pour un entretien. Si toutes vos informations sont cohérentes avec
                            votre profil et vos idées, des informations d’accès à notre plateforme virtuelle vous seront envoyées. Félicitation, votre projet est désormais
                            sélectionné.</p>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="faq-icon float-left">
                        <i class="mdi mdi-help-box text-custom h3"></i>
                    </div>
                    <div class="ml-5">
                        <h5 class="f-18">Les porteurs de projets doivent-ils contribuer financièrement au projet ?</h5>
                        <p class="faq-answer text-muted">Les porteurs de projets doivent contribuer à hauteur de 25% du coût total du projet sous forme de contribution en
                            nature ou en argent.</p>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="faq-icon float-left">
                        <i class="mdi mdi-help-box text-custom h3"></i>
                    </div>
                    <div class="ml-5">
                        <h5 class="f-18">A combien s’élève la contribution financière par IRCHAD et l’INDH ?</h5>
                        <p class="faq-answer text-muted">La contribution financière de IRCHAD et de l’INDH se limite à 100 000 Dirhams lorsque le porteur de projet est une
                            seule personne. Dans le cas où le projet est fondé par deux personnes ou plus, la contribution s’élève jusqu’à 200 000 Dirhams. Chaque projet doit
                            contribuer à la création d’au moins 5 emplois.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- END FAQ -->

<!-- START SUBSCRIBE -->
<section class="section bg-white">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3 class="title-heading">Bénéficiez du Programme IRCHAD</h3>
                    <span class="title-icon">
                    <i class="mdi mdi-dots-horizontal"></i>
                </span>
                    <p class="title-desc text-muted">Soumissionnez votre projet maintenant et bénéficiez d'un accompagnement sur mesure.
                    </p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="subcribe-form mt-4">
                    <form action="#">
                        <input placeholder="Entrer le titre de votre projet..." type="text">
                        <button type="submit" class="btn btn-custom">Commencer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SUBSCRIBE -->

@endsection
