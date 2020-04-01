@extends('back-office.layouts.layout-default')



@section('specific_css')
    
@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Ajouter un nouvel adhérent
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
			<form class="kt-form" method="POST" action="{{ route('members.store') }}">
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">
						@foreach($fields as $field)
							@php
								$field['config']['hotizontalRows'] = true;
							@endphp
                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
							@if ($field['type'] == 'password')
								@include(sprintf('back-office.components.form.fields.password'),
								$field = [
									'name' => 'password_confirmation',
									'type' => 'password',
									'label' => 'Retapez mot de passe',
									'config' =>['hotizontalRows' => true]
								])
							@endif
                        @endforeach		
		            </div>
	            </div>
	            <div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">Ajouter</button>
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