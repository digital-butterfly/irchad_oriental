@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Créer nouveau compte
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
			<form class="kt-form" method="POST" action="{{ route('users.store') }}">
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">
                        @foreach($fields as $field)
                            @include(sprintf('back-office.components.form.fields.%s', $field['type']), $field)
							@if ($field['type'] == 'password')
								@include(sprintf('back-office.components.form.fields.password'),
								$field = [
									'name' => 'password_confirmation',
									'type' => 'password',
									'label' => 'Retapez mot de passe'
								])
							@endif
                        @endforeach
		            </div>
	            </div>
	            <div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">Créer</button>
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

@endsection
