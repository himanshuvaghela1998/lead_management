<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	@include('layouts.head')
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
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
                    @include('layouts.header')
					<!--end::Header-->
					<!--begin::Page title-->
					{{-- <div class="px-10 mt-0 mb-4">
						<div class="page-title d-flex flex-column me-5">
							<!--begin::Title-->
							<h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">@yield('page_name')</h1>
							<!--end::Title-->
							<!--begin::Breadcrumb-->
							<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
								<!--begin::Item-->
								<li class="breadcrumb-item text-muted">
									<a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
								</li>
								<!--end::Item-->
								<!--begin::Item-->
								<li class="breadcrumb-item">
									<span class="bullet bg-gray-200 w-5px h-2px"></span>
								</li>
								<!--end::Item-->
								<!--begin::Item-->
								<li class="breadcrumb-item text-dark">@yield('breadcrumb')</li>
								<!--end::Item-->
								@yield('more_breadcrumb')
							</ul>
							<!--end::Breadcrumb-->
						</div>
					</div> --}}
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
