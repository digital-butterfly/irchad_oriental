@extends('back-office.layouts.layout-default')



@section('specific_css')
    
@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Ajouter une nouvelle fiche de projet
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
			<form class="kt-form" method="POST" action="{{ route('fiches-projets.update', $data->id) }}">
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
												@if (!(in_array($child['name'], $done_fields)))
													@php
														$done_fields[] = $child['name'];
														$child['config']['hotizontalRows'] = true;
													@endphp
													@include(sprintf('back-office.components.form.fields.%s', $child['type']), $field = $child)
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
						<button type="reset" class="btn btn-secondary">Retour</button>
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
				var repeater_strengths = $('.kt_repeater_strengths').repeater({
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

				var repeater_weaknesses = $('.kt_repeater_weaknesses').repeater({
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

				var repeater_investment_program = $('.kt_repeater_investment_program').repeater({
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

				var repeater_financing_modes = $('.kt_repeater_financing_modes').repeater({
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

		jQuery(document).ready(function() {
			KTFormRepeater.init();
		});
	</script>
@endsection