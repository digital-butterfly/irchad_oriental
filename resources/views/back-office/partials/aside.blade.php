<style>
    @media (min-width: 1025px) {
        .kt-aside--minimize .kt-aside-menu .kt-menu__nav > .kt-menu__item > .kt-menu__link > .kt-menu__link-icon {
            color: #ffffff;
        }}
    .kt-aside-menu .kt-menu__nav > .kt-menu__item.kt-menu__item--open > .kt-menu__heading, .kt-aside-menu .kt-menu__nav > .kt-menu__item.kt-menu__item--open > .kt-menu__link {
        background-color: #f1f2f7;
        border-radius: 15px 0 0 15px;
        margin-top: 5px;

    }
    .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item.kt-menu__item--active > .kt-menu__heading .kt-menu__link-text, .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item.kt-menu__item--active > .kt-menu__link .kt-menu__link-text {

        color: #0961aa;
    }
    .kt-aside-menu .kt-menu__nav > .kt-menu__item.kt-menu__item--open > .kt-menu__heading .kt-menu__link-text, .kt-aside-menu .kt-menu__nav > .kt-menu__item.kt-menu__item--open > .kt-menu__link .kt-menu__link-text {
        color: #0961aa;    }
    .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item.kt-menu__item--active > .kt-menu__heading, .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item.kt-menu__item--active > .kt-menu__link {
        background-color: #f1f2f7;
        border-radius: 15px 0 0 15px;
        margin-left: 7px;
        margin-top: 5px;
    }


    .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover > .kt-menu__heading, .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover > .kt-menu__link {                           background-color: #f1f2f7;
        background-color: #f1f2f7;
        border-radius: 15px 0 0 15px;
        margin-top: 5px;

    }
    .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover > .kt-menu__heading .kt-menu__link-text, .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item:not(.kt-menu__item--parent):not(.kt-menu__item--open):not(.kt-menu__item--here):not(.kt-menu__item--active):hover > .kt-menu__link .kt-menu__link-text {
        color: #0961aa;
    }
    .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item > .kt-menu__heading .kt-menu__link-text, .kt-aside-menu .kt-menu__nav > .kt-menu__item .kt-menu__submenu .kt-menu__item > .kt-menu__link .kt-menu__link-text {
        color: #f0f0f0;
    }
</style>
<!-- begin:: Aside -->
<!-- Uncomment this to display the close button of the panel
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
-->
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="">
                <img alt="Logo" src="images/back-office/logos/logo-light.png"/>
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path
                                d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                fill="#000000" fill-rule="nonzero"
                                transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
                            <path
                                d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
                        </g>
                    </svg></span>
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--light">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path
                                d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                fill="#000000" fill-rule="nonzero"/>
                            <path
                                d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
                        </g>
                    </svg></span>
            </button>

            <!--
            <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
            -->
        </div>
    </div>
    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
             data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item {{ (request()->is('admin')) ? 'kt-menu__item--active' : '' }} "
                    aria-haspopup="true" data-menu-toggle="hover"><a href="admin" class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">Tableau de bord</span></a>
                </li>

                <li class="kt-menu__section  ">
                    <h4 class="kt-menu__section-text">Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item {{ (request()->is('admin/members*')) ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="admin/members" class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon-users"></i><span
                            class="kt-menu__link-text">Adh??rents</span></a></li>
                <li class="kt-menu__item {{ (request()->is('admin/candidatures*')) ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="admin/candidatures" class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon-folder-1"></i><span
                            class="kt-menu__link-text">Candidatures</span></a></li>

                <li class="kt-menu__item  kt-menu__item--submenu {{ (request()->is('admin/formation*'))  || (request()->is('admin/session*')) || (request()->is('admin/session-members')) ? 'kt-menu__item--active kt-menu__item--open' : '' }}" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon-book"></i><span
                            class="kt-menu__link-text">Formations</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent "  aria-haspopup="true"><span
                                    class="kt-menu__link"><span class="kt-menu__link-text">Formations</span></span>
                            </li>
                            <li class="kt-menu__item {{ (request()->is('admin/formation'))   ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/formation"
                                                                                                                                                                           class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text"> Liste des formations</span></a></li>
                            <li class="kt-menu__item {{ (request()->is('admin/groups')) ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/groups"
                                                                                                                                                                          class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">Groups</span></a></li>
                            <li class="kt-menu__item {{ (request()->is('admin/session')) ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/session"
                                                                                                                                                                          class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">Sessions</span></a></li>

                            <li class="kt-menu__item {{ (request()->is('admin/session-members')) ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/session-members"
                                                                                                                                                                          class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">Liste des inscrits </span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu " aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon-coins"></i><span
                            class="kt-menu__link-text">Financement</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">

                            <li class="kt-menu__item {{ (request()->is('admin/funding-indh'))   ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true">
                                <a href="admin/funding-indh" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">  INDH </span></a></li>
                            <li class="kt-menu__item {{ (request()->is('admin/funding-cpde'))   ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true">
                                <a href="admin/funding-cpde" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">  CPDE </span></a></li>
                            <li class="kt-menu__item {{ (request()->is('admin/funding-cpdh'))   ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true">
                                <a href="admin/funding-cpdh" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">  CPDH </span></a></li>
                            <li class="kt-menu__item {{ (request()->is('admin/funding-ext'))   ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true">
                                <a href="admin/funding-ext" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">  Financement externe </span></a></li>

                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu " aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon-open-box"></i><span
                            class="kt-menu__link-text">Cr??ation d'entreprise</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">

                            <li class="kt-menu__item {{ (request()->is('admin/create-enterprise'))   ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true">
                                <a href="admin/create-enterprise" class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text"> Liste des entreprises </span></a></li>

                        </ul>
                    </div>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Configuration</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu {{ (request()->is('admin/fiches-projets*') || request()->is('admin/projects-categories*') || (request()->is('admin/communes*')) ) ? 'kt-menu__item--active kt-menu__item--open' : '' }}" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon-web"></i><span class="kt-menu__link-text">Banque de projets</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent "
                                aria-haspopup="true"><span
                                    class="kt-menu__link"><span
                                        class="kt-menu__link-text">Banque de projets</span></span></li>
                            <li class="kt-menu__item {{ (request()->is('admin/fiches-projets*')) ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/fiches-projets"
                                                                                                                                                                                 class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">Fiches de projets</span></a></li>
                            <li class="kt-menu__item {{ (request()->is('admin/projects-categories*')) ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/projects-categories"
                                                                                                                                                                                      class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">Cat??gories</span></a></li>
                            <li class="kt-menu__item {{ (request()->is('admin/communes*')) ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/communes"
                                                                                                                                                                           class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">Communes</span></a></li> <li class="kt-menu__item {{ (request()->is('admin/accountants*')) ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/accountants"
                                                                                                                                                                           class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">Comptables</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu {{ (request()->is('admin/users*')) ? 'kt-menu__item--active kt-menu__item--open' : '' }}" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i
                            class="kt-menu__link-icon flaticon-user"></i><span
                            class="kt-menu__link-text">Utilisateurs</span><i
                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent "  aria-haspopup="true"><span
                                    class="kt-menu__link"><span class="kt-menu__link-text">Utilisateurs</span></span>
                            </li>
                            <li class="kt-menu__item {{ (request()->is('admin/users')) ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/users"
                                                                                                                                                                       class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">Utilisateurs</span></a></li>
                            <li class="kt-menu__item {{ (request()->is('admin/users/create')) ? 'kt-menu__item--active kt-menu__item--open' : '' }} " aria-haspopup="true"><a href="admin/users/create"
                                                                                                                                                                              class="kt-menu__link "><i
                                        class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                        class="kt-menu__link-text">Ajouter</span></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->

</div>
<!-- end:: Aside -->
