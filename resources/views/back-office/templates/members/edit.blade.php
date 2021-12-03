@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Modifier adhérent
					</h3>
				</div>
                <button type="button" class="btn btn-brand btn-bold" onclick="window.print();"><i class="flaticon2-printer"></i></button>
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
            <div class="kt-portlet kt-portlet--tab">

                <div class="kt-portlet__body">

                    <!--begin::Section-->
                    @if($data->application!='aucun')
                    <div  id="kt-section" class="kt-section">
                        <div class="kt-section__content kt-section__content--solid">
                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                    <a class="kt-widget__title">
                                        <h3>{{$data->application==='aucun'?$data->application:$data->application[0]->title}}</h3>
                                    </a>

                                </div>

                                <div class="kt-widget__subhead mb-1">
                                    <a href="#"><i class="flaticon2-calendar-3"></i>  {{$data->application==='aucun'?$data->application:$data->application[0]->created_at->format('d/m/Y')}}</a>
                                    <a href="#"><i class="flaticon2-new-email"></i>  {{$data->application==='aucun'?$data->application:$data->application[0]->category_title}}</a>
                                </div>
                                <div class="kt-widget__info pt-4">
                                    <div class="kt-widget__desc">
                                        {{$data->application==='aucun'?$data->application:$data->application[0]->description }}
                                    </div>

                                </div>

                            </div>
                        </div>
                        <a href="admin/candidatures/{{$data->application[0]->id}}" id='creatEntbtn' class="btn btn-success ">Voir la candidature </a>
                    </div>
                @endif
                    <!--end::Section-->

                    <!--end::Section-->
                </div>
            </div>
            <form class="kt-form" method="POST" action="{{ route('members.update', $data->id) }}">
                {{ method_field('PUT') }}
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">
						@foreach($fields as $field)
							@php
								$field['config']['hotizontalRows'] = true;
							@endphp
                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), [$field, $data])
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
        function PrintElem(elem)
        {
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write('<h1>' + document.title  + '</h1>');
            mywindow.document.write(document.getElementById(elem).innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }
    </script>
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

            if( $('#formation_needsSelect').val()=='Oui'){
                $('#formation_needs_desc').parent().closest( '.form-group').show();
                console.log("hani");
            }else {
                $('#formation_needs_desc').parent().closest( '.form-group').hide();
            }
            if( $('#chomageSelect').val()=='Oui'){
                $('#chomage_desc').parent().closest( '.form-group').show();
            }else {
                $('#chomage_desc').parent().closest( '.form-group').hide();
            }
            if( $('#informal_activitySelect').val()=='Oui'){
                $('#informal_activity_desc').parent().closest( '.form-group').show();
				$('#informal_activity_nat').parent().closest( '.form-group').show();
            }else {
                $('#informal_activity_desc').parent().closest( '.form-group').hide();
				$('#informal_activity_nat').parent().closest( '.form-group').hide();
            }

            if( $('#entre_activitySelect').val()=='Oui'){
                $('#entre_activity_desc').parent().closest( '.form-group').show();
				$('#entre_activity_nat').parent().closest( '.form-group').show();
            }else {
                $('#entre_activity_desc').parent().closest( '.form-group').hide();
				$('#entre_activity_nat').parent().closest( '.form-group').hide();
            }

            if( $('#project_ideaSelect').val()=='Oui'){
                $('#project_idea_desc').parent().closest( '.form-group').show();
            }else {
                $('#project_idea_desc').parent().closest( '.form-group').hide();
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
                console.log("hani");
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

		jQuery(document).ready(function() {
			KTFormRepeater.init();
		});



       
	</script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js" type="application/javascript"></script>
@endsection
