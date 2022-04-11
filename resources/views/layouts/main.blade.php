<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
        <!---Start Head--->
        @include('layouts.head')
        <!---End Head--->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
                <!---Start Sidebar--->
				@include('layouts.sidebar')
                <!---End Startbar--->
                <!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" style="" class="header align-items-stretch">
						<!---Start Header--->
                        @include('layouts.header')
                        <!---End Header--->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
                                @yield('content')
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					@include('layouts.footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>

        <!---Start Foot--->
		@include('layouts.foot')
        <!---End Foot--->
	</body>
	<!--end::Body-->
</html>
