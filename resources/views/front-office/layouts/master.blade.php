<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IRCHAD</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Landinghub" />

    <link rel="shortcut icon" href="images/front-office/favicon.ico">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700" rel="stylesheet">

    <!-- Pe-icon-7 icon -->
    <link rel="stylesheet" type="text/css" href="css/front-office/pe-icon-7-stroke.css">

    <!-- Bootstrap core CSS -->
        @if(app()->getLocale()=='en')
        <link rel="stylesheet" href="css/front-office/bootstrap.min.css" type="text/css">
    @elseif(app()->getLocale()=='ar')
        <link rel="stylesheet" href="css/front-office/rtl/bootstrap.min.css" type="text/css">
@endif

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="css/front-office/materialdesignicons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==" crossorigin="anonymous" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/front-office/swiper.min.css">

    <!-- magnific pop-up -->
    <link rel="stylesheet" type="text/css" href="css/front-office/magnific-popup.css" />

    <!--Slider-->
    <link rel="stylesheet" href="css/front-office/owl.carousel.css" />
    <link rel="stylesheet" href="css/front-office/owl.theme.css" />
    <link rel="stylesheet" href="css/front-office/owl.transitions.css" />

    <!-- MENU CUSTOM css -->
    @if(app()->getLocale()=='en')
        <link rel="stylesheet" type="text/css" href="css/front-office/menu.css">
    @elseif(app()->getLocale()=='ar')
        <link rel="stylesheet" type="text/css" href="css/front-office/rtl/menu.css">
    @endif


    <!-- Custom  Css -->

    @if(app()->getLocale()=='ar')
        <link rel="stylesheet" type="text/css" href="css/front-office/rtl/style.css" />
        <style>
            body{
                direction: rtl;
            }

        </style>
    @else
        <link rel="stylesheet" type="text/css" href="css/front-office/style.css" />
    @endif
    <style>
        .test{
            position: absolute;
            z-index: 9;
            top: 90px;
        }
 .modal-content {
    background-color: #795af1;
    margin: auto;
    padding: 0 20px 20px 20px;
    max-width: 550px;
    border: 1px solid #888;
    width: 80%;
    z-index: 9999;
}



.modal {
      position: fixed;
    z-index: 9999;
    padding-top: 120px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
   
}

.img{
    position:relative;
   width:100%
   

   

}
    </style>

</head>

<body>
   <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
       <a href="{{ route('getfile','progammeEss.pdf') }}"><img src="images/front-office/popup03.jpg" class="img"></a>
            <div class="card text-center flex flex-col " style="background:white; margin:3px; padding:4px;  border-radius : 5px;">
              <div class="flex news-body">
                <a style=" margin:4px; padding:10px;"
                href="{{ route('getfile','doc1.docx') }}" download   
                >
                 <b class="font-19-700 text-left " style="padding:10px;" >إستمارة الترشح خاصة بالتعاونيات</b>
                  <img src="images/front-office/telechargement.svg" alt="" class="ml3" />
                </a>
                 
                 
              </div>
            </div>
       <div class="card text-center flex flex-col "style="background:white; margin:3px; padding:4px;  border-radius : 5px;">
              <div class="flex news-body ">
                <a style=" margin:4px;"
                href="{{ route('getfile','doc2.docx') }}" download
                  class="primary-title font-13-500 flex flex-row align-center"
                >
                 <b class="font-19-700 text-left"  style="padding:10px;">إستمارة الترشح خاصة بالشركات</b>
                  <img src="images/front-office/telechargement.svg" alt="" class="ml3" />
                </a>
                 
                 
              </div>
            </div>
            <div class="card text-center flex flex-col " style="background:white; margin:3px; padding:4px;  border-radius : 5px;">
              <div class="flex news-body ">
               
               
               
               
                <a style=" margin:4px;"
                href="{{ route('getfile','doc3.docx') }}" download
                  class="primary-title font-13-500 flex flex-row align-center"
                >
                 <b class="font-19-700 text-left"  style="padding:10px;">استمارة الترشخ خاصة بالمقاول الذاتي والشباب</b>
                  <img src="images/front-office/telechargement.svg" alt="" class="ml3" />
                </a>
                 
                 
              </div>
            </div>
      </div>
    
    </div>
 

    @include('front-office.partials.header')
<div class="container">

    <div class="test dropdown show">
        <a class="btn btn-sm btn-login dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if(app()->getLocale()=='ar')
                <span class="flag-icon flag-icon-ma"></span>         العربية
            @else
                <span class="flag-icon flag-icon-fr"></span>   Francais
            @endif
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a  class="dropdown-item" href="{{ url('locale/en') }}" ><i class="flag-icon flag-icon-fr"></i> {{__('project-submission.Francais')}}</a>
            <a  class="dropdown-item" href="{{ url('locale/ar') }}" ><i class="flag-icon flag-icon-ma"></i> {{__('project-submission.Arabe')}}</a>
        </div>
    </div>
</div>


    @yield('content')

    @include('front-office.partials.footer')

    <!-- JAVASCRIPTS -->
    <script src="js/front-office/jquery.min.js"></script>
    <script src="js/front-office/popper.min.js"></script>
    @if(app()->getLocale()=='en')
    <script src="js/front-office/rtl/bootstrap.min.js"></script>
    @elseif(app()->getLocale()=='ar')
    <script src="js/front-office/rtl/bootstrap.min.js"></script>
    @endif

    <script src="js/front-office/jquery.easing.min.js"></script>
    <script src="js/front-office/scrollspy.min.js"></script>
    <!-- owl-carousel -->
    <script src="js/front-office/owl.carousel.min.js"></script>
    <!-- Swiper JS -->
    <script src="js/front-office/swiper.min.js"></script>
    <!-- Magnific Popup -->
    <script src="js/front-office/jquery.magnific-popup.min.js"></script>
    <script src="js/front-office/app.js"></script>

    @yield('custom-js')
    <script>
      var modal = document.getElementById("myModal");
      // Get the button that opens the modal

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];
      // When the user clicks the button, open the modal 
   
        modal.style.display = "flex";

      // When the user clicks on <span> (x), close the modal
      span.addEventListener("click", function () {
        modal.style.display = "none";
      });

      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
 </script>
</body>

</html>
