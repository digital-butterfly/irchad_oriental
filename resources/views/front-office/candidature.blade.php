@extends('front-office.layouts.master')

@section('content')
    @if(app()->getLocale()=='en')
        <style>
            .home-bg-overlay {
                z-index: 0;
            }

            /*progressbar*/
            #progressbar {
                margin-bottom: 30px;
                overflow: hidden;
                /*CSS counters to number the steps*/
                counter-reset: step;
                text-align: center;
                width: 800px;
                margin: 0 auto;
                position: relative;
                bottom: -292px;
            }


            #progressbar li {
                list-style-type: none;
                color: white;
                text-transform: uppercase;
                font-size: 9px;
                width: 33.33%;
                float: left;
                position: relative;
                letter-spacing: 1px;
            }

            #progressbar li:before {
                content: counter(step);
                counter-increment: step;
                width: 24px;
                height: 24px;
                line-height: 26px;
                display: block;
                font-size: 12px;
                color: #333;
                background: white;
                border-radius: 25px;
                margin: 0 auto 10px auto;
            }

            /*progressbar connectors*/
            #progressbar li:after {
                content: '';
                width: 100%;
                height: 2px;
                background: white;
                position: absolute;
                left: -50%;
                top: 9px;
                z-index: -1; /*put it behind the numbers*/
            }

            #progressbar li:first-child:after {
                /*connector not needed before the first step*/
                content: none;
            }

            /*marking active/completed steps green*/
            /*The number of the step and the connector before it = green*/
            #progressbar li.active:before, #progressbar li.active:after {
                background: #1bbc9b;
                color: white;
            }

            /*Hide all steps except first step*/
            #contact-form fieldset:not(:first-of-type) {
                display: none;
            }

            .custom-form input::-webkit-calendar-picker-indicator { /* display: none */
            }

            .custom-form input[type=date]::-webkit-inner-spin-button,
            .custom-form input[type=date]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
                /* position: relative; */
                /* top : 7px; */
            }

            .custom-form .form-control, .custom-form #contact-form select.form-control {
                border: none;
                border-bottom: 1px solid #c1c1c1;
            }

            .contact-details .contact-details-header {
                text-align: center;
            }

            .logical-fields {
                display: none;
            }
            @media  (max-width: 768px) {
                #progressbar {
                    margin-bottom: 30px;
                    overflow: hidden;
                    /*CSS counters to number the steps*/
                    counter-reset: step;
                    text-align: center;
                    width: 100%;
                    margin: 0 auto;
                    position: relative;
                    bottom: -292px;
                }
            }
        </style>
    @elseif(app()->getLocale()=='ar')
        <style>
            form{
                direction: rtl;
            }
            .home-bg-overlay {
                z-index: 0;
            }

            /*progressbar*/
            #progressbar {
                margin-bottom: 30px;
                overflow: hidden;
                /*CSS counters to number the steps*/
                counter-reset: step;
                text-align: center;
                width: 800px;
                margin: 0 auto;
                position: relative;
                bottom: -292px;
            }


            #progressbar li {
                list-style-type: none;
                color: white;
                text-transform: uppercase;
                font-size: 9px;
                width: 33.33%;
                float: right;
                position: relative;
                letter-spacing: 1px;
            }

            #progressbar li:before {
                content: counter(step);
                counter-increment: step;
                width: 24px;
                height: 24px;
                line-height: 26px;
                display: block;
                font-size: 12px;
                color: #333;
                background: white;
                border-radius: 25px;
                margin: 0 auto 10px auto;
            }

            /*progressbar connectors*/
            #progressbar li:after {
                content: '';
                width: 100%;
                height: 2px;
                background: white;
                position: absolute;
                right: -50%;
                top: 9px;
                z-index: -1; /*put it behind the numbers*/
            }

            #progressbar li:first-child:after {
                /*connector not needed before the first step*/
                content: none;
            }

            /*marking active/completed steps green*/
            /*The number of the step and the connector before it = green*/
            #progressbar li.active:before, #progressbar li.active:after {
                background: #1bbc9b;
                color: white;
            }

            /*Hide all steps except first step*/
            #contact-form fieldset:not(:first-of-type) {
                display: none;
            }

            .custom-form input::-webkit-calendar-picker-indicator { /* display: none */
            }

            .custom-form input[type=date]::-webkit-inner-spin-button,
            .custom-form input[type=date]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
                /* position: relative; */
                /* top : 7px; */
            }

            .custom-form .form-control, .custom-form #contact-form select.form-control {
                border: none;
                border-bottom: 1px solid #c1c1c1;
            }

            .contact-details .contact-details-header {
                text-align: center;
            }

            .logical-fields {
                display: none;
            }
            @media  (max-width: 768px) {
                #progressbar {
                    margin-bottom: 30px;
                    overflow: hidden;
                    /*CSS counters to number the steps*/
                    counter-reset: step;
                    text-align: center;
                    width: 100%;
                    margin: 0 auto;
                    position: relative;
                    bottom: -292px;
                }
            }
        </style>
    @endif

    <form method="POST" data-route="{{ route('projectSubmission')}}" id="form-data">
    @csrf


    <!-- START CONTACT-HEADER -->
        <section class="bg-pages-title">

            <div class="home-bg-overlay">
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active">{{__('project-submission.Informations personnelles')}}</li>
                    <li>{{__('project-submission.Informations Professionelles')}}</li>
                    <li>{{__('project-submission.Informations sur le Projet')}}</li>
                </ul>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center text-white">
                            <h1 class="text-white">{{__('project-submission.Soumissionner un Projet')}}</h1>

                            {{-- <p class="mt-3 mb-0 text-uppercase">get in touch with us</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END CONTACT-HEADER -->
        <!-- START CONTACT -->
        <section class="section pt-0 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-details bg-white p-5 mt-3">
                            <div class="custom-form">
                                <div id="form-errors"></div>
                                <!-- STEP 1 -->
                                {{--                                <div class="fields-section source-field">--}}

                                <fieldset class="fields-section form-section">



<span class="source-field">

                                            <div class="contact-details-header">
                                                <div class="contact-icon">
                                                    <i class="pe-7s-id text-custom"></i>
                                                </div>
                                                <h3>{{__('project-submission.Informations personnelles')}}</h3>
                                                <p class="text-muted mt-3">{{__('project-submission.Renseignez vos informations personnelles')}}</p>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-2">
                                                    <div class=" form-group">
                                                        <select name="member[0][civility]" id="member[0]civility" class=" custom-form form-control">
                                                            <option value="" selected disabled>{{__('project-submission.Votre civilité')}}...</option>
                                                            <option value="0">{{__('project-submission.Mr')}}</option>
                                                            <option value="1">{{__('project-submission.Mme')}}</option>
                                                            <option value="2">{{__('project-submission.Mlle')}}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <input name="member[0][first_name]" id="member[0]first_name" type="text"
                                                               class="form-control" placeholder="{{__('project-submission.Votre prénom')}}..." required="">
                                                    </div>
                                                </div>

                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <input name="member[0][last_name]" id="member[0]last_name" type="text" class="form-control"
                                                               required="" placeholder="{{__('project-submission.Votre nom de famille')}}...">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input name="member[0][identity_number]" id="member[0]identity_number" type="text"
                                                               required="" class="form-control"  onblur="this.value =this.value.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '')"
                                                               placeholder="{{__('project-submission.Votre numéro de CIN')}}...">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input name="member[0][birth_date]" id="member[0]birth_date" type="date"
                                                               class="form-control" required=""
                                                               placeholder="{{__('project-submission.Votre date de naissance')}}...">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <select name="member[0][marital-status]" id="member[0]marital-status" required=""
                                                                class="form-control">
                                                            <option value="" selected disabled>{{__('project-submission.Votre situation familiale')}}...
                                                            </option>
                                                            <option value="">{{__('project-submission.Célibataire')}}</option>
                                                            <option value="">{{__('project-submission.Marié(e)')}}</option>
                                                            <option value="">{{__('project-submission.Divorcé(e)')}}</option>
                                                            <option value="">{{__('project-submission.Veuf(e)')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <input name="member[0][address]" id="member[0]address" type="text" required=""
                                                               class="form-control" placeholder="{{__('project-submission.Votre adresse')}}...">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <select name="member[0][township_id]" id="member[0]township_id" class="form-control">
                                                            <option value="" selected disabled>{{__('project-submission.Votre commune')}}...</option>
                                                            @foreach ($Communes as $Commune)

                                                                <option value="{{$Commune->id}}">@lang( 'project-submission.' . $Commune->title . '' )</option>

                                                                <p></p>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input name="member[0][email]" id="member[0]email" type="email" class="form-control"
                                                               placeholder="{{__('project-submission.Votre email')}}...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input name="member[0][phone]" id="member[0]phone" type="phone" class="form-control"
                                                               placeholder="{{__('project-submission.ٍVotre téléphone')}}...">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <select name="member[0][reduced_mobility]" id="member[0]reduced_mobility"
                                                                class="form-control">
                                                            <option value="" selected disabled>{{__('project-submission.Êtes-vous une personne à mobilité  réduite?')}}
                                                            </option>
                                                            <option value="Non">{{__('project-submission.Non')}}</option>
                                                            <option value="Handicap auditif">{{__('project-submission.Handicap auditif')}}</option>
                                                            <option value="Handicap vocal">{{__('project-submission.Handicap vocal')}}</option>
                                                            <option value="Handicap moteur">{{__('project-submission.Handicap moteur')}}</option>
                                                            <option value="Handicap visuel">{{__('project-submission.Handicap visuel')}}</option>
                                                            <option value="Handicap mental">{{__('project-submission.Handicap mental')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4 text-center">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                   id="defaultCheck1" name="defaultCheck1">
                                                            <label class="form-check-label" for="defaultCheck1">{{__('project-submission.Je certifie l\'exactitude des données renseignées et j\'accepte les')}} <a
                                                                    href="#">{{__('project-submission.termes et conditions')}}</a>.</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <input type="button" name="add-field"
                                                           class="submitBnt btn btn-custom add-field" value="+">
                                                </div>
                                            </div>




</span>
                                    <div class="dynamic-fields">
                                        <!-- Dynamic fielfd will be cloned here -->
                                    </div>
                                    <div class="row mt-4 text-center">
                                        <div class="col-lg-12">
                                            <input type="button" name="next" class="submitBnt btn btn-custom next"
                                                   value="{{__('project-submission.Suivant')}}">
                                            <div id="simple-msg"></div>
                                        </div>
                                    </div>
                                </fieldset>

                                <!-- STEP 2 -->
                                <fieldset style="display:none" class="fs form-section">
<span class="sf">

                                            <div class="contact-details-header">
                                                <div class="contact-icon">
                                                    <i class="pe-7s-study text-custom"></i>
                                                </div>
                                                <h3>{{__('project-submission.Informations Professionelles')}}</h3>
                                                <p class="text-muted mt-3">{{__('project-submission.Renseignez vos informations professionnelles.')}}</p>
                                            </div>
                                            <div class="fields-section">
                                                <h4 class="mt-4">{{__('project-submission.Formation')}}</h4>
                                                <h5><small class="text-muted">{{__('project-submission.Renseignez vos diplômes')}}</small></h5>

                                                <div class="row source-field">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <input name="member[0][degrees][0][diplome_type]" id="diplome_type" type="text"
                                                                   class="form-control" placeholder="{{__('project-submission.Type de diplôme')}}...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <input name="member[0][degrees][0][annee]" id="annee" type="text"
                                                                   class="form-control" placeholder="{{__('project-submission.Année d\'obtention')}}...">
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-lg-2">
                                                         <div class="form-group">
                                                             <input name="degrees[0][specialite]" id="specialite" type="text" class="form-control" placeholder="Spécialité...">
                                                         </div>
                                                     </div>

                                                     <div class="col-lg-2">
                                                         <div class="form-group">
                                                             <input name="degrees[0][option]" id="option" type="text" class="form-control" placeholder="Option...">
                                                         </div>
                                                     </div>--}}

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input name="member[0][degrees][0][etablissement]" id="etablissement"
                                                                   type="text" class="form-control"
                                                                   placeholder="{{__('project-submission.Établissement')}}...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <input id="add-deg" type="button" name="add-field"
                                                                   class="submitBnt btn btn-custom add-field" value="+">
                                                        </div>
                                                    </div>
</div>

                                                <div class="dynamic-fields">
                                                    <!-- Dynamic fielfd will be cloned here -->
                                                </div>
                                            </div>
                                            <div class="fields-section">
                                                <h4 class="mt-5">{{__('project-submission.Experience Professionnelle')}}</h4>
                                                <h5><small class="text-muted">{{__('project-submission.Renseignez vos experiences professionnelles')}}</small></h5>

                                                <div class="row source-field">
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <input name="member[0][professional_experience][0][value]" id="du" type="text"
                                                                   class="form-control" placeholder="{{__('project-submission.Du')}}...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <input name="member[0][professional_experience][0][rate]" id="au" type="text"
                                                                   class="form-control" placeholder="{{__('project-submission.Au')}}...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <input name="member[0][professional_experience][0][label]" id="poste"
                                                                   type="text" class="form-control" placeholder="{{__('project-submission.Poste')}}...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <input name="member[0][professional_experience][0][duration]" id="organisme"
                                                                   type="text" class="form-control" placeholder="{{__('project-submission.Organisme')}}...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <input name="member[0][professional_experience][0][organisme]" id="mission"
                                                                   type="text" class="form-control" placeholder="{{__('project-submission.Mission')}}...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <input type="button" id="add-deg" name="add-field"
                                                                   class="submitBnt btn btn-custom add-field" value="+">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="dynamic-fields">
                                                    <!-- Dynamic fielfd will be cloned here -->
                                                </div>
                                            </div>
                                            {{-- <div class="fields-section">
                                                <h4 class="mt-5">Langues</h4>
                                                <h5><small class="text-muted">Renseignez les langues que vous parlez</small></h5>

                                                <div class="row source-field">
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <input name="name" id="name" type="text" class="form-control" placeholder="Langue...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <input name="name" id="name" type="text" class="form-control" placeholder="Niveau...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <input type="button" name="add-field" class="submitBnt btn btn-custom add-field" value="+">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="dynamic-fields">
                                                    <!-- Dynamic fielfd will be cloned here -->
                                                </div>
                                            </div> --}}
                                            <br>
                                            <br>
                                            <br>
                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <select name="member[0][chomage]" id="chomageSelect" class="form-control  logical-parent" data-parsley-group="block-2">
                                                            <option value="" selected="" disabled="">{{__('project-submission.Actuellement, êtes-vous au chômage ?')}}
                                                            </option>
                                                            <option value="Oui">{{__('project-submission.Oui')}}
                                                            </option>
                                                            <option value="Non">{{__('project-submission.Non')}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <input type="text" id="chomage_desc" name="member[0][chomage_desc]" class="form-control" placeholder="{{__('project-submission.Depuis combien de temps?')}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <select name="member[0][informal_activity]" id="informal_activitySelect" class="form-control  logical-parent" data-parsley-group="block-2">
                                                            <option value="" selected="" disabled="">{{__('project-submission.Exercez-vous une activité informelle?')}}

                                                            </option>
                                                            <option value="Oui">{{__('project-submission.Oui')}}
                                                            </option>
                                                            <option value="Non">{{__('project-submission.Non')}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <input type="text" name="member[0][informal_activity_desc]" id="informal_activity_desc" class="form-control" placeholder="{{__('project-submission.Dans quel secteur?')}}" >
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <select name="member[0][entre_activity]" id="entre_activitySelect" class="form-control  logical-parent" data-parsley-group="block-2">
                                                            <option value="" selected="" disabled="">{{__('project-submission.Exercez-vous une activité entreprenariale?')}}

                                                            </option>
                                                            <option value="Oui">{{__('project-submission.Oui')}}
                                                            </option>
                                                            <option value="Non">{{__('project-submission.Non')}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <input type="text" name="member[0][entre_activity_desc]" id="entre_activity_desc" class="form-control" placeholder="{{__('project-submission.Depuis combien de mois ?')}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <select name="member[0][project_idea]" id="project_ideaSelect" class="form-control  logical-parent" data-parsley-group="block-2">
                                                            <option value="" selected="" disabled="">{{__('project-submission.Avez-vous une idée de projet?')}}

                                                            </option>
                                                            <option value="Oui">{{__('project-submission.Oui')}}
                                                            </option>
                                                            <option value="Non">{{__('project-submission.Non')}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <input type="text" name="member[0][project_idea_desc]" id="project_idea_desc" class="form-control" placeholder="{{__('project-submission.laquelle ?')}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <select name="member[0][formation_needs]" id="formation_needsSelect" class="form-control  logical-parent" data-parsley-group="block-2">
                                                            <option value="" selected="" disabled="">{{__('project-submission.Auriez-vous besoin d\'une formation?')}}
                                                            </option>
                                                            <option value="Oui">{{__('project-submission.Oui')}}
                                                            </option>
                                                            <option value="Non">{{__('project-submission.Non')}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <input type="text" id="formation_needs_desc" name="member[0][formation_needs_desc]" class="form-control" placeholder="{{__('project-submission.Dans quel domaine ?')}}" >
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

<div class="col-lg-2">
                                        <div class="form-group">
                                            <input type="button" name="add-field"
                                                   class="submitBnt btn btn-custom add-field ml-sf" value="+">
                                        </div>
                                    </div>




</span>
                                    <div class="df">
                                        <!-- Dynamic fielfd will be cloned here -->
                                    </div>
                                                 <div class="row mt-4 text-center">
                                        <div class="col-lg-12">
                                            <input type="button" name="previous"
                                                   class="submitBnt btn btn-custom previous" value="{{__('project-submission.Précédent')}}">
                                            <input type="button" name="next" class="submitBnt btn btn-custom next"
                                                   value="{{__('project-submission.Suivant')}}">
                                            <div id="simple-msg"></div>
                                        </div>
                                    </div>
                                </fieldset>

                                <!-- STEP 3 -->
                                <fieldset id="last-fieldset" style="display:none" class="fields-section form-section source-field">
<span class="source-field">

                                    <div class="contact-details-header">
                                        <div class="contact-icon">
                                            <i class="pe-7s-portfolio text-custom"></i>
                                        </div>
                                        <h3>{{__('project-submission.Informations sur le Projet')}}</h3>
                                        <p class="text-muted mt-3">{{__('project-submission.Renseignez les détails de votre projet')}}.</p>
                                    </div>

                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <input name="title" id="title" type="text" class="form-control"
                                                               placeholder="{{__('project-submission.Titre de votre projet')}}...">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <select name="category_id" id="category_id"
                                                                class="form-control bootstrap-select" id="kt_form_type">
                                                            <option disabled selected>{{__('project-submission.Secteur d\'activité')}}...</option>

                                                            @foreach ($sectors as $sector)

                                                                {{--                                                        <optgroup label="{{$sector->title}}">--}}
                                                                <optgroup label="@lang( 'project-submission.' . $sector->title. '' )">
                                                                    @foreach($sector['subSectors'] as $subSector)
                                                                        @if($subSector->parent_id==$sector->id )
                                                                            <option
                                                                                {{--                                                                        value="{{$subSector->id}}">{{$subSector->title}}</option>--}}
                                                                                value="{{$subSector->id}}">@lang( 'project-submission.' . $subSector->title . '' )</option>

                                                                        @endif

                                                                    @endforeach
                                                                </optgroup>
                                                                <p></p>
                                                            @endforeach

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input name="total_jobs" id="total_jobs" min="0" type="number"
                                                               class="form-control" placeholder="{{__('project-submission.Effectif du projet')}}...">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <select name="state-aid" id="state-aid"
                                                                class="form-control  logical-parent">
                                                            <option value="" selected disabled>{{__('project-submission.Avez-vous déjà bénéficié d\'une aide étatique?')}}
                                                            </option>
                                                            <option value="0">{{__('project-submission.Non, je n\'ai jamais bénéficié d\'une aide étatique.')}}
                                                            </option>
                                                            <option value="1">{{__('project-submission.Oui, j\'ai déjà bénéficié d\'une aide étatique.')}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 fields-section logical-fields">
                                                <div class="source-field">
                                                    <div class="form-group">
                                                        <select name="statehelp[0][aid-oui]" id="state-aid-oui"
                                                                class="form-control bootstrap-select" id="kt_form_type">
                                                            <option disabled selected>{{__('project-submission.Si oui, laquelle?')}}</option>

                                                            @foreach ($AIDEETAT as $aide)

                                                                <option value="{{$aide}}">@lang( 'project-submission.' . $aide . '' )</option>

                                                                <p></p>
                                                            @endforeach

                                                        </select>
                                                        {{--                                            <input name="state-aid-oui" id="state-aid-oui" type="text" class="form-control" placeholder="Si oui, laquelle?">--}}
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="statehelp[0][aide_date]"   id="aide_date" type='number' min='2010'
                                                               max='2011' class="form-control"
                                                               placeholder="{{__('project-submission.Dans qu\'elle année?')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="statehelp[0][aide_montant]" id="aide_montant" type='number' min='0'
                                                               class="form-control"  placeholder="{{__('project-submission.le montant?')}}">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <input type="button" name="add-field"
                                                                   class="submitBnt btn btn-custom add-field" value="+">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="dynamic-fields">
                                                    <!-- Dynamic fielfd will be cloned here -->
                                                </div>

                                            </div>




                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <select name="company[is_created]" id="company_creation"
                                                                class="form-control logical-parent">
                                                            <option value="" selected disabled>{{__('project-submission.Avez-vous déjà créé une entreprise pour votre projet?')}}
                                                            </option>
                                                            <option value="1">{{__('project-submission.Oui, j\'ai déjà créé une entreprise pour mon projet.')}}
                                                            </option>
                                                            <option value="0">{{__('project-submission.Non, je n\'est pas encore créé une entreprise pour mon projet.')}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="logical-fields">
                                                <div class="row mt-4">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <select name="company[legal_form]" id="company_form"
                                                                    class="form-control bootstrap-select" id="kt_form_type">
                                                                <option disabled selected>{{__('project-submission.Forme de l\'entreprise')}}...</option>

                                                                @foreach ($LEGALFORM as $legal)

                                                                    <option value="{{$legal}}">@lang( 'project-submission.' . $legal . '' )</option>

                                                                    <p></p>
                                                                @endforeach

                                                            </select>


                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input name="company[corporate_name]" id="company_denomination"
                                                                   type="text" class="form-control"
                                                                   placeholder="{{__('project-submission.Dénomination de l\'entreprise')}}...">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <input name="company[creation_date]" id="company_date" type="date"
                                                                   class="form-control"
                                                                   placeholder="{{__('project-submission.Date de création de l\'entreprise')}}...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



</span>
                                    <div class="row mt-4 text-center">
                                        <div class="col-lg-12">
                                            <input type="button" name="previous"
                                                   class="submitBnt btn btn-custom previous" value="{{__('project-submission.Précédent')}}">
                                            <input type="submit" id="submit" name="submit"
                                                   class="submitBnt btn btn-custom " value="{{__('project-submission.Envoyer')}}">
                                            <div id="simple-msg"></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END CONTACT -->
    </form>
@endsection

@section('custom-js')

    <script>
        function curIndex() {
            // Return the current index by looking at which section has the class 'current'
            return $('.form-section').index($('.form-section').filter('.active'));
        }
function fxCIN(){
    let stripped =$("[id$='identity_number']").val();
    var string = "F65  326  @@çà('è5";

    console.log(stripped.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, ''))
    console.log('...',string.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, ''))
}
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        /* var left, opacity, scale; */ //fieldset properties which we will animate
        /* var animating; */ //flag to prevent quick multi-click glitches

        $(".next").click(function () {
            /* if(animating) return false;
            animating = true; */
            current_fs = $(this).parents().eq(2);
            next_fs = $(this).parents().eq(2).next();
            if (verification($("fieldset").index(current_fs)) == false) {
                $('html,body').animate({
                    scrollTop: $('#form-errors').offset().top - 100
                }, 'slow');
                return false;
            }
            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            $('#form-errors').html(''); //appending errors
            current_fs.hide();
            next_fs.show();


            //show the next fieldset

            //hide the current fieldset with style
            /* current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50)+"%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                'transform': 'scale('+scale+')',
                'position': 'absolute'
              });
                    next_fs.css({'left': left, 'opacity': opacity});
                },
                duration: 800,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            }); */
        });

        $(".previous").click(function () {
            /* if(animating) return false;
            animating = true; */

            current_fs = $(this).parents().eq(2);
            previous_fs = $(this).parents().eq(2).prev();

            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            current_fs.hide();
            previous_fs.show();
            //hide the current fieldset with style
            /* current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                },
                duration: 800,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            }); */
        });

        /*$("#submit").click(function(){
            return false;
        })*/
        $("#form-data").on('submit', function (event) {
            event.preventDefault();
            var route = $("#form-data").data('route');
            var formData = $("#form-data").serialize();
            if (verification(2) == false) {
                $('html,body').animate({
                    scrollTop: $('#form-errors').offset().top - 100
                }, 'slow');
                return false;
            }
            $('#form-errors').html('');

            $.ajax({
                type: 'POST',
                url: route,
                data: formData,
                success: function (response) {
                    var data = response.responseJSON; //this will get the errors response data.
                    msgHtml = '<div class="alert alert-success">{{__('project-submission.Votre demande a été envoyé avec succès')}}</div>';
                    $("#form-data")[0].reset();
                    $('#form-errors').html(msgHtml);
                    $('#last-fieldset').hide();
                },
                error: function (jqXhr) {
                    //process validation errors here.
                    var data = jqXhr.responseJSON; //this will get the errors response data.
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(data.errors, function (key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></di>';

                    $('#form-errors').html(errorsHtml); //appending errors
                }

            });
        });
        //----------------------------

        var fsElement, dfElement, dfCounter;
        //Clone the degree field and show it
        $('body').on('click', '.add-field', function () {
            if ($(this).attr("class")=='submitBnt btn btn-custom add-field ml-sf'){
                fsElement = $(this).closest('.fs');
                dfElement = fsElement.find('.sf');
                dfCounter = dfElement.length;
            }else{
                fsElement = $(this).closest('.fields-section');
                dfElement = fsElement.find('.source-field');
                dfCounter = dfElement.length;
            }


            console.log('add', fsElement, dfElement, dfCounter)
            if (dfCounter < 5) {
                if ($(this).attr("class")=='submitBnt btn btn-custom add-field ml-sf'){
                    dfElement.last().clone().appendTo(fsElement.find('.df:first')).find("input:not(.add-field)").val('');

                }else {
                    dfElement.last().clone().appendTo(fsElement.find('.dynamic-fields:first')).find("input:not(.add-field)").val('');
                }

                function replaceOccurrence(string, regex, n, replace) {
                    var i = 0;
                    return string.replace(regex, function(match) {
                        i+=1;
                        if(i===n) return replace;
                        return match;
                    });
                }

                if ($(this).attr("id")=='add-deg'){
                    dfElement.find('input').each(function () {
                        let nameArr= this.name.split(/member\[(\d+)\]/);
                        console.log(nameArr.join(''));

                        if (nameArr[2]){
                            nameArr[2]= nameArr[2].replace(/\[(\d+)\]/, function (str, p1) {
                                console.log('str');
                                return '[' + (parseInt(p1, 10) + 1) + ']'
                            });
                            nameArr[1]=this.name.substring(0, 9);
                            // console.log(nameArr,nameArr.join(''));
                            this.name = nameArr.join('');
                            this.id = this.id.replace(/\[(\d+)\]/, function (str, p1) {
                                return '[' + (parseInt(p1, 10) + 1) + ']'
                            });

                        }

                    });

                }
                else {

                dfElement.find('input').each(function () {

                    this.name = this.name.replace(/\[(\d+)\]/, function (str, p1) {
                        return '[' + (parseInt(p1, 10) + 1) + ']'
                    });
                    this.id = this.id.replace(/\[(\d+)\]/, function (str, p1) {
                        return '[' + (parseInt(p1, 10) + 1) + ']'
                    });

                });}
                dfElement.find('select').each(function () {
                    this.name = this.name.replace(/\[(\d+)\]/, function (str, p1) {
                        return '[' + (parseInt(p1, 10) + 1) + ']'
                    });
                    this.id = this.id.replace(/\[(\d+)\]/, function (str, p1) {
                        return '[' + (parseInt(p1, 10) + 1) + ']'
                    });
                });
                $(this).removeClass('add-field').addClass('remove-degree').val('-');
                if (dfCounter >= 5) {
                    $(this).prop('disabled', true);
                }
                attach_delete();
            } else {
                $(this).prop('disabled', true);
            }
        });

        //verificatoin
        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
        function verification(current_fs) {
            var is_error = false;
            errorsHtml = '<div class="alert alert-danger"><ul>';
            if (current_fs == 0) {
                if ($('[id^="member["][id$="]civility"]').each(function(){
                    if(this.value == '') {
                    errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre civilité')}}</li>";
                    is_error = true;
                }}));
                if ($('[id^="member["][id$="]first_name"]').each(function(){
                    if(this.value == '') {
                    errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre prénom')}}</li>";
                    is_error = true;
                }
                }));
                if ($('[id^="member["][id$="]last_name"]').each(function(){
                    if(this.value == '') {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre nom')}}</li>";
                        is_error = true;
                    }  }));
                if ($('[id^="member["][id$="]identity_number"]').each(function(){
                    console.log(this.value)
                    if(this.value == '') {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre CIN')}}</li>";
                        is_error = true;
                    }}));
                if ($('[id^="member["][id$="]birth_date"]').each(function(){

                    if(this.value == '') {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre date de naissance')}}</li>";
                        is_error = true;
                    } }));
                if ($('[id^="member["][id$="]marital-status"]').each(function(){
                    if(this.value ==null) {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre situation familliale')}}</li>";
                        is_error = true;
                    }}));
                if ($('[id^="member["][id$="]address"]').each(function(){
                    if(this.value == '') {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre adresse')}}</li>";
                        is_error = true;
                    }}));
                if ($('[id^="member["][id$="]township_id"]').each(function(){
                    if(this.value == '') {

                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre commune')}}</li>";
                        is_error = true;
                    } }));
                if ($('[id^="member["][id$="]email"]').each(function(){
                    if(this.value == '') {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre adresse email')}}</li>";
                        is_error = true;
                    }
                    else if (!validateEmail(this.value)){
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre adresse email')}}</li>";
                        is_error = true;
                    }
                }));
                if ($('[id^="member["][id$="]phone"]').each(function(){
                    if(this.value == '') {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre numéro de téléphone')}}</li>";
                        is_error = true;
                    }}));
                if ($('[id^="member["][id$="]reduced_mobility"]').each(function(){
                    if(this.value == '') {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner votre situation de mobilité')}}</li>";
                        is_error = true;
                    } }));
                if ($('#defaultCheck1').is(":checked") == false) {
                    if(this.value == '') {
                        errorsHtml += "<li>{{__('project-submission.Veuillez certifie l\'exactitude des données renseignées')}}</li>";
                        is_error = true;
                    } }
            }
            /*else if (current_fs == 1)
            {
                $('input[name$="[diplome_type]"]').each(function(){
                    if($(this).val() == "")
                    {
                        errorsHtml += '<li>Veuillez rensigner le(s) type(s) du diplôme</li>';
                        is_error = true;
                        return is_error;
                    }
                });
                $('input[name$="[annee]"]').each(function(){
                    if($(this).val() == "")
                    {
                        errorsHtml += '<li>Veuillez rensigner le(s) année(s) du diplôme</li>';
                        is_error = true;
                        return is_error;
                    }
                });
                $('input[name$="[etablissement]"]').each(function(){
                    if($(this).val()== "")
                    {
                        errorsHtml += '<li>Veuillez rensigner le(s) établissement(s)</li>';
                        is_error = true;
                        return is_error;
                    }

                });
                $('input[name$="[du]"]').each(function(){
                    if($(this).val()== "")
                    {
                        errorsHtml += '<li>Veuillez rensigner la date début de l\'expériance</li>';
                        is_error = true;
                        return is_error;
                    }

                });
                $('input[name$="[au]"]').each(function(){
                    if($(this).val()== "")
                    {
                        errorsHtml += '<li>Veuillez rensigner la date fin de l\'expériance</li>';
                        is_error = true;
                        return is_error;
                    }

                });
                $('input[name$="[poste]"]').each(function(){
                    if($(this).val()== "")
                    {
                        errorsHtml += '<li>Veuillez rensigner le(s) poste(s)</li>';
                        is_error = true;
                        return is_error;
                    }

                });
                $('input[name$="[organisme]"]').each(function(){
                    if($(this).val()== "")
                    {
                        errorsHtml += '<li>Veuillez rensigner le(s) organisme(s)</li>';
                        is_error = true;
                        return is_error;
                    }

                });
                $('input[name$="[mission]"]').each(function(){
                    if($(this).val()== "")
                    {
                        errorsHtml += '<li>Veuillez rensigner le(s) mission(s)</li>';
                        is_error = true;
                        return is_error;
                    }

                });
            }*/
            else if (current_fs == 2) {
                if ($("#title").val() == "") {
                    errorsHtml += "<li>{{__('project-submission.Veuillez rensigner le titre du projet')}}</li>";
                    is_error = true;
                }

                if ($("#category_id").val() ==null) {
                    errorsHtml += "<li>{{__('project-submission.Veuillez renseigner le secteur d\'activité')}}</li>";
                    is_error = true;
                }
                if ($("#total_jobs").val() == "") {
                    errorsHtml += "<li>{{__('project-submission.Veuillez reseigner l\'effectif du projet')}}</li>";
                    is_error = true;
                }
                if ($("#state-aid").val() == null) {
                    if ($("#state-aid-oui").val() == null) {
                        errorsHtml += "<li>{{__('project-submission.Veuillez reseigner l\'aide étatique')}}</li>";
                        is_error = true;
                    }

                }
                if ($("#company_creation").val() == null) {
                    if ($("#state-aid-oui").val() == null) {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner si vous avez déjà créé une entreprise pour votre projet')}}</li>";
                        is_error = true;
                    }

                }

                if ($("#company_creation").val() == '1') {
                    console.log('test', $("#company_creation").value)
                    if ($("#company_form").val() == null) {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner la forme de l\'entreprise')}}</li>";
                        is_error = true;
                    }
                    if ($("#company_denomination").val() == "") {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner la dénomination de l\'entreprise')}}</li>";
                        is_error = true;
                    }

                    if ($("#company_date").val() == "") {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner la date de création de l\'entreprise')}}</li>";
                        is_error = true;
                    }
                }

                if ($("#state-aid").val() == "1") {
                    if ($("#aide_date").val() == "") {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner la date d\'aide étatique')}}</li>";
                        is_error = true;
                    } if ($("#aide_montant").val() == "") {
                        errorsHtml += "<li>{{__('project-submission.Veuillez renseigner le montant')}}</li>";
                        is_error = true;
                    }
                }
            }
            if (is_error == true) {
                errorsHtml += '</ul></di>';
                $('#form-errors').html(errorsHtml); //appending errors
                return false
            }
            return true;

        }

        //Attach functionality to delete buttons
        function attach_delete() {
            $('body').off('click', '.remove-degree');
            $('body').on('click', '.remove-degree', function () {
                fsElement = $(this).closest('.fields-section');
                $(this).closest('.source-field').remove();
                dfCounter = fsElement.find('.source-field').length;
                if (dfCounter < 5) {
                    fsElement.find('.add-field').prop('disabled', false);
                }
            });
        }

        //----------------------------
        var today = new Date();
        var yyyy = today.getFullYear();

        today = yyyy
        document.getElementById("aide_date").setAttribute("max", today);

        $('select.logical-parent').on('change', function () {
            console.log('hide');
            var choice = this.value == 1 ? $(this).closest('.row').nextAll('.logical-fields:first').show() : $(this).closest('.row').nextAll('.logical-fields:first').hide();
            console.log(choice, 'hide');
        });

        $('select.dynamic-parent').on('change', function () {
            var choice = this.value == 1 ? $(this).closest('.row').find('input').last().show() : $(this).closest('.row').find('input').last().hide();
        });
        $('.form-section').each(function (index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-' + index);
        });
        window.addEventListener('load', function() {


            $('#chomage_desc').parent().closest('.form-group').hide();
            $('#informal_activity_desc').parent().closest('.form-group').hide();
            $('#entre_activity_desc').parent().closest('.form-group').hide();
            $('#formation_needs_desc').parent().closest('.form-group').hide();
            $('#project_idea_desc').parent().closest('.form-group').hide();
        });

        $('#chomageSelect').change(function() {
            if( $('#chomageSelect').val()=='Oui'){
                $('#chomage_desc').parent().closest( '.form-group').show();
            }else {
                $('#chomage_desc').parent().closest( '.form-group').hide();
            }
        });

        $('#informal_activitySelect').change(function() {
            if( $('#informal_activitySelect').val()=='Oui'){
                $('#informal_activity_desc').parent().closest( '.form-group').show();
            }else {
                $('#informal_activity_desc').parent().closest( '.form-group').hide();
            }
        });

        $('#entre_activitySelect').change(function() {
            if( $('#entre_activitySelect').val()=='Oui'){
                $('#entre_activity_desc').parent().closest( '.form-group').show();
            }else {
                $('#entre_activity_desc').parent().closest( '.form-group').hide();
            }
        });

        $('#project_ideaSelect').change(function() {
            if( $('#project_ideaSelect').val()=='Oui'){
                $('#project_idea_desc').parent().closest( '.form-group').show();
            }else {
                $('#project_idea_desc').parent().closest( '.form-group').hide();
            }
        });

        $('#formation_needsSelect').change(function() {
            if( $('#formation_needsSelect').val()=='Oui'){
                $('#formation_needs_desc').parent().closest( '.form-group').show();
            }else {
                $('#formation_needs_desc').parent().closest( '.form-group').hide();
            }
        });

    </script>

@endsection
