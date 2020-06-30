@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <!--begin::Form-->
            <form class="kt-form" method="POST" action="{{ route('candidatures.update', $data->id) }}">
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

                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label kt-margin-r-100">Status:</label>
                                <label
                                    class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio" value="Nouveau"
                                        name="status">
                                    Nouveau<span></span></label><label
                                    class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio" value="Rejeté"
                                        name="status">
                                    Rejeté<span></span></label><label
                                    class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio" value="Accepté"
                                        name="status">
                                    Accepté<span></span></label><label
                                    class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio" value="En cours"
                                        name="status"> En
                                    cours<span></span></label>
                                <label
                                    class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio"
                                        value="En attente de formation"
                                        name="status">Formation<span></span></label><label
                                    class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio"
                                        value="En attente de financement"
                                        name="status">Financement<span></span></label>

                                <label
                                    class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio"
                                        value="Business plan achevé"
                                        name="status"> BP achevé
                                    <span></span></label><label
                                    class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio" value="Incubé"
                                        name="status">
                                    Incubé<span></span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label kt-margin-r-80">Creation:</label>

                                <label class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio"
                                        value="Entreprise en cours de création"
                                        name="incorporation"> Entreprise en
                                    cours de création<span></span></label>


                                <label
                                    class="kt-radio kt-radio--bold kt-radio--brand kt-margin-r-20"><input
                                        type="radio" value="Entreprise créee"
                                        name="incorporation"> Entreprise
                                    créee<span></span></label>

                            </div>
                        </div>

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
		});
	</script>
@endsection
