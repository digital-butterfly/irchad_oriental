
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
                <h1 class="grandtitre">منصة  <br> مخصصة ل<span>  الشباب <br> حاملي المشاريع</span> 
                  
          
                <p class="descriptiongrandtitre mt-5">
                      هل أنت مهتم ببدء عملك ؟ 
                 هل تبحث عن فكرة أو دعم؟ IRCHAD هي منصتك الرقمية الجديدة التي ترافقك في تفكيرك ، من الفكرة إلى التسويق.
                </p>
                <div class="btn-wrap my-15 mb-7">
                    <a href="{{ route('projectSubmission') }}" class="btn btn-xl px-10 w300px btn-warning btn-custom me-4 mb-4"> اقدم مشروعي</a>
                    <a href="{{ route('projectSubmission') }}" class="btn btn-xl btn-outline  border-2 w-225px btn-outline-primary btn-active-light-primary mb-4">اكتشف البرنامج</a>
                </div>
            </div>
            <div class="col-lg-6">
              


                      <div class="welcome-img" style="position: relative;">
             {{-- <a style="position:absolute;margin-top:20% ;margin-left:78%"
              href="{{ route('soumission.projet') }}" class="btn1 bb   btn-warning2   mb-4">          
                                       <img  class="img-fluid" src="{{ asset('images/data.png') }}"  alt="">
                                1.200.000 Dh</a> --}}
                                  <a style="position:absolute;margin-top:20% ;margin-left:0%;display: inline-flex;"
              href="{{ route('projectSubmission') }}" class="btn1 bb   btn-warning2  ">          
                                       <img  class="img-fluid float-start" src="{{ asset('images/data.png') }}"  alt="">
                                    <p class="secondecriture mt-4">1.200.000 درهم</p></a>
                                  <a style="position:absolute;margin-top:60% ;margin-right:68%;text-align:center;display: inline-flex;"
              href="{{ route('projectSubmission') }}" class="btn2 bb   btn-warning2  ">          
                                       <img  class="img-fluid float-start" src="{{ asset('images/cercles.png') }}"  alt="">
                             <p class="firstecriture"> برنامج <br> <span class="secondecriture">تمويل أشارك</span>   </p> </a>
                                
               <img class="img-fluid2 rounded  mx-auto d-block "  src="{{ asset('images/homepic1.png') }}" alt="">

                </div>
            </div>
        </div>
    </div>

    <!-- Section 2 -->

    <div id="apropos" class="container px-20" >
        <div id="section1" class="row justify-content-center">
            <div class="col-md-12 col-lg-12 text-center">
                <h2 class="second-title__">مواكبة
                  <span class="active-title"> شاملة</span>لمشاريعكم</h2>
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
                        <h5 class="fs-5 text-light"> تحديد الاحتياجات : 
</h5>
                        <p> 
                          نرافقك في تحديد احتياجاتك لتقديم دعم شخصي


             
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
                        <h5 class="fs-5"> تدريب : </h5>
                        <p>سنعمل معك على تعزيز معارفك التقنية والتنظيمية والإدارية لضمان نجاح مشروعك
</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-flush border  border-gray-300  h-100 mb-1">
                    <div class="card-header mt-5">
                        <img width="58" src="{{ asset('images/svg/num3.svg') }}" alt="">
                    </div>
                    <div class="card-body py-5">
                        <h5 class="fs-5"> المواكبة <span style="white-space: nowrap">القبلية : </span></h5>
                        <p> المواكبة القبلية: سوف تستفيد من دعم خاص لإعداد ملف التمويل',
</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-flush border border-gray-300  h-100">
                    <div class="card-header mt-5">
                        <img width="58" src="{{ asset('images/svg/num4.svg') }}" alt="">
                    </div>
                    <div class="card-body py-5">
                       <h5 class="fs-5">   دعم ما بعد  <span style="white-space: nowrap">التمويل  :</span></h5>
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
                                1.200.000 Dh</a>
                              
                                
               <img class="img-fluid2 rounded  mx-auto d-block "  src="{{ asset('images/homepic2.png') }}" alt="">

                </div>

</div>
<div class="col-md-6">
      <div class="row align-items-center ">
            <div class="col-md-12 col-lg-12 " style="margin-top:8%">
                <h2 class="second-title__">عرض التمويل</h2>
                <p class="main-text mt-7 me-10"> استفد من تمويل يصل إلى :&nbsp;<br> <strong>1.200.000 </strong>درهم بسعر فائدة تفضيلي  </p>
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
                          <p>قروض «انطلاق المستثمر القروي» : يمكن أن يصل المبلغ الى 1.200.000 درهم بنسبة 1,75% للمشاريع التي تمارس أنشطتها في المناطق القروية
</p>
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
                        <p>قروض الشرف 50.000 درهم بالنسبة للشركات التي استفادت من قرض استثماري انطلاق أو انطلاق المستثمر القروي أصغر من أو يساوي 300.000</p>
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
                   
                        <p>قروض الاستثمار و الاستغلال «انطلاق» : يمكن أن يصل المبلغ الى 1.200.000 درهم بنسبة 2% للمشاريع التي تمارس أنشطتها في المناطق الحضرية</p>
                    </div>
                </div>
            </div>
            </div>
             <div class="btn-wrap my-15 mb-7">
                    <a href="{{ route('projectSubmission') }}" class="btn btn-xl px-10 w300px btn-warning btn-custom me-4 mb-4 me-9">اقدم مشروعي</a>
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
                        <h1 style="color: white">كن التغيير الذي تسعى إليه.</h1>
                        <p style="color: white">انضم إلى برنامجنا وأطلق العنان لإمكانية تحقيق أهدافك وإحداث تأثير إيجابي في العالم.</p>
                    </div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3 mt-10  d-flex flex-row-reverse">
                              <a style="width:260px" href="{{ route('projectSubmission') }}" class="btn1 bb btn-xl w300px btn-warning2  me-4 mb-4">          
                                       <img style="padding-top: 6%;margin-left:2%"  class=" img-fluid  float-end" src="{{ asset('images/Arrow1.png') }}"  alt="">
                            اكتشف البرنامج</a>
          
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
                <h2 class="second-title__">  الأسئلة المتداولة
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
                        1.  لمن موجه هذا البرنامج ؟

                         {{-- Qui peut soumissionner un projet ?      --}}
                                            </button>
                        </h2>
                        <div id="one" class="accordion-collapse collapse" aria-labelledby="t-one" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{-- {{ __('messages.aqui2') }} --}}
                                {{-- FAQ.Toute personne majeure âgée entre 18 et 45 ans, en situation d'inactivité ou de sous-emploi, ou exerçant une activité entreprenariale ne dépassant pas les 12 mois. --}}
الشباب حاملي الشهادات / المؤهلين وحاملي المشاريع – المقاولون الذاتيون المسجلون في السجل الوطني- المقاولون الأفراد من الأشخاص الذاتيين الذين لا يتوفرون على صفة مقاول ذاتي – المقاولات الصغيرة جدا بما في ذلك التجار-الحرفيين-الفلاحين الأفراد و المزارعين- المقاولين الأفراد و المقاولات الصغيرة جدا في العالم القروي- المقاولات الصغيرة جدا المصدرة – المقاولات الناشئة – التعاونيات

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-two">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#two" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                  2. ما هي شروط الاستحقاق ؟

                                  {{-- Comment se fait la sélection des projets ? --}}
                            </button>
                        </h2>
                        <div id="two" class="accordion-collapse collapse" aria-labelledby="t-two" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{-- Après soumission de votre projet, l'équipe IRCHAD procédera à l'étude de votre dossier selon les critères de faisabilité et d'innovation, et ce à travers une comission d'experts constituée en interne. --}}
                                 {{-- {{ __('messages.saqui') }} <br>
                                {{ __('messages.saqui2') }}  --}}
حامل مشروع أو مقاولة قيد الإنشاء مع رقم معاملات توقعي يقل عن 10 مليون درهم مقاولة منشأة منذ أقل من 5 سنوات مع حجم مبيعات يقل عن 10 مليون درهم و يستثنى من هذه الشروط المشاريع الزراعية والشركات المصدرة لإفريقيا
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-three">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#three" aria-expanded="false" aria-controls="flush-collapseTwo">
                             3.  ما هي الضمانات ؟
                              {{-- Quels sont les critères d'éligibilité fixés pour la sélection de projets ? --}}
                            </button>
                        </h2>
                        <div id="three" class="accordion-collapse collapse" aria-labelledby="t-three" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{-- {{ __('messages.saqui3') }}  --}}
                                {{-- Les projets doivent répondre à des critères d'éligibilité d'ordre économique (création de valeur ajoutée, stabilité de revenus...), social (création d'emplois, conditions de travail, amélioration du statut de la femme...) et environnemental (conservation des ressources naturelles, maintien de la biodiversité...) --}}
لا يوجد ضمانات شخصية مرتبطة بالمشروع (مباني ، معدات الخ). لا يتم الالتزام بأي ضمان شخصي في شكل ضمان


                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-four">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#four" aria-expanded="false" aria-controls="flush-collapseThree">
                            4.   كيف أستفيد من هذا التمويل   ؟
                            {{-- Quels projets sont considérés comme non éligibles? --}}
                            </button>
                        </h2>
                        <div id="four" class="accordion-collapse collapse" aria-labelledby="t-four" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{-- Ne sont pas éligibles les projets qui nuisent à l'environnement ou ceux soumis par des fonctionnaires, des agents des établissements publics ou des salariés du secteur privé, ainsi que les projets dont les porteurs ont déjà bénéficié individuellement ou dans le cadre de groupement d'un financement public y compris dans le cadre d'autres programmes gouvernementaux. --}}
1- التسجيل على موقعنا  irchad.oriental.ma <br>
2- Rendez-vous dans nos bureaux :<br>

                                {{-- {{ __('messages.insc') }} <br> --}}
                                {{-- <a href="" style="color: grey; font-size:15px">
                                    {{ __('messages.siteweb') }}
                                  </a> --}}
{{--                                {{ __('messages.rndv') }}--}}
                    <ul>
                                 {{-- <li>. شارع علال بن عبد الله رقم 10 رياض فاس, شارع للا عائشة الطابق 4 المكتب رقم 21 (بجانب مقر الشرطة)
</li>
                                 <li>( CTM بجانب) عمارة 4 اقامة صراية ب3 شارع دمشق, مكناس
</li>
                                    <li>تازة : سكن شامة ، شارع قاصو مداح الطابق الثالث ، رقم 21, تازة
 </li> --}}
                             </ul>

                          لمرجو إيداع طلبكم عبر الرابط التالي أو ملئ استمارة المشروع و إرسالها عبر البريد الإلكتروني -3 <a href="mailto:contact@ofok.ma" class="fw-bold">oriental@irchad.ma</a>
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
        <script>
        console.log(message_err);
    </script>
    <script src={{ asset('js/index.js') }}></script>
    <script src="{{ asset('js/contact.js') }}"></script>
<script src="{{ asset('slick/js/slick.js') }}"></script>
   <script>
       $('.multiple-items').slick({
           infinite: true,
           slidesToShow: 3,
           slidesToScroll: 1,
           autoplay: true,
           rtl: true,
           autoplaySpeed: 2000,
           prevArrow: '<button class="border-0 bg-transparent slick-prevArrow z-index-3"><i class="fal fa-arrow-circle-left text-primary fa-2x"></i></button>',
           nextArrow: '<button class="border-0 bg-transparent slick-nextArrow z-index-3"><i class="fal fa-arrow-circle-right text-primary fa-2x"></i></button>'
       });
   </script>
@endpush
