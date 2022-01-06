@extends('back-office.layouts.layout-default')



@section('specific_css')
 <style>

     .tagify .tagify__tag {
         margin: 3px;}
     .tagify__tag__removeBtn{
         margin-left: 2px;
     }
 </style>
@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <!--begin::Form-->
            <form id="candidaturesform" class="kt-form" method="POST" action="{{ route('candidatures.update', $data->id) }}">
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Modifier Candidatures
                            </h3>
                        </div>

                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-actions">
                                <button type="submit" class="btn btn-primary">Appliquer</button>
                                <button onclick="history.go(-1);" type="reset" class="btn btn-secondary">Retour</button>

                            </div>
                        </div>
                    </div>

                </div>
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div><br />
			@endif

                {{ method_field('PUT') }}
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">



						@php
							$done_groups = [];
						@endphp
						@foreach($fields as $parent)
							@if (isset($parent['group']))
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
																$subchild['parent_name'] = $child['name'];
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
                        @endforeach
						 <div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">Appliquer</button>
						<button onclick="history.go(-1);" type="reset" class="btn btn-secondary">Retour</button>
					</div>
				</div>
                <input name="deteletags" type="hidden" id="deteletags" value=""/>
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


        var KTTagify = function() {

            // Private functions
            var demo1 = function() {
                var todelet =[];
                var toEl = document.getElementById('kt_tagify_1');
                var myFunction = function(){
                    console.log(todelet)
                    $("#deteletags").val(JSON.stringify(todelet))
                }
                document.getElementById("candidaturesform").addEventListener("submit", myFunction);

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
                console.log('helloooooooo', tagifyTo)


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

				var overheads_scalable = $('.kt_repeater_overheads_scalable').repeater({
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
        $('#statusSelect, input[name="status"]').change(updateStatusElements);

        function updateStatusElements(e) {
            console.log(e,'ee')
            var valueAttribute = '[value="' + e.target.value + '"]';
            $('#statusSelect option' + valueAttribute).prop('selected', true);
            $('input[name="status"]' + valueAttribute).prop('checked', true);
        }
        $('#incorporationSelect, input[name="incorporation"]').change(updateElements);

        function updateElements(e) {
            var valueAttribute = '[value="' + e.target.value + '"]';
            $('#incorporationSelect option' + valueAttribute).prop('selected', true);
            $('input[name="incorporation"]' + valueAttribute).prop('checked', true);
        }
        function selectTypeElemts(){
            console.log('hello', )
            let ss=$( "#statusSelect" ).val();
            let valueAttribute = '[value="' + ss + '"]';
            $('input[name="status"]' + valueAttribute).prop('checked', true)
        }
        function selectElemts(){
            console.log('hello', )
            let ss=$( "#incorporationSelect" ).val();
            let valueAttribute = '[value="' + ss + '"]';
            $('input[name="incorporation"]' + valueAttribute).prop('checked', true)
        }

		jQuery(document).ready(function() {
            selectTypeElemts();
            selectElemts()


			KTFormRepeater.init();
            KTTagify.init();
		});
	</script>
@endsection
