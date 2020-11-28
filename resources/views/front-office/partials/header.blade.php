@if(app()->getLocale()=='ar')
<style>
    header{
        /*direction: rtl;*/
    }

</style>
@endif
<header id="topnav" class="defaultscroll fixed-top navbar-sticky">
    <div class="container">
        <!-- Logo container-->
        <div>
            <a href="/" class="logo">
                <img src="images/front-office/logo-white.svg" alt="Logo Irchad" width="100px">
                <img src="images/front-office/logo-colorful.svg" alt="Logo Irchad" width="100px">
            </a>
        </div>
        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
{{--                <select class="selectpicker" onchange="if (this.value) window.location.href=this.value">--}}
{{--                    <option value="locale/ar">{{__('project-submission.Arabe')}}</option>--}}
{{--                    <option value="locale/ar">{{__('project-submission.Francais')}}</option>--}}
{{--                </select>--}}




                <li class="has-submenu">
                    <a href="a-propos">{{__('header.À Propos')}}</a>
                </li>
{{--                <li class="has-submenu">--}}
{{--                    <a href="formations">Formations</a>--}}
{{--                </li>--}}
                <li class="has-submenu">
                    <a href="programme">{{__('header.Programme')}}</a>
                </li>
                <li class="has-submenu">
                    <a href="project-submission">{{__('header.Soumissionner un projet')}}</a>
                </li>
                <li class="has-submenu">
                    <a href="faq">{{__('header.FAQ')}}</a>
                </li>
                <li class="has-submenu">
                    <a href="contact">{{__('header.Nous Contacter')}}</a>
                </li>

                    <li class="has-submenu last-elements">
                        <a>@if(app()->getLocale()=='ar')
                                العربية
                            @else
                                Francais
                            @endif
                        </a>
                        <span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('locale/en') }}" ><i class="fa fa-language"></i> {{__('project-submission.Francais')}}</a>
                            </li>
                            <li>
                                <a href="{{ url('locale/ar') }}" ><i class="fa fa-language"></i> {{__('project-submission.Arabe')}}</a>
                            </li>
                        </ul>
                    </li>

                {{-- <li class="has-submenu">
                    <a href="#pages">Pages</a>
                    <span class="menu-arrow"></span>
                    <ul class="submenu">
                        <li>
                            <a href="about.html">About Us</a>
                        </li>
                        <li>
                            <a href="blog-standard.html">Blog Standard</a>
                        </li>
                        <li>
                            <a href="blog-masonry.html">Blog-Masonry</a>
                        </li>
                        <li>
                            <a href="blog-post.html">Blog-Post</a>
                        </li>
                        <li>
                            <a href="typography.html">Typography</a>
                        </li>
                        <li>
                            <a href="icons.html">Icons</a>
                        </li>
                        <li>
                            <a href="contact.html">Contact Us</a>
                        </li>
                    </ul>
                </li> --}}

                <li>
                    <ul class="list-inline login-button pl-4">
                        <li class="list-inline-item mb-0 ">
                            <a href="login" class="btn btn-sm btn-login">{{__('header.Se Connecter')}}</a>
                        </li>
                    </ul>
                </li>


            </ul>

            <!-- End navigation menu-->
        </div>
    </div>
</header>
