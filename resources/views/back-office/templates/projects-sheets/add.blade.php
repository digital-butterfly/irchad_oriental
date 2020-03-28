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
			<form class="kt-form" method="POST" action="{{ route('fiches-projets.store') }}">
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">
						@php
							$done_groups = []
						@endphp
						@foreach($fields as $parent)
							@if (isset($parent['group']))
								@if (!(in_array($parent['group'], $done_groups)))
									@php
										$done_groups[] = $parent['group'];
										$done_fields[] = [];
									@endphp
									<h1>{{ $parent['group'] }}</h1>
								@endif
								@foreach($fields as $child)
									@if (isset($child['group']) && $child['group'] == $parent['group'])
										@if (!(in_array($child['name'], $done_fields)))
											@php
												$done_fields[] = $child['name']
											@endphp
											<div class="form-group">
												@include(sprintf('back-office.components.form.fields.%s', $child['type']), $field = $child)
											</div>
										@endif
									@endif
								@endforeach
							@endif
                        @endforeach		
		            </div>
	            </div>
	            <div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">Créer</button>
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

@endsection