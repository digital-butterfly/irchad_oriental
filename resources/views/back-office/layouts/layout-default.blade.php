<!DOCTYPE html>
<html lang="fr">

	@include('back-office.partials.head')
	{{-- {{ include "head.html" with {specific_css: block('specific_css')} }} --}}

	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
        @include('back-office.partials.header-mobile')
        
		<div id="app" class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				@include('back-office.partials.aside')
                
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                    @include('back-office.partials.header')
                    
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        @include('back-office.partials.sub-header')

						<!-- begin:: Content -->
							@yield('page_content')
						<!-- end:: Content -->
					</div>

					@include('back-office.partials.footer')
				</div>
			</div>
		</div>
		<!-- end:: Page -->

        @include('back-office.partials.quick-panel')

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
		<!-- end::Scrolltop -->

        @include('back-office.partials.global-js')

		@yield('specific_js')
		
	</body>

</html>