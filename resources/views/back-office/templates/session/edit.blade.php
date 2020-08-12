@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Modifier Formation
					</h3>
				</div>
			</div>
			<!--begin::Form-->
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div><br />
			@endif
            <form id="sessionform" class="kt-form" method="POST" action="{{ route('session.update', $data->id) }}">
                {{ method_field('PUT') }}
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">
						@foreach($fields as $field)
							@php
								$field['config']['hotizontalRows'] = true;
							@endphp
                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), [$field, $data])

                        @endforeach

                    </div>
	            </div>
	            <div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">Appliquer</button>
						<button onclick="history.go(-1);" type="reset" class="btn btn-secondary">Retour</button>
					</div>
				</div>
				@csrf
			</form>
			<!--end::Form-->
		</div>
    </div>
@endsection




@section('specific_js')
	<script>
		// Class definition
        var KTSelect2 = function() {
            // Private functions
            var demos = function() {
                function formatRepo(formation) {
                    console.log(formation,'formation')
                    if (formation.loading) return formation.text;
                    var markup = "<div class='select2-result-formationsitory clearfix'>" +
                        "<div class='select2-result-formationsitory__meta'>" +
                        "<div class='select2-result-formationsitory__title'>" + formation.title + "</div>";
                    if (formation.description) {
                        markup += "<div class='select2-result-formationsitory__description'>" + formation.description + "</div>";
                    }

                    return markup;
                }

                function formatRepoSelection(formation) {
                    return formation.title || formation.text;
                }

                $("#id_formationSelect").select2({
                    placeholder: "Formation",
                    allowClear: true,
                    ajax: {
                        url: 'admin/FormationList',
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        method:'POST',
                        data: function (params) {
                            console.log(params,'passsdd')
                            return {
                                generalSearch: params.term, // search term
                                pagination: params.page
                            };
                        },
                        processResults: function (data, params) {
                            // parse the results into the format expected by Select2
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data, except to indicate that infinite
                            // scrolling can be used
                            params.page = params.page || 1;
                            return {
                                results: data[0],
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function (markup) {
                        return markup;
                    }, // let our custom formatter work
                    minimumInputLength: 1,
                    templateResult: formatRepo, // omitted for brevity, see the source of this page
                    templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                });

            }
            // Public functions
            return {
                init: function() {
                    demos();
                }
            };
        }();
        var KTSelectCandidatures = function() {
            // Private functions
            var demos = function() {
                $('#kt_tagify_1').attr('readonly','')
                function formatRepo(candidatures) {
                    console.log(candidatures,'candidatures')
                    if (candidatures.loading) return candidatures.text;
                    var markup = "<div class='select2-result-candidaturessitory clearfix'>" +
                        "<div class='select2-result-candidaturessitory__meta'>" +
                        "<div class='select2-result-candidaturessitory__title'><b>" + candidatures.title + "</b></div>";
                    if (candidatures.description) {
                        markup += "<div class='select2-result-candidaturessitory__description'>" + candidatures.description + "</div>";
                    }

                    return markup;
                }

                function formatRepoSelection(candidatures) {
                    return candidatures.title || candidatures.text;
                }
                var el=document.getElementById('kt_tagify_1');
                $("#candidaturesSelect").select2({
                    placeholder: "Candidatures",
                    allowClear: true,
                    ajax: {
                        url: 'admin/projectList',
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        method:'POST',
                        data: function (params) {
                            console.log(params,'passsdd')
                            return {
                                generalSearch: params.term, // search term
                                pagination: params.page
                            };
                        },
                        processResults: function (data, params) {
                            // parse the results into the format expected by Select2
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data, except to indicate that infinite
                            // scrolling can be used
                            params.page = params.page || 1;
                            return {
                                results: data[0],
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function (markup) {
                        return markup;
                    }, // let our custom formatter work
                    minimumInputLength: 1,
                    templateResult: formatRepo, // omitted for brevity, see the source of this page
                    templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                });


            }
            // Public functions
            return {
                init: function() {
                    demos();
                }
            };
        }();
		var KTFormRepeater = function() {

			// Private functions
			var demo1 = function() {
				var repeater_strengths = $('.kt_repeater_degrees').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var repeater_weaknesses = $('.kt_repeater_professional_experience').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
				var repeater_state_help = $('.kt_repeater_state_help').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
			}

			return {
				// public functions
				init: function() {
					demo1();
				}
			};
		}();
        var KTTagify = function() {

            // Private functions
            var demo1 = function() {
                var todelet =[];
                var toEl = document.getElementById('kt_tagify_1');
                var myFunction = function(){
                    console.log(todelet)
                    $("#deteletags").val(JSON.stringify(todelet))
                }
                // document.getElementById("candidaturesform").addEventListener("submit", myFunction);

                var tagifyTo = new Tagify(toEl, {
                    delimiters: ", ", // add new tags when a comma or a space character is entered
                    maxTags: 5,
                    enforceWhitelist: true,
                    // blacklist: [JSON.parse($('#member_id').val())],
                    keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                    whitelist: toEl.value ? JSON.parse(toEl.value) : [],
                    templates: {
                        tag : function(tagData){
                            try{
                                return `<tag title='${tagData.member_id}' contenteditable='false' spellcheck="false" class='tagify__tag tagify__tag--brand tagify--noAnim ${tagData.class ? tagData.class : ""}' ${this.getAttributes(tagData)}>
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
                                   <span>${tagData.member_id}</span>
                               </span>
                                <div class="kt-media-card__info">
                            <a class="kt-media-card__title">${tagData.value}</a>
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
                        searchKeys: ["value","member_id"] ,
                        classname : "color-blue",
                        enabled   : 1,
                        maxItems  : 10
                    }


                });
                // tagifyTo.settings.whitelist.push(...toEl.value)
                // console.log('helloooooooo',tagifyTo.settings.whitelist)
                console.log('helloooooooo', tagifyTo)
                $('#candidaturesSelect').change(function(){

                    // You can access the value of your select field using the .val() method
                    // alert('Select field value has changed to' + );

                    // You can perform an ajax request using the .ajax() method
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        method:'POST',
                        url: 'admin/MemebersProjectList', // This is the url that will be requested

                        // This is an object of values that will be passed as GET variables and
                        // available inside changeStatus.php as $_GET['selectFieldValue'] etc...
                        data: {project_application_id: $('#candidaturesSelect').val()},

                        // This is what to do once a successful request has been completed - if
                        // you want to do nothing then simply don't include it. But I suggest you
                        // add something so that your use knows the db has been updated
                        success: function(html){
                            console.log(html)
                            console.log($('#kt_tagify_1'))
                            $('#kt_tagify_1').val(html)
                            tagifyTo.destroy();
                            KTTagify.init();
                            // $('#kt_tagify_1').val(html)
                        },
                        dataType: 'html'
                    });

                });






            }

            return {
                // public functions
                init: function() {
                    demo1();

                }
            };
        }();


		jQuery(document).ready(function() {
			KTFormRepeater.init();
            KTSelect2.init();
            KTSelectCandidatures.init();
            KTTagify.init();



        });
	</script>
@endsection
