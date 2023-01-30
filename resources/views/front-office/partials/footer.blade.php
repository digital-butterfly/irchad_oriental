<footer class="footer mt-auto pt-3 bg-main text-gray-300">
    <div class="container py-18 px-20">
        <div class="row gx-7">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-3 mt-md-0 mt-lg-0 mt-8 logo-footer"
                         style="background-image: url('{{ asset('images/rectangle.png') }}');
                     background-repeat: no-repeat; height: 120px">
                        <img width="80" height="120" src="{{ asset('images/svg/logo_footer.svg') }}" alt="">
                    </div>
                    <div class="col-md-8 my-8 my-md-0 my-lg-0">
                        <p class="title fw-bold">{{ __('messages.moak') }}</p>
                        <p class="text-footer">
                            <p class="mt-4" style="text-align: justify;">
                               Lorem ipsum dolor sit amet consectetur. Aliquam dolor nibh volutpat venenatis ac. Iaculis in semper pellentesque blandit. In amet quam sed eget pharetra.
                    
                          
                            </p>    
                               <ul class="socialmedia">
                                <li>  <img  height="26" width="26" src="{{ asset('images/svg/Facebook.svg') }}"> </li>
                                 <li>   <img height="26" width="26"  src="{{ asset('images/svg/Instagram.svg') }}"> </li>
                                 <li>   <img height="26" width="26"   src="{{ asset('images/svg/Twitter.svg') }}"> </li>
                                 <li>   <img  height="26" width="26"  src="{{ asset('images/svg/LinkedIn.svg') }}"> </li>
{{--                                <li> {{ __('messages.rndv1') }}</li>--}}
{{--                                <li>{{ __('messages.rndv2') }}</li>--}}
{{--                                <li>{{ __('messages.rndv3') }} </li>--}}
                       </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <p class="footer-title">{{__('messages.liens_rapides')}}</p>
                <ul class="list-unstyled footer-menu footerul">
                    
                     <li >
                        <a style="color: white" data-id="apropos" aria-current="page" 
                        href="{{ route('projectSubmission') }}#section1"
                        >{{ __('messages.accueil') }}</a>
                    </li>
                     <li >
                        <a style="color: white" data-id="apropos" aria-current="page" 
                        href="{{ route('projectSubmission') }}#section1"
                        >{{ __('messages.Programme') }}</a>
                    </li>
                    {{-- <li >
                        <a style="color: white" data-id="apropos" aria-current="page" 
                        href="{{ route('accueil') }}#section1"
                        >{{ __('messages.apropos') }}</a>
                    </li> --}}
                    <li >
                        <a style="color: white" href="{{ route('projectSubmission') }}">{{ __('messages.soumettre_proj') }}</a>
                    </li>
                    <li >
                        <a data-id="faq"
                        href="{{ route('projectSubmission') }}#faq"  style="color: white"
                        >{{ __('messages.faq') }}</a>
                    </li>
                    <li>
                        <a  data-id="contact" 
                        
                        style="color: white"
                        href="{{ route('projectSubmission')}}#con ">{{ __('messages.contact') }}</a>
                    </li>

                    
                </ul>
            </div>
            <div class="col-md-2 col-6">
                <p class="footer-title text-uppercase" >{{__('messages.contacts')}}</p>
                <ul class="list-unstyled footer-menu footerul">
                    <li><img class="align-top me-2" src="{{ asset('images/svg/phone.svg') }}" alt="">+212567676767</li>
                    <li class="text-nowrap"><img class="align-top me-2" src="{{ asset('images/svg/mail.svg') }}" alt="">oriental@irchad.ma</li>
                    <li><img class="align-top me-2" src="{{ asset('images/svg/web.svg') }}" alt=""><a style="color:white;" href="">oriental.irchad.ma</a></li>
                </ul>
            </div>
             
            <div class="col-md-3 col-12">
                <p class="footer-title">{{ __('messages.Envoyer') }}</p>
               <p class="text-footer">{{ __('messages.abonner') }}</p>
                <form action="">
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg h-50px" placeholder="{{ __('messages.Votreemail') }} " name="" id="">
                    </div>
                    <button type="submit" class="btn btn-lg btn-form btn-warning bg-gradient w-100 h-50px">{{ __('messages.Envoyer') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container py-7 border-gray-700 border-top">
        <div class="d-flex justify-content-around w-md-50 w-lg-50 py-5 py-md-0 py-lg-0 mx-auto">
            {{-- <span class="text-muted text-center">{{ __('messages.footerdroit') }}</span> --}}
         <ul class="list-unstyled mb-0">
              <li class="d-inline-block me-4"><a class="text-light" href="#">2022 IRCHAD - Oriental. All right reserved.</a></li>
                <li class="d-inline-block me-4"><a class="text-light" href="#">Privacy Policy</a></li>
               <li class="d-inline-block me-4"><a class="text-light" href="#">Terms of Service</a></li>
               <li class="d-inline-block"><a class="text-light" href="#">Cookies Settings</a></li>
          </ul>
        </div>
    </div>
</footer>
