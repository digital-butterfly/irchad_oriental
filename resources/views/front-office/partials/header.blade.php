<nav class=" container  navbar navbar-expand-lg navbar-light bg-transparent">
    <div class="container ">
        <span class="navbar-brand">
            
            <a href="{{ route('accueil') }}"><img class="w-md-220px w-lg-240px w-180px"  src="{{ asset('images/svg/main_logo.svg') }}" alt=""></a>
            {{-- <a href="/app_casainvest/public"><img class="ms-9 w-md-300px w-lg-300px w-100px" src="{{ asset('images/svg/casainvest_logo.svg') }}" alt=""></a>--}}
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between mt-md-0 mt-lg-0 mt-4" id="navbarNav">
            <ul class="navbar-nav main-menu">
                <li class="nav-item anchors">
                    <a class="nav-link" data-id="accueil" aria-current="page" 
                    href="{{ route('accueil') }}"
                    >{{ __('messages.accueil') }}</a>
                </li>
                  <li class="nav-item anchors">
                    <a class="nav-link" data-id="Programme" aria-current="page" 
                   href="{{ route('accueil') }}#section1"
                    >{{ __('messages.Programme') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projectSubmission') }}">{{ __('messages.soumettre_proj') }}</a>
                </li>
                <li class="nav-item anchors">
                    <a class="nav-link" data-id="faq"
                    href="{{ route('accueil') }}#faq" 
                    >{{ __('messages.faq') }}</a>
                </li>
                <li class="nav-item anchors">
                    <a class="nav-link anchors" data-id="contact" 
                    
                    
                    href="contact">{{ __('messages.contact') }}</a>

                    
                </li>
            </ul>
            <span class="navbar-text d-flex justify-content-lg-start justify-content-lg-start justify-content-center mt-md-0 mt-lg-0 mt-4">
              
                <span class="me-7">
                    <select name="lang" class="form-select form-select-sm border-2  border-dark  bg-transparent changeLang">
                        <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>Fr</option>
                        <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Ar</option>
                    </select>
                </span>
                  <a href="" class="btn btn-lg btn-warning btn-custom text-light fw-normal me-4">
                    <span class="me-3"><img  href="{{ route('login.admin') }}" class="align-top" width="14" src="{{ asset('images/svg/profil.svg') }}" alt=""></span>
                    {{__('messages.seconnecter')}}
                </a>
             
            </span>
        </div>
    </div>
</nav>


<script>
    {{--const path = window.location.pathname--}}
    {{--const languageSelect = document.querySelector('[language-switcher]');--}}

    {{--languageSelect.querySelectorAll('option').forEach(--}}
    {{--    opt => {--}}
    {{--        const currentLangue = "{{ locale()->current() }}"--}}
    {{--        if (opt.value === currentLangue) --}}
    {{--            opt.selected = true;--}}
    {{--        else opt.selected = false;--}}
    {{--    }--}}
    {{--)--}}

    {{--languageSelect.addEventListener('change', function() {--}}
    {{--    const value = this.value;--}}
    {{--    window.location.href =`/${value}/${path.slice(4)}`--}}
    {{--}) --}}
</script>