
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
         <div id="faq" class="col-md-6 mb-sm-5 mb-xs-5 ">
               
                <div class="accordion accordion-flush mt-17" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="h-one">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#one" aria-expanded="false" aria-controls="flush-collapseThree">
                      1. من بإمكانه تقديم مشروع؟                   </button>
                        </h2>
                        <div id="one" class="accordion-collapse collapse" aria-labelledby="t-one" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                             جميع الأشخاص الذين تتراوح أعمارهم بين 18 و 45 سنة، الذين لا يمارسون أي نشاط مهني، أو الذين أطلقوا مشروعهم في مدة لا تقل عن 12 شهرا. ..


                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-two">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#two" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                 2.كيف يتم اختيار المشاريع؟
                            </button>
                        </h2>
                        <div id="two" class="accordion-collapse collapse" aria-labelledby="t-two" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                بعد تقديمك لمشروعك، سيشرع فريق إرشاد في دراسته، و دراسة المعايير الأهلية و لإبتكارية للمشوع، و ذلك من خلال هيئة خاصة سيتم تكوينها داخليا.


                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-three">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#three" aria-expanded="false" aria-controls="flush-collapseTwo">
                            3.ما هي المعايير المعتمدة في اختيار المشاريع؟
                            </button>
                        </h2>
                        <div id="three" class="accordion-collapse collapse" aria-labelledby="t-three" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                               يجب على المشاريع أن تستوجب للشروط الإقتصادية ( خلق القيمة المضافة، استقرار الدخل...)، الإجتماعية (خلق فرص الشغل، تحسين ظروف العمل، تحسين وضع المرأة...) و البيئية ( الحفاظ على الموارد الطبيعية و التنوع البيولوجي).


                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-four">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#four" aria-expanded="false" aria-controls="flush-collapseThree">
4.ما هي المشاريع التي تعتبر غير مؤهلة؟
                            </button>
                        </h2>
                        <div id="four" class="accordion-collapse collapse" aria-labelledby="t-four" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                              تعتبر غير مؤهلة كل المشاريع التي تضر بالبيئة أو تلك المقدمة من قبل الموظفين والوكلاء بالقطاع العام، أو الموظفين بالقطاع الخاص، أو أي مشروع استفاد حامله من دعم خاص أو دعم مالي عام في إطار أحد البرامج الحكومية.


                                {{-- <a href="" style="color: grey; font-size:15px">
                                    {{ __('messages.siteweb') }}
                                  </a> --}}
{{--                                {{ __('messages.rndv') }}--}}
{{--                                <ul>--}}
{{--                                    <li> {{ __('messages.rndv1') }}</li>--}}
{{--                                    <li>{{ __('messages.rndv2') }}</li>--}}
{{--                                    <li>{{ __('messages.rndv3') }} </li>--}}
{{--                                </ul>--}}
{{--                                {{ __('messages.rens') }} <a href="mailto:contact@ofok.ma" class="fw-bold">contact@ofok.ma</a>--}}
                            </div>
                        </div>
                    </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-fin">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#fin" aria-expanded="false" aria-controls="flush-collapseThree">
5.هل يمكن لحامل المشروع أن يستفيد من مواكبة قبل إنشاء مشروعه؟
                            </button>
                        </h2>
                        <div id="fin" class="accordion-collapse collapse" aria-labelledby="t-fin" data-bs-parent="#accordionFlushExample">
                            <div id="fin" class="accordion-collapse collapse" aria-labelledby="t-fin" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                "بالتأكيد، بعد اختيار مشروعك، سيقوم فريق إرشاد بتنظيم دورات تكوينية مخصصة لتعزيز المشروع والتوجيه و التنميط لكافة حملة المشاريع. و تخص هذه المواكبة الإستقبال، الإستماع، التوجيه، المساعدة على إجراء الدراسات الأساسية (دراسة السوق، إعداد المشروع، دراسة إمكانية نجاح المشروع، المساعدة على إعداد خطة العمل و جميع الجوانب القانونية و تلك المتعلقة بالميزانية).


                                {{-- {{ __('messages.saqui3') }}  --}}
                        </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="faq" class="col-md-6 mb-sm-5 mb-xs-5">
               
                <div class="accordion accordion-flush mt-17" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="h-five">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#five" aria-expanded="false" aria-controls="flush-collapseThree">
6.هل يمكن لحامل المشروع أن يستفيد من المواكبة بعد إنشاء مشروعه؟
                        </h2>
                        <div id="five" class="accordion-collapse collapse" aria-labelledby="t-one" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                نعم، يمكن لحامل المشروع أن يستفيد من المواكبة بعد إنشاء مشروعه. سيتم تنظيم دورات تطبيقية و حصص مواكبة جماعية و فردية. و ستعطى الأسبقية لمؤهلات التسيير الأساسية للمشروع، مثل التدبير المالي و المحاسباتي، التسويق، استطلاع الفرص التجارية، تقنيات البيع، دعم السير الجيد للإجراءات الإدارية و المهارات السلوكية.


                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-six">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#six" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
7.أنشأت مشروعي قبل 12 شهرا أو أقل. ها يمكنني الإستفادة من المواكبة؟
                            </button>
                        </h2>
                        <div id="six" class="accordion-collapse collapse" aria-labelledby="t-six" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"> 
                               أكيد. إذا كان عمر مشروعك 12 شهرا أو أقل، يمكنكم الإستفادة من برنامج المواكبة بعد الإنشاء. (أنظر السؤال 6)


                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-seven">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#seven" aria-expanded="false" aria-controls="flush-collapseTwo">
8.هل يمكن إحداث تغييرات على مشروع تمت المصادقة عليه مسبقا؟
                            </button>
                        </h2>
                        <div id="seven" class="accordion-collapse collapse" aria-labelledby="t-seven" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
يساهم حامل المشروع فيما يعادل %40 من التكلفة الإجمالية للمشروع (%20 نقدا و %20 عينية). ويرجع التقييم النهائي إلى الهيئة الإقليمية للتنمية البشرية.

                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-eight">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#eight" aria-expanded="false" aria-controls="flush-collapseThree">
9.ماهو مقدار المساهمة المالية المقدمة من طرف المبادرة الوطنية للتنمية البشرية؟
                            </button>
                        </h2>
                       <div id="eight" class="accordion-collapse collapse" aria-labelledby="t-seven" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
تخصص المبادرة الوطنية للتنمية البشرية مبلغ 100.000 درهم لبدأ تشغيل المشروع، أي ما يعادل %60 من الكلفة الإستثمارية المخطط لها.

                        </div>
                        </div>
                    </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header text-uppercase" id="t-nine">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#nine" aria-expanded="false" aria-controls="flush-collapseThree">
10.هل يصبح إلزاميا مشاركة حصة من المقاولة مع المبادرة الوطنية للتنمية البشرية عند الإستفادة<br>  من تمويل لمشروعي؟
                            </button>
                        </h2>
                       <div id="nine" class="accordion-collapse collapse" aria-labelledby="t-nine" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                لا. بل المبادرة الوطنية للتنمية البشرية منظمة غير ربحية تعمل على تحريك عجلة الإقصاد و مواكبة النمو.


                                {{-- {{ __('messages.saqui7') }}  --}}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
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
