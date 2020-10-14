@extends('back-office.layouts.layout-default')


@section('specific_css')
    <link href="css/back-office/pages/wizard/wizard-2.css" rel="stylesheet" type="text/css" />
    <link href="css/back-office/pages/invoices/invoice-5.css" rel="stylesheet" type="text/css" />
@endsection



@section('page_content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Creation d'entreprise pour <b>  {{$data->candidatures}}</b>
                </h3>

            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="first">
                <div class="kt-grid__item kt-wizard-v2__aside">

                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v2__nav">

                        <!--doc: Remove "kt-wizard-v2__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                        <div class="kt-wizard-v2__nav-items kt-wizard-v2__nav-items--clickable">
                            <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="done">
                                <div class="kt-wizard-v2__nav-body">

                                    <div class="kt-wizard-v2__nav-label">
                                        <div class="kt-wizard-v2__nav-label-title">
                                            Forme juridique
                                        </div>
                                        <div class="kt-wizard-v2__nav-label-desc">
                                            Statut fiscal de l'entreprise
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                <div class="kt-wizard-v2__nav-body">

                                    <div class="kt-wizard-v2__nav-label">
                                        <div class="kt-wizard-v2__nav-label-title">
                                            Étapes de créations                          </div>
                                        <div class="kt-wizard-v2__nav-label-desc">
                                            Suivi des étapes de créations                                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                <div class="kt-wizard-v2__nav-body">

                                    <div class="kt-wizard-v2__nav-label">
                                        <div class="kt-wizard-v2__nav-label-title">
                                            Information sur l'entreprise                           </div>
                                        <div class="kt-wizard-v2__nav-label-desc">
                                            Information sur l'entreprise                                </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">
                    @if($data->form_juridique==="A.E" ||$data->form_juridique==="Coopérative")
                    <div class="kt-divider">
                        <span></span>
                        <span> <a  href={{$data->form_juridique==="A.E"?'http://ae.gov.ma/': 'http://www.odco.gov.ma/'}} >{{$data->form_juridique==="A.E"?'ae.gov.ma': 'odco.gov.ma'}}</a></span>
                        <span></span>
                    </div>
                @endif

                    <!--begin: Form Wizard Form-->
                        <form class="kt-form" method="POST" action="{{ route('create-enterprise.update', $data->id) }}">
                    {{ method_field('PUT') }}

                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="done">
                            <div class="kt-heading kt-heading--md">Forme juridique de l'entreprise</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__form">
                                    @foreach($fields as $field)
                                        @if($field['name']==='form_juridique' || $field['name']==='candidatures')
                                            @php
                                                $field['config']['hotizontalRows'] = true;
                                            @endphp
                                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), [$field, $data])
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Wizard Step 2-->
                        <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                            <div class="kt-heading kt-heading--md">Étapes de créations</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__form">
                                    <div class="kt-portlet__body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="kt_widget2_tab1_content">
                                                <div class="kt-widget2" id="steps">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--end: Form Wizard Step 2-->

                        <!--begin: Form Wizard Step 3-->

                        <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                            <div class="kt-heading kt-heading--md">information d'entreprise</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__form">
                                    <div class="kt-portlet__body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="kt_widget2_tab1_content">
                                                <div class="kt-widget2" id="steps">



                                                    @foreach($fields as $field)
                                                        @if($field['name']==='ICE' || $field['name']==='date_creation'|| $field['name']==='title')
                                                            @php
                                                                $field['config']['hotizontalRows'] = true;
                                                            @endphp
                                                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), [$field, $data])
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--end: Form Wizard Step 3-->



                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                Previous
                            </button>
                            <button type="submit" class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit" >
                                Enregistrer
                            </button>

                            <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                Next Step
                            </button>
                        </div>

                        <!--end: Form Actions -->

                        @csrf
                    </form>
                    <!--end: Form Wizard Form-->
                </div>
                 <div class="modal fade" id="kt_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <form method="POST" action="{{ route('create-step.update', $data->id) }}">
                                {{ method_field('PUT') }}

                                <div class="modal-body">

                                    @foreach($fields as $field)
                                        @if($field['name']==='sort'|| $field['name']==='observation' )

                                            @php
                                                $fieldstep['config']['hotizontalRows'] = true;
                                            @endphp
                                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), [$fieldstep])
                                        @endif
                                    @endforeach
                                    <input class="stepId" id="stepID" name="step" value="" hidden>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary kt-align-center">Save</button>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                 <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
{{--                                <h5 class="modal-title" id="exampleModalLabel">Liste des comptables agrées </h5>--}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="  kt-grid__item kt-grid__item--fluid">
                                @component('back-office.components.portlets.table')
                                    @slot('title')
                                        Liste des comptables
                                    @endslot
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection



@section ('specific_js')
    <script>

        $('#kt_modal_5').on('show.bs.modal', function (event) {
            var myVal = $(event.relatedTarget).data('title');
            var stepId = $(event.relatedTarget).data('step');
            var select = $(event.relatedTarget).data('select');
            $("#sortSelect").prop('selectedIndex', select);
            console.log(select)
            $(this).find(".modal-title").text(myVal);
            $(this).find(".stepId").val(stepId);
        });
        $('#kt_modal_6').on('show.bs.modal', function (event) {
            KTDatatableRemoteAjaxDemo.init()
        });
        // Class definition
        var KTWizard2 = function () {
            // Base elements
            var wizardEl;
            var formEl;
            var validator;
            var wizard;
            {{--console.log('{{$data->candidatures}}')--}}
            // Private functions
            var initWizard = function () {
                // Initialize form wizard
                wizard = new KTWizard('kt_wizard_v2', {

                    startStep:  1, // initial active step number
                    clickableSteps: false  // allow step clicking
                });
                let candidatures = "{{$data->candidatures}}"
                let el =document.getElementById('form_juridiqueSelect').value
                let el2 =document.getElementById('tagifycandidatures').value
                console.log(document.getElementById('tagifycandidatures'))
                let jury = "{{$data->form_juridique}}"
                let last=[];
                 if (candidatures.length>0 && jury.length>0){

                     $.ajax({
                         headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                         method:'POST',
                         url: '/admin/showSteps',
                         data: {
                             Form: el,
                             projet:<?= json_encode($data->candidaturestaggyfy) ?>,
                             id: {{$data->id}}
                         },
                         success: function(result) {
                             console.log(result)
                              last.push(result[0]);


                             html = result.map(item => {
                                 return ' <div class="kt-widget2__item '+ (item.currentstep ? 'kt-widget2__item--primary':'') +''+ (item.sorts==="achevé" ? 'kt-widget2__item--success':'') +  (item.sorts==="non-achevé" ? ' kt-widget2__item--danger':'') +'" >   <div class="kt-widget2__checkbox">\n' +
                                     '                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">\n' +
                                     '                                                        <input  value='+ item.stepid +' type="checkbox" '+ (item.currentstep ? '':'disabled') +'>\n' +
                                     '                                                        <span></span>\n' +
                                     '                                                    </label>\n' +
                                     '                                                </div>\n' +
                                     '                                                <div class="kt-widget2__info">\n' +
                                     '                                                    <span  class="kt-widget2__title">\n' +

                                     item.title+
                                     '                                                    </span>\n' +
                                     ((item.form_jurdique==="S.A.R.L" ||item.form_jurdique==="S.A.R.L A.U" ||item.form_jurdique==="S.N.C") && item.order===3 ?  '<a href="#"  data-toggle="modal" data-target="#kt_modal_6" class="">Liste des comptables agrées </a>':'')+

                                     '                                                </div>\n' +
                                     '                                                <div class="kt-widget2__actions">\n' +
                                     (item.sorts!=null || item.sorts ==="non-achevé" || item.currentstep  ?  '                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" >\n' +
                                         '                                                        <i class="flaticon-more-1"></i>\n' +
                                         '                                                    </a>\n' +
                                         '                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">\n' +
                                         '                                                        <ul class="kt-nav">\n' +
                                         '                                                            <li class="kt-nav__item">\n' +
                                         '                                                                <a href="#"  data-toggle="modal" data-target="#kt_modal_5" data-select="1" data-step="'+item.stepid +'" data-title="'+item.title+'" class="kt-nav__link">\n' +
                                         '                                                                    <span class="kt-nav__link-text">Compléter</span>\n' +
                                         '                                                                </a>\n' +
                                         '                                                            </li>\n' +
                                         '                                                            <li class="kt-nav__item">\n' +
                                         '                                                                <a href="#"  data-toggle="modal" data-target="#kt_modal_5" data-select="2" data-step="'+item.stepid +'" data-title="'+item.title+'"class="kt-nav__link">\n' +
                                         '                                                                    <span class="kt-nav__link-text">Non compléter </span>\n' +
                                         '                                                                </a>\n' +
                                         '                                                            </li>\n' +
                                         '                                                        </ul>\n' +
                                         '                                                    </div>\n' :'')+
                                     '                                                </div> </div>'



                             }).join('');
                             document.getElementById("steps").innerHTML = html;

                             if (result[0].laststep){
                                 console.log(last[0],'mol')
                                 wizard.goLast() ;
                             }else {
                                 wizard.goNext()
                             }
                         },
                         dataType : 'json'
                     })
                    }
                // Validation before going to next page
                wizard.on('beforeNext', function(wizardObj) {
                    console.log(wizard.getStep())

                   if (el===''){
                       wizardObj.stop();
                   }
                   else if (wizard.getStep()===1){


                       $.ajax({
                           headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                           method:'POST',
                           url: '/admin/showSteps',
                           data: {
                               Form: el,
                               projet:el2,
                               id: {{$data->id}}
                           },
                           success: function(result) {
                              html = result.map(item => {
                                  return ' <div class="kt-widget2__item '+ (item.currentstep ? 'kt-widget2__item--primary':'') +''+ (item.sorts==="achevé" ? 'kt-widget2__item--success':'') +  (item.sorts==="non-achevé" ? ' kt-widget2__item--danger':'') +'" >   <div class="kt-widget2__checkbox">\n' +
                                      '                                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--single">\n' +
                                      '                                                        <input  value='+ item.stepid +' type="checkbox" '+ (item.currentstep ? '':'disabled') +'>\n' +
                                      '                                                        <span></span>\n' +
                                      '                                                    </label>\n' +
                                      '                                                </div>\n' +
                                      '                                                <div class="kt-widget2__info">\n' +
                                      '                                                    <span  class="kt-widget2__title">\n' +

                                                                                             item.title+
                                      '                                                    </span>\n' +

                                      '                                                </div>\n' +
                                      '                                                <div class="kt-widget2__actions">\n' +
                                      (item.sorts!="achevé" ?  '                                                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" >\n' +
                                       '                                                        <i class="flaticon-more-1"></i>\n' +
                                       '                                                    </a>\n' +
                                       '                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">\n' +
                                       '                                                        <ul class="kt-nav">\n' +
                                       '                                                            <li class="kt-nav__item">\n' +
                                       '                                                                <a href="#"  data-toggle="modal" data-target="#kt_modal_5" data-select="1" data-step="'+item.stepid +'" data-title="'+item.title+'" class="kt-nav__link">\n' +
                                       '                                                                    <span class="kt-nav__link-text">Compléter</span>\n' +
                                       '                                                                </a>\n' +
                                       '                                                            </li>\n' +
                                       '                                                            <li class="kt-nav__item">\n' +
                                       '                                                                <a href="#"  data-toggle="modal" data-target="#kt_modal_5" data-select="2" data-step="'+item.stepid +'" data-title="'+item.title+'"class="kt-nav__link">\n' +
                                       '                                                                    <span class="kt-nav__link-text">Non compléter </span>\n' +
                                       '                                                                </a>\n' +
                                       '                                                            </li>\n' +
                                       '                                                        </ul>\n' +
                                       '                                                    </div>\n' :'')+
                                      '                                                </div> </div>'



                              }).join('');
                               document.getElementById("steps").innerHTML = html
                               console.log(html)
                           },
                           dataType : 'json'
                       });

                   }
                   else if (wizard.getStep()===2 && last[0].laststep===undefined){
                       console.log('helloo')
                       wizardObj.stop();


                   }

                });

                wizard.on('beforePrev', function(wizardObj) {

                });

                // Change event
                wizard.on('change', function(wizard) {
                    KTUtil.scrollTop();
                });
            }

            var initValidation = function() {
                validator = formEl.validate({
                    // Validate only visible fields
                    ignore: ":hidden",

                    // Validation rules
                    rules: {
                        //= Step 1
                        fname: {
                            required: true
                        },
                        lname: {
                            required: true
                        },
                        phone: {
                            required: true
                        },
                        emaul: {
                            required: true,
                            email: true
                        },

                        //= Step 2
                        address1: {
                            required: true
                        },
                        postcode: {
                            required: true
                        },
                        city: {
                            required: true
                        },
                        state: {
                            required: true
                        },
                        country: {
                            required: true
                        },

                        //= Step 3
                        delivery: {
                            required: true
                        },
                        packaging: {
                            required: true
                        },
                        preferreddelivery: {
                            required: true
                        },

                        //= Step 4
                        locaddress1: {
                            required: true
                        },
                        locpostcode: {
                            required: true
                        },
                        loccity: {
                            required: true
                        },
                        locstate: {
                            required: true
                        },
                        loccountry: {
                            required: true
                        },

                        //= Step 5
                        ccname: {
                            required: true
                        },
                        ccnumber: {
                            required: true,
                            creditcard: true
                        },
                        ccmonth: {
                            required: true
                        },
                        ccyear: {
                            required: true
                        },
                        cccvv: {
                            required: true,
                            minlength: 2,
                            maxlength: 3
                        },
                    },

                    // Display error
                    invalidHandler: function(event, validator) {
                        KTUtil.scrollTop();

                        swal.fire({
                            "title": "",
                            "text": "There are some errors in your submission. Please correct them.",
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    },

                    // Submit valid form
                    submitHandler: function (form) {

                    }
                });
            }


            return {
                // public functions
                init: function() {
                    wizardEl = KTUtil.get('kt_wizard_v2');
                    formEl = $('#kt_form');
                    initWizard();
                    initValidation();

                }
            };
        }();
        var KTTagifyCandidatures = function() {

            // Private functions
            var demo1 = function() {

                // $('#kt_tagify_1').attr('readonly','')
                var toEl = document.getElementById('tagifycandidatures');
                var tab = <?= json_encode($data->candidaturestaggyfy) ?>;
                console.log(tab,'okkk');
                // console.log(JSON.parse(tab.replace(/&quot;/g,'"')),'vhoha')
                // document.getElementById("candidaturesform").addEventListenr("submit", myFunction);
                var tagifyCand = new Tagify(toEl, {
                    delimiters: ", ", // add new tags when a comma or a space character is entered
                    maxTags: 5,
                    enforceWhitelist: true,
                    // blacklist: [$('#member_id').val()],
                    keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                    whitelist: toEl.value ? [tab] : [],
                    templates: {
                        tag : function(tagData){
                            console.log('contxrt',tagData)
                            try{
                                // console.log(tagData.value)
                                return `<tag title='${tagData.id}' contenteditable='false' spellcheck="false" class='tagify__tag tagify__tag--brand tagify--noAnim ${tagData.class ? tagData.class : ""}' ${this.getAttributes(tagData)}>
                                        <x title='remove tag' class='tagify__tag__removeBtn'></x>
                                        <div>
                                            <span class='tagify__tag-text'>${tagData.value}</span>
                                        </div>
                                    </tag>`
                            }
                            catch(err){}
                        },
                        dropdownItem : function(tagData){
                            try{
                                return `<div class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}' tagifySuggestionIdx="${tagData.tagifySuggestionIdx}">
                                    <div class="kt-media-card">
                            <span class="kt-media kt-media--'+(tagData.initialsState?tagData.initialsState:'')+'" >
                                   <span>${tagData.id}</span>
                               </span>
                                <div class="kt-media-card__info">
                            <a class="kt-media-card__title">${tagData.value}</a>
                            <span class="kt-media-card__desc">${tagData.description}</span>
                                </div>
                        </div> </div>`
                            }
                            catch(err){}
                        }


                    },

                    transformTag: function(tagData) {
                        tagData.class = 'tagify__tag tagify__tag--brand';
                    },
                    dropdown : {
                        searchKeys: ["value","id"] ,
                        classname : "color-black",
                        enabled   : 1,
                        maxItems  : 10
                    }


                });
                // tagifyCand.settings.whitelist.push(...toEl.value)
                // console.log('helloooooooo',tagifyCand.settings.whitelist)
                console.log('helloooooooo', tagifyCand)


                tagifyCand.on('input', onInput);

                function onInput(e){
                    console.log("onInput: ", e.detail);
                    // tagifyCand.loading(true).dropdown.hide.call(tagifyCand) // show the loader animation


                    // get new whitelist from a delayed mocked request (Promise)
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        url : 'admin/projectList', // La ressource ciblée
                        method:'POST',
                        data:{'tag':e.detail.value}

                    })
                        .then(function(result){
                            tagifyCand.settings.whitelist.length = 0; // reset current whitelist
                            // replace tagify "whitelist" array values with new values
                            // and add back the ones already choses as Tags
                            console.log('---->',result)

                            tagifyCand.settings.whitelist.push(...result[0], ...tagifyCand.value)
                            // tagify.settings.whitelist.splice(0, result[0].length, ...tagify.value)

                            // render the suggestions dropdown.
                            tagifyCand.dropdown.show.call(tagifyCand, e.detail.value);
                            console.log(tagifyCand.settings.whitelist,'whitelist')
                        })
                }
                // tag remvoed callback

                // function onSelectSuggestion(e){
                //     // todelet.push(e.detail.data)
                //     console.log("select:", e.detail)
                //
                //     $.ajax({
                //         headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                //         method:'POST',
                //         url: 'admin/MemebersProjectList', // This is the url that will be requested
                //
                //         // This is an object of values that will be passed as GET variables and
                //         // available inside changeStatus.php as $_GET['selectFieldValue'] etc...
                //         data: {project_application_id: e.detail.data.id},
                //
                //         // This is what to do once a successful request has been completed - if
                //         // you want to do nothing then simply don't include it. But I suggest you
                //         // add something so that your use knows the db has been updated
                //         success: function(html){
                //             console.log(html)
                //             console.log( typeof $('#kt_tagify_1').val())
                //             console.log( typeof html)
                //             let oldValue=[]
                //             let newValue=[]
                //             try {
                //                 newValue = JSON.parse(html)
                //
                //                 if ($('#kt_tagify_1').val()){
                //                     oldValue = JSON.parse(($('#kt_tagify_1').val()))
                //
                //                 }
                //
                //
                //             } catch (e){
                //                 console.error(e)
                //             }
                //             console.log([...oldValue,...newValue],'...ohlalal..')
                //             $('#kt_tagify_1').val( JSON.stringify([...oldValue,...newValue]))
                //             // tagifyTo.addTags( JSON.parse(html))
                //             tagifyTo.loadOriginalValues();
                //             // tagifyTo =new Tagify(toEl2)
                //             // $('#kt_tagify_1').val(html)
                //         },
                //         dataType: 'html'
                //     });
                // }


            }

            return {
                // public functions
                init: function() {
                    demo1();

                }
            };
        }();
        var KTDatatableRemoteAjaxDemo = function() {

            // Private functions

            // basic demo
            var demo = function() {

                var datatable = $('.kt-datatable').KTDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: 'admin/list/accountants',
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                                map: function(raw) {
                                    // sample data mapping
                                    var dataSet = raw;
                                    if (typeof raw.data !== 'undefined') {
                                        dataSet = raw.data;
                                    }
                                    return dataSet;
                                },
                            },
                        },
                        // pageSize: 10,
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true,
                        webstorage: false,
                        saveState:false,
                    },

                    // layout definition
                    layout: {
                        scroll: false,
                        footer: false,
                    },

                    // column sorting
                    sortable: true,

                    pagination: true,

                    search: {
                        input: $('#generalSearch'),
                        // onEnter: true,
                        delay: 400,

                    },

                    // columns definition
                    columns: [
                        {
                            field: 'id',
                            title: '#',
                            sortable: 'asc',
                            width: 50,
                            type: 'number',
                            selector: false,
                            textAlign: 'center',
                        },
                        {
                            field: 'name',
                            title: 'Nom',
                            template: function(row) {
                                return row.first_name + ' ' + row.last_name;
                            }},
                        {
                            field: 'e-mail',
                            title: 'Email',

                        },{
                            field: 'tel',
                            title: 'tel',

                        },

                    ],
                });




            };

            return {
                // public functions
                init: function() {
                    demo();
                },
            };
        }();
        jQuery(document).ready(function() {
            KTWizard2.init();
            KTTagifyCandidatures.init();
        });

    </script>
@endsection
