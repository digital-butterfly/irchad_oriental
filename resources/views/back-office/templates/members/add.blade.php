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

        window.addEventListener('load', function() {
            // alert($('#chomageSelect').val())
            // console.log($('#chomageSelect').val())

            if($('#chomageSelect').val()!='Oui'){
                $('#chomage_desc').parent().closest( '.form-group').hide();
            };

            if( $('#informal_activitySelect').val()!='Oui') {
                $('#informal_activity_desc').parent().closest('.form-group').hide();
				$('#informal_activity_nat').parent().closest('.form-group').hide();
            }
            if( $('#entre_activitySelect').val()!='Oui') {
                $('#entre_activity_desc').parent().closest('.form-group').hide();
				$('#entre_activity_nat').parent().closest('.form-group').hide();
            }
            if($('#project_ideaSelect').val()!='Oui') {
                $('#formation_needs_desc').parent().closest('.form-group').hide();
            }
            if( $('#formation_needsSelect').val()!='Oui') {
                $('#project_idea_desc').parent().closest('.form-group').hide();
            }
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
				$('#informal_activity_nat').parent().closest( '.form-group').show();
            }else {
                $('#informal_activity_desc').parent().closest( '.form-group').hide();
				$('#informal_activity_nat').parent().closest( '.form-group').hide();
            }
        });

        $('#entre_activitySelect').change(function() {
            if( $('#entre_activitySelect').val()=='Oui'){
                $('#entre_activity_desc').parent().closest( '.form-group').show();
				$('#entre_activity_nat').parent().closest( '.form-group').show();
            }else {
                $('#entre_activity_desc').parent().closest( '.form-group').hide();
				$('#entre_activity_nat').parent().closest( '.form-group').hide();
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

window.addEventListener('load',function(){
    let stop = false 

    const interval = setInterval(function(){
        if(!stop){
    var d=document.querySelectorAll('input');
    var t=document.querySelectorAll('textarea');
    console.log(t);
    d.forEach(el=> {
        el.value = el.value.replace("&#039;","'")
     });
    t.forEach(el=> {
        el.value = el.value.replace("&#039;","'")
     });
        }
    },100)
    setTimeout(function(){
        stop =true
    clearInterval(interval)
    },3000)

})

	</script>
@endsection
