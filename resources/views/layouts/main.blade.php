<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	@include('layouts.head')
	@yield('css')
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px" data-kt-aside-minimize="on">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				@include('layouts.sidebar')
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<!--end::Header-->
					<!--begin::Content-->
                    @yield('content')
                    <!--end::Content-->
					<!--begin::Footer-->
                    @include('layouts.footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		@include('layouts.foot')
		@yield('scripts')
	</body>
	<!--end::Body-->
</html>
