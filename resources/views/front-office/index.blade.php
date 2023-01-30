
@extends('template')

@push('css')
    <link rel="stylesheet" href="{{ asset('slick/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/css/slick-theme.css') }}">
@endpush

@section('content')

    @if(session()->has('success'))
    <div class="container  px-20">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    </div>
    @endif
    

    <div class="container px-20" style="padding-bottom: 10% !important;">
        <div class="row align-items-center gx-7">
            <div class="col-lg-6">
                <h1 class="grandtitre">Une plateforme  <br>dédiée aux<span>  jeunes <br> porteurs de projets</span> 
                  
          
                <p class="descriptiongrandtitre mt-5">
            Êtes-vous tentés par la création de votre entreprise? Vous êtes à la recherche d’une idée ou d’un accompagnement? IRCHAD est votre nouvelle plateforme digitale qui vous accompagne dans votre réflexion, de l’idée à la mise en marché.
                
                </p>
                <div class="btn-wrap my-15 mb-7">
                    <a href="{{ route('projectSubmission') }}" class="btn btn-xl px-10 w300px btn-warning btn-custom me-4 mb-4"> {{ __('messages.Je soumissionne mon projet') }}</a>
                    <a href="{{ route('projectSubmission') }}" class="btn btn-xl btn-outline  border-2 w-225px btn-outline-primary btn-active-light-primary mb-4">{{ __('messages.Formulaire simplifié') }}</a>
                </div>
            </div>



            <div class="col-md-6 col-lg-6">
                 {{-- <div class="col-md-6 col-lg-6 float-end">
            
                   <img width="20" class="img-fluid2 rounded-3 float-end" src="{{ asset('images/cercles.png') }}" alt="">
                       <a style="width:200px;" href="{{ route('soumission.projet') }}" class="btn1 bb btn-xl w300px btn-warning2  me-4 mb-4">          
                                       <img style="margin-left:10%"  class=" img-fluid  float-start" src="{{ asset('images/data.png') }}"  alt="">
                                1.200.000 Dh</a>
                </div>


                  <div class="col-md-6 col-lg-6" >
  <a style="width:250px;" href="{{ route('soumission.projet') }}" class="btn2 bb btn-xl w300px btn-warning2  me-4 mb-4">          
                                       <img style="background-color:white;"  class=" img-fluid  float-start" src="{{ asset('images/cercles.png') }}"  alt="">
                                TAMWIL ACHARK</a>
                </div> 
                --}}
                <div class="welcome-img" style="position: relative;">
             {{-- <a style="position:absolute;margin-top:20% ;margin-left:78%"
              href="{{ route('soumission.projet') }}" class="btn1 bb   btn-warning2   mb-4">          
                                       <img  class="img-fluid" src="{{ asset('images/data.png') }}"  alt="">
                                1.200.000 Dh</a> --}}
                                  <a style="position:absolute;margin-top:20% ;margin-left:74%;display: inline-flex;"
              href="{{ route('projectSubmission') }}" class="btn1 bb   btn-warning2  ">          
                                       <img  class="img-fluid float-start" src="{{ asset('images/data.png') }}"  alt="">
                                    <p class="secondecriture">1.200.000 Dh</p></a>
                                  <a style="position:absolute;margin-top:60% ;margin-left:0% ;text-align:center;display: inline-flex;"
              href="{{ route('projectSubmission') }}" class="btn2 bb   btn-warning2  ">          
                                       <img  class="img-fluid float-start" src="{{ asset('images/cercles.png') }}"  alt="">
                             <p class="firstecriture"> Programme <br> <span class="secondecriture">TAMWIL ACHARK</span>   </p> </a>
                                
               <img class="img-fluid2 rounded  mx-auto d-block "  src="{{ asset('images/homepic1.png') }}" alt="">

                </div>

            </div> 



        </div>
    </div>

    <!-- Section 2 -->

    <div id="apropos" class="container px-20" >
        <div id="section1" class="row justify-content-center">
            <div class="col-md-12 col-lg-12 text-center">
                <h2 class="second-title__"> {{ __('messages.accompagnemt') }}
                  <span class="active-title"> {{ __('messages.A') }}</span></h2>
                {{--                <p class="main-text mt-7">Lorem ipsum dolor sit amet consectetur. <br>Placerat faucibus varius quam suspendisse diam cursus quis.</p>--}}
            </div>
        </div>
        <div class="row mt-11">
            <div class="col-md-3 col-lg-3">
                <div class="card card-flush  bg-gradient text-light h-100 mb-5">
                    <div class="card-header mt-5">
                        <img width="58" src="{{ asset('images/svg/num1.svg') }}" alt="">
                    </div>
                    <div class="card-body py-5">
                        <h5 class="fs-5 text-light"> {{ __('messages.besoins') }}</h5>
                        <p> 
                            {{ __('messages.ds1') }}

             
                        </p>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-flush border border-gray-300   h-100 mb-1">
                    <div class="card-header mt-5">
                        <img width="58" src="{{ asset('images/svg/num2.svg') }}" alt="">
                    </div>
                    <div class="card-body py-5">
                        <h5 class="fs-5">  {{ __('messages.Formation') }}</h5>
                        <p>{{ __('messages.ds2') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-flush border  border-gray-300  h-100 mb-1">
                    <div class="card-header mt-5">
                        <img width="58" src="{{ asset('images/svg/num3.svg') }}" alt="">
                    </div>
                    <div class="card-body py-5">
                        <h5 class="fs-5"> {{ __('messages.acc') }} <span style="white-space: nowrap"> {{ __('messages.acc2') }}</span></h5>
                        <p>{{ __('messages.ds3') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-flush border border-gray-300  h-100">
                    <div class="card-header mt-5">
                        <img width="58" src="{{ asset('images/svg/num4.svg') }}" alt="">
                    </div>
                    <div class="card-body py-5">
                       <h5 class="fs-5"> {{ __('messages.a1') }} <span style="white-space: nowrap"> {{ __('messages.a2') }}</span></h5>
                        <p> {{ __('messages.ds4') }} </p>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <!-- Offre section -->
    <div class="container px20 pt-10 align-items-center mt-10">
        <div class="row mb-10">
<div class="col-md-6 ">              
      {{-- <img class="img-fluid2 rounded-3 mt-10 float-end" src="{{ asset('images/homepic2.png') }}" alt=""> --}}
         <div class="welcome-img2" style="position: relative;">
         
                                  <a style="position:absolute;margin-top:20% ;margin-left:4%"
              href="{{ route('projectSubmission') }}" class="btn1 bb btn-xxl   btn-warning2  ">          
                                       <img  class="img-fluid float-start" src="{{ asset('images/data.png') }}"  alt="">
                              <p class="secondecriture"> 1.200.000 Dh</p> </a>
                              
                                
               <img class="img-fluid2 rounded  mx-auto d-block "  src="{{ asset('images/homepic2.png') }}" alt="">

                </div>

</div>

<div class="col-md-6">
      <div class="row align-items-center ">
            <div class="col-md-12 col-lg-12 " style="margin-top:8%">
                <h2 class="second-title__">{{ __('messages.offrefin') }}</h2>
                <p class="main-text mt-7">{{ __('messages.bnjusqua') }} &nbsp;<br> <strong>{{ __('messages.prix') }} </strong>{{ __('messages.bnjusqua2') }} </p>
            </div>
  {{-- <div class="row justify-content-center gx-8">
  <div class="col-md-12 col-lg-12  mt-1">
                        <div class="card card-flush  border d-flex flex-row bg-gradient text-light h-100">
                            <div class="card-header">
                                <img width="64" src="{{ asset('images/svg/icon2.svg') }}" alt="">
                            </div>
                            <div class="card-body py-7 ps-0"  style="margin:10px;">
                                <p>{{ __('messages.intilak2') }}</p>
                            </div>
                        </div>
            </div>
            </div> --}}

                <div class="row justify-content-center gx-8">
   <div class="col-md-12 col-lg-12 mt-1">
                <div class="card card-flush border d-flex flex-row h-100">
                    <div class="card-header">
                          <img width="64" src="{{ asset('images/svg/icon2.svg') }}" alt="">
                    </div>
                    <div class="card-body py-7 ps-0"  style="margin:10px;">
                          <p>{{ __('messages.intilak2') }}</p>
                    </div>
                </div>
            </div>
            </div>

               <div class="row justify-content-center gx-8">
   <div class="col-md-12 col-lg-12 mt-1">
                <div class="card card-flush border d-flex flex-row h-100">
                    <div class="card-header">
                        <img width="64" src="{{ asset('images/svg/icon3.svg') }}" alt="">
                    </div>
                    <div class="card-body py-7 ps-0"  style="margin:10px;">
                        <p>{{ __('messages.intilak3') }}</p>
                    </div>
                </div>
            </div>
            </div>
            <div class="row justify-content-cente gx-8">
  <div class="col-md-12 col-lg-12  mt-1">
                <div class="card card-flush border  d-flex flex-row h-100">
                    <div class="card-header">
                        <img width="64" src="{{ asset('images/svg/icon1.svg') }}" alt="">
                    </div>
                    <div class="card-body py-7 ps-0" style="margin:10px;">
                   
                        <p>{{ __('messages.intilak') }}</p>
                    </div>
                </div>
            </div>
            </div>
             <div class="btn-wrap my-15 mb-7">
                    <a href="{{ route('projectSubmission') }}" class="btn btn-xl px-10 w300px btn-warning btn-custom me-4 mb-4"> {{ __('messages.Je soumissionne mon projet') }}</a>
                </div>
          
         
           
      
        </div>


</div>
        </div>
   
   
   

    </div>




    <div id="apropos" class="container px-20" >
       
        <div class="mt-11 regiondre">
            <div class="col-md-12 col-lg-11 ">
                <div class="text-light mb-5">
                    <div class="row erer">
                         <div class="col-md-6" >
                        <h1 style="color: white">Soyez le changement que vous recherchez.</h1>
                        <p style="color: white">Rejoignez notre programme et libérez le potentiel pour atteindre vos objectifs et avoir un impact positif dans le monde.</p>
                    </div>
                    <div class="col-md-2"></div>
                      <div class="col-md-4 mt-10  d-flex flex-row-reverse">
                              <a style="width:260px" href="{{ route('projectSubmission') }}" class="btn1 bb btn-xl w300px btn-warning2  me-4 mb-4">          
                                       <img style="padding-top: 6%;margin-left:2%"  class=" img-fluid  float-end" src="{{ asset('images/Arrow1.png') }}"  alt="">
                                Rejoindre le programme</a>
          
                      </div>

                    </div>
                </div>
            </div>
           
       
        </div>

        
    </div>

    <!-- Contact section --->
    <div class="container  px-20 mt-20 pb-15 bg-vector2 mt-6">
        <div class="row pt-10 mb-sm-7">
              <div id="section1" class="row justify-content-center">
            <div class="col-md-12 col-lg-12 text-center">
                <h2 class="second-title__"> Questions fréquemment posées
                 </h2>
                {{--                <p class="main-text mt-7">Lorem ipsum dolor sit amet consectetur. <br>Placerat faucibus varius quam suspendisse diam cursus quis.</p>--}}
            </div>
        </div>
        <div class="col-md-2"></div>
         <div id="faq" class="col-md-8 mb-sm-5 mb-xs-5 ">
               
                <div class="accordion accordion-flush mt-17" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="h-one">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#one" aria-expanded="false" aria-controls="flush-collapseThree">
                        1.A QUI S'ADRESSE CE PROGRAMME ?
                         {{-- Qui peut soumissionner un projet ?      --}}
                                            </button>
                        </h2>
                        <div id="one" class="accordion-collapse collapse" aria-labelledby="t-one" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{-- {{ __('messages.aqui2') }} --}}
                                {{-- FAQ.Toute personne majeure âgée entre 18 et 45 ans, en situation d'inactivité ou de sous-emploi, ou exerçant une activité entreprenariale ne dépassant pas les 12 mois. --}}
                            Jeunes diplômés / qualifiés porteurs de projet Auto-entrepreneurs inscrits au registre national Entrepreneurs Individuels personnes physiques n’ayant pas le statut d’auto-entrepreneurs Très Petites Entreprises y compris les commerçants  Artisans Agriculteurs Individuels et les Exploitants Agricoles  Entrepreneurs Individuels et TPE dans le monde rural  Très Petites Entreprises exportatrices Start-ups Coopératives

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-two">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#two" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                  2. QUELLES SONT LES CONDITIONS D'ÉLIGIBILITÉ  ?
                                  {{-- Comment se fait la sélection des projets ? --}}
                            </button>
                        </h2>
                        <div id="two" class="accordion-collapse collapse" aria-labelledby="t-two" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{-- Après soumission de votre projet, l'équipe IRCHAD procédera à l'étude de votre dossier selon les critères de faisabilité et d'innovation, et ce à travers une comission d'experts constituée en interne. --}}
                                 {{-- {{ __('messages.saqui') }} <br>
                                {{ __('messages.saqui2') }}  --}}
                                - Porteur d’idée ou entreprise en création avec un chiffre daffaires prévisionnel < 10MDH <br>
                                - Entreprise existante depuis moins de 5 ans et développant un Chiffre d’affaires < 10MDH. Sont dispensé de la condition d’ancienneté, les projets agricoles et les entreprises exportatrices vers Afrique.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-three">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#three" aria-expanded="false" aria-controls="flush-collapseTwo">
                             3.QUELLES GARANTIES ?
                              {{-- Quels sont les critères d'éligibilité fixés pour la sélection de projets ? --}}
                            </button>
                        </h2>
                        <div id="three" class="accordion-collapse collapse" aria-labelledby="t-three" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{-- {{ __('messages.saqui3') }}  --}}
                                {{-- Les projets doivent répondre à des critères d'éligibilité d'ordre économique (création de valeur ajoutée, stabilité de revenus...), social (création d'emplois, conditions de travail, amélioration du statut de la femme...) et environnemental (conservation des ressources naturelles, maintien de la biodiversité...) --}}
Aucune garantie personnelle Garanties liées au projet (local, matériel, fonds de commerce). Aucune garantie personnelle n’est engagée sous forme notamment de caution


                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-four">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#four" aria-expanded="false" aria-controls="flush-collapseThree">
                            4. COMMENT FAIRE POUR BÉNÉFICIER DE CE FINANCEMENT ?
                            {{-- Quels projets sont considérés comme non éligibles? --}}
                            </button>
                        </h2>
                        <div id="four" class="accordion-collapse collapse" aria-labelledby="t-four" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{-- Ne sont pas éligibles les projets qui nuisent à l'environnement ou ceux soumis par des fonctionnaires, des agents des établissements publics ou des salariés du secteur privé, ainsi que les projets dont les porteurs ont déjà bénéficié individuellement ou dans le cadre de groupement d'un financement public y compris dans le cadre d'autres programmes gouvernementaux. --}}
1- Inscription sur notre site irchad.oriental.ma <br>
2- Rendez-vous dans nos bureaux :<br>

                                {{-- {{ __('messages.insc') }} <br> --}}
                                {{-- <a href="" style="color: grey; font-size:15px">
                                    {{ __('messages.siteweb') }}
                                  </a> --}}
{{--                                {{ __('messages.rndv') }}--}}
                    <ul>
                                 {{-- <li> {{ __('messages.rndv1') }}</li>
                                 <li>{{ __('messages.rndv2') }}</li>
                                    <li>{{ __('messages.rndv3') }} </li> --}}
                             </ul>
                            {{ __('messages.rens') }} <a href="mailto:contact@ofok.ma" class="fw-bold">oriental@irchad.ma</a>
                            </div>
                        </div>
                    </div>
                      {{-- <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-fin">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#fin" aria-expanded="false" aria-controls="flush-collapseThree">
                         5. Le porteur de projet pourrait-il bénéficier d'un accompagnement avant la création de son entrepise?
                            </button>
                        </h2>
                        <div id="fin" class="accordion-collapse collapse" aria-labelledby="t-fin" data-bs-parent="#accordionFlushExample">
                            <div id="fin" class="accordion-collapse collapse" aria-labelledby="t-fin" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Effectivement, après la sélection de votre projet, l'équipe IRCHAD procèdera à l'organisation des sessions à plein temps de renforcement, d'orientation et de profilage des porteurs de projets. Il s'agit principalement de l'accueil, l'écoute, l'orientation, la réalisation des études nécessaires (de marché, de montage de projet, de faisabilité, d'aide à l'établissement du Business plan ainsi que sur les aspects budgétaires et juridiques).


                               {{ __('messages.saqui3') }}  
                        </div>
                        </div>
                        </div>
                    </div> --}}

                </div>
            </div>
               <div class="col-md-2"></div>
            {{-- <div id="faq" class="col-md-6 mb-sm-5 mb-xs-5">
               
                <div class="accordion accordion-flush mt-17" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="h-five">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#five" aria-expanded="false" aria-controls="flush-collapseThree">
                         6. Le porteur de projet pourrait-il bénéficier d'un accompagnement après la création de son entreprise?                      </button>
                        </h2>
                        <div id="five" class="accordion-collapse collapse" aria-labelledby="t-one" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Le porteur de projet bénéficiera d'un accompagnement post-création qui se fera à travers un coaching incluant des formations pratiques et un accompagnement individuel et en groupe. Il couvrira en priorité les compétences de gestion essentielles à la bonne conduite du projet, à savoir la gestion financière, la gestion de trésorerie, le marketing, le démarchage d'opportunités d'affaires, la commercialisation, l'accompagnement à la conduite des formalités administratives, ainsi que les aptitudes comportementales (soft-skills).


                          
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-six">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#six" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                 7. Mon projet est en activité depuis moin de 12 mois, pourrais-je bénéficier d'un accompagnement?
                            </button>
                        </h2>
                        <div id="six" class="accordion-collapse collapse" aria-labelledby="t-six" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"> 
                                Tout à fait. Si votre projet est en activité depuis moin de 12 mois, vous pouvez bénéficier d'un accompagnement en post-création (voir Q.6).

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-seven">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#seven" aria-expanded="false" aria-controls="flush-collapseTwo">
                            8. Un projet validé est-il éditable ?
                            </button>
                        </h2>
                        <div id="seven" class="accordion-collapse collapse" aria-labelledby="t-seven" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            
                                                                Les contributions du poteur de projet sont de l'ordre de 40% du coût total du projet (20% en numéraire et 20% en nature) et dont l'appréciation est laissée au CPDH.

                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-eight">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#eight" aria-expanded="false" aria-controls="flush-collapseThree">
9.A combien s’élève la contribution financière par l’INDH ?
                            </button>
                        </h2>
                       <div id="eight" class="accordion-collapse collapse" aria-labelledby="t-seven" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                        
Un fond d'amorçage est octroyé l'INDH aux porteurs de projets plafonné à 100.000,00 DH par projet, représentant 60% du montant de l'investissement projeté.



                        </div>
                        </div>
                    </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-nine">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#nine" aria-expanded="false" aria-controls="flush-collapseThree">
10.Dois-je céder des parts sociales à l’INDH suite à sa contribution au financement du projet ?
                            </button>
                        </h2>
                       <div id="nine" class="accordion-collapse collapse" aria-labelledby="t-nine" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">

Aucunement. l’INDH est un organisme à but non lucratif et dont la finalité est le dynamisme de la croissance.


                   
                        </div>
                        </div>
                    </div>
                </div>
            </div> --}}
 <!-- Partenaires section -->
 <div class="container  px-20">
    <div class="row mb-10">
        <div class="col-md-12 col-lg-12 text-center">
            <h2 class="second-title__">{{ __('messages.Partenaires') }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="slider multiple-items">
                @for($i = 1; $i <= 4; $i++)
                <div style="height: 100px">
                    <img class="img-fluid mx-auto" src="{{ asset('images/logos/').$i.'.png' }}" alt=""
                         style="height: 100px; object-fit: contain; object-position: center; width: 100%"
                    >
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

        </div>
        
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('slick/js/slick.js') }}"></script>
    <script>
        $('.multiple-items').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            prevArrow: '<button class="border-0 bg-transparent slick-prevArrow z-index-3"><i class="fal fa-arrow-circle-left text-primary fa-2x"></i></button>',
            nextArrow: '<button class="border-0 bg-transparent slick-nextArrow z-index-3"><i class="fal fa-arrow-circle-right text-primary fa-2x"></i></button>'
        });
    </script>
@endpush


