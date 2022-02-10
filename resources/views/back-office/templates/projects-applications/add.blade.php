@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Ajouter une nouvelle candidature
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
			<form class="kt-form" method="POST" action="{{ route('candidatures.store') }}">
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">
						@php
							$done_groups = [];
						@endphp
						@foreach($fields as $parent)
							@if (isset($parent['group']))
							  @if ($parent['group']!='donne_general_arab')
                                                                    @if ($parent['group']!='entreprise_arab')
                                                                    @if ($parent['group']!='etude_marche_arab')
                                                                     @if ($parent['group']!='etude_technique_arab')
								@if (!(in_array($parent['group'], $done_groups)))
									@php
										$done_groups[] = $parent['group'];
										$done_fields[] = [];
									@endphp
									<h3 class="kt-section__title">{{ $parent['group'] }}</h3>
									<div class="kt-section__body">
										@foreach($fields as $child)
											@if (isset($child['group']) && $child['group'] == $parent['group'])
												@if (!isset($child['sub_fields']))
													@if (!(in_array($child['name'], $done_fields)))
														@php
															$done_fields[] = $child['name'];
															$child['config']['hotizontalRows'] = true;
														@endphp
														@include(sprintf('back-office.components.form.fields.%s', $child['type']), $field = $child)
													@endif
												@else
													@foreach($child['sub_fields'] as $subchild)
														@if (!(in_array($subchild['name'], $done_fields)))
															@php
																$done_fields[] = $subchild['name'];
																$subchild['config']['hotizontalRows'] = true;
															@endphp
															@include(sprintf('back-office.components.form.fields.%s', $subchild['type']), $field = $subchild)
														@endif
													@endforeach
												@endif
											@endif
										@endforeach
									</div>
								@endif
								@endif
								@endif
								@endif
								@endif
							@endif
                        @endforeach

				 <div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">Ajouter</button>
						<button onclick="history.go(-1);" type="reset" class="btn btn-secondary">Retour</button>
					</div>
				</div>
				@csrf
		            </div>
	            </div>
	           
			</form>
			<!--end::Form-->
		</div>
    </div>
@endsection




@section('specific_js')
	<script>
        // Class definition
		var KTFormRepeater = function() {

			// Private functions
			var demo1 = function() {

				var financial_plan = $('.kt_repeater_financial_plan').repeater({
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
                 var primary_target_client_d= $('.kt_repeater_primary_target_client_d').repeater({
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
				var financial_plan_loans = $('.kt_repeater_financial_plan_loans').repeater({
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
				var products_turnover_forecast = $('.kt_repeater_products_turnover_forecast').repeater({
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

				var startup_needs = $('.kt_repeater_startup_needs').repeater({
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

				var overheads_fixed = $('.kt_repeater_overheads_fixed').repeater({
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

				var overheads_fixed = $('.kt_repeater_overheads_scalable').repeater({
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

				var human_ressources = $('.kt_repeater_human_ressources').repeater({
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

				var taxes = $('.kt_repeater_taxes').repeater({
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

				var pre_creation_training = $('.kt_repeater_pre_creation_training').repeater({
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

				var post_creation_training = $('.kt_repeater_post_creation_training').repeater({
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
				var local= $('.kt_repeater_local').repeater({
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
				var list_mat= $('.kt_repeater_list_mat').repeater({
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
				var autorisations_nécessaire_c= $('.kt_repeater_autorisations_nécessaire_c').repeater({
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
				var services_turnover_forecast_c= $('.kt_repeater_services_turnover_forecast_c').repeater({
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
				var core_business_p= $('.kt_repeater_core_business_p').repeater({
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
				var primary_target_c= $('.kt_repeater_primary_target_c').repeater({
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
				var core_services= $('.kt_repeater_core_services').repeater({
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
				var suppliers_f= $('.kt_repeater_suppliers_f').repeater({
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
				var distribution_strategy_menace_p= $('.kt_repeater_distribution_strategy_menace_p').repeater({
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
                var distribution_strategy_force_p= $('.kt_repeater_distribution_strategy_force_p').repeater({
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
                var distribution_strategy_faiblesse_p= $('.kt_repeater_distribution_strategy_faiblesse_p').repeater({
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
              var distribution_strategy_Opportunité_p  = $('.kt_repeater_distribution_strategy_Opportunité_p').repeater({
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
				var competition_c= $('.kt_repeater_competition_c').repeater({
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



                var tagifyTo = new Tagify(toEl, {
                    delimiters: ", ", // add new tags when a comma or a space character is entered
                    maxTags: 5,
                    enforceWhitelist: true,
                    // blacklist: [$('#member_id').val()],
                    // keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                    whitelist: toEl.value ? JSON.parse(toEl.value) : [],
                    templates: {
                        tag : function(tagData){
                            console.log('conx',tagData)
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
                //console.log('helloooooooo', tagifyTo)


                tagifyTo.on('input', onInput).on('remove', onRemoveTag).on('dropdown:select', onSelectSuggestion)

                function onInput(e){
                    console.log("onInput: ", e.detail);
                    // tagifyTo.loading(true).dropdown.hide.call(tagifyTo) // show the loader animation


                    // get new whitelist from a delayed mocked request (Promise)
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        url : '/admin/candidaturesmemmbers', // La ressource ciblée
                        method:'POST',
                        data:{'tag':e.detail.value}

                    })
                        .then(function(result){
                            tagifyTo.settings.whitelist.length = 0; // reset current whitelist
                            // replace tagify "whitelist" array values with new values
                            // and add back the ones already choses as Tags
                            console.log('---->',result)

                            tagifyTo.settings.whitelist.push(...result[0], ...tagifyTo.value)
                            // tagify.settings.whitelist.splice(0, result[0].length, ...tagify.value)

                            // render the suggestions dropdown.
                            tagifyTo.dropdown.show.call(tagifyTo, e.detail.value);
                            console.log(tagifyTo.settings.whitelist,'whitelist')
                        })
                }
                // tag remvoed callback
                function onRemoveTag(e){
                    todelet.push(e.detail.data)
                    console.log("onRemoveTag:", e.detail.data)
                }
                function onSelectSuggestion(e){
                    // todelet.push(e.detail.data)
                    console.log("select:", e.detail)
                }


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
			KTTagify.init();
		});

 window.addEventListener('load',function(){
    //alert("hani")
    if(document.querySelector('#legal_formSelect').value=='S.A.R.L' || document.querySelector('#legal_formSelect').value=='S.A.R.L A.U'){
        console.log("hello me");
        var newOptions = {"IS": "IS"};
        $("#applied_taxSelect").empty();
            $.each(newOptions, function(key,value) {
            $("#applied_taxSelect").append($("<option></option>") 
            .attr("value", value).text(key));
        });
    }else if(document.querySelector('#legal_formSelect').value=='S.N.C'){
        var newOptions = {"IS": "IS","IR(personne physique)":"IR(personne physique)"};
        $("#applied_taxSelect").empty();
         $.each(newOptions, function(key,value) {
         $("#applied_taxSelect").append($("<option></option>")
         .attr("value", value).text(key));
        });
    }else if(document.querySelector('#legal_formSelect').value=='Coopérative'){
        var newOptions = {"IS": "IS","IR(personne physique)":"IR(personne physique)","Exonéré":"Exonéré"};
        $("#applied_taxSelect").empty();
         $.each(newOptions, function(key,value) {
         $("#applied_taxSelect").append($("<option></option>")
         .attr("value", value).text(key)); 
        });
    }else if(document.querySelector('#legal_formSelect').value=='A.E'){
    var newOptions = {'Auto-entrepreneur activité commerciale, industrielle ou artisanale':'Auto-entrepreneur activité commerciale, industrielle ou artisanale', 'Auto-entrepreneur prestataire de services':'Auto-entrepreneur prestataire de services'};
        $("#applied_taxSelect").empty();
         $.each(newOptions, function(key,value) {
         $("#applied_taxSelect").append($("<option></option>")
         .attr("value", value).text(key)); 
        });
    }
 

$('#legal_formSelect').on('change',function () {
if(document.querySelector('#legal_formSelect').value=='S.A.R.L' || document.querySelector('#legal_formSelect').value=='S.A.R.L A.U')
{console.log("hello me");
var newOptions = {"IS": "IS"};
$("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key));
});
}else if(document.querySelector('#legal_formSelect').value=='S.N.C'){
    var newOptions = {"IS": "IS","IR(personne physique)":"IR(personne physique)"};
    $("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key));
});
}else if(document.querySelector('#legal_formSelect').value=='Coopérative'){
    var newOptions = {"IS": "IS","IR(personne physique)":"IR(personne physique)","Exonéré":"Exonéré"};
    $("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key)); 
    });
}else if(document.querySelector('#legal_formSelect').value=='A.E'){
    var newOptions = {'Auto-entrepreneur activité commerciale, industrielle ou artisanale':'Auto-entrepreneur activité commerciale, industrielle ou artisanale', 'Auto-entrepreneur prestataire de services':'Auto-entrepreneur prestataire de services'};
    $("#applied_taxSelect").empty();
     $.each(newOptions, function(key,value) {
     $("#applied_taxSelect").append($("<option></option>")
     .attr("value", value).text(key)); 
    });
}

});
  });













	</script>
@endsection
