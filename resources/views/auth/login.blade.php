<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Lead Management | Login</title>
		<link rel="icon" href="{{asset('public/assets/media/logos/Aipxperts-logo_1.png')}}" type = "image/x-icon"/>
		<link href="{{ asset('public/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <style>
            label.error {
                 color: #dc3545;
                 font-size: 14px;
            }
        </style>
	</head>
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #F2C98A">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-5 w-xl-600px scroll-y">
						<!--begin::Content-->
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<!--begin::Logo-->
							<a class="pt-9">
								<img alt="Logo" src="{{ asset('public/assets/media/logos/Aipxperts-logoTransparent.png')}}" class="h-100px" />
							</a>
							<!--end::Logo-->
							<!--begin::Description-->
							<p class="fw-bold fs-2" style="color: #986923;">Discover lead Management
							<br />with great build</p>
							<!--end::Description-->
						</div>
						<!--end::Content-->
						<!--begin::Illustration-->
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url('public/assets/media/illustrations/sketchy-1/login-visual-1.svg')"></div>
						<!--end::Illustration-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100" method="post" action="{{ route('login') }}" id="login_form">
								@csrf
                                <!--begin::Heading-->
                                @if(session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                                @endif

								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Sign In to Lead Management</h1>
								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="form-label fs-6 fw-bolder text-dark">Email</label>
									<!--end::Label-->
									<!--begin::Input-->
                                    <input id="email" type="email" class="form-control form-control-lg form-control-solid" name="email" value="{{ old('email') }}" data-msg-required="Email is required."  autocomplete="email" >
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror



									<!--end::Input-->
								</div>




								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
										<!--end::Label-->
										<!--begin::Link-->
										{{-- <a href="../../demo8/dist/authentication/flows/aside/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a> --}}
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Input-->
                                    <input id="password" type="password" class="form-control form-control-lg form-control-solid" name="password" data-msg="Password is required."  autocomplete="current-password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror


									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
                                    <!--Popup -->
                                    {{-- id="kt_sign_in_submit" --}}
                                    <!--end-->
									<!--begin::Submit button-->
									<button type="submit"  class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">Login</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<!--end::Submit button-->
									<!--begin::Separator-->
									{{-- <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
									<!--end::Separator-->
									<!--begin::Google link-->
									<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
									<img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Continue with Google</a>
									<!--end::Google link-->
									<!--begin::Google link-->
									<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
									<img alt="Logo" src="assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-3" />Continue with Facebook</a>
									<!--end::Google link-->
									<!--begin::Google link-->
									<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
									<img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="h-20px me-3" />Continue with Apple</a> --}}
									<!--end::Google link-->
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<!--begin::Links-->
						{{-- <div class="d-flex flex-center fw-bold fs-6">
							<a href="https://keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank">About</a>
							<a href="https://keenthemes.com/support" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
							<a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
						</div> --}}
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>

		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('public/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('public/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
        <!--Start login validation -->
        <script src="{{ asset('public/assets/js/validation.js') }}"></script>
        <script src="{{ asset('public/assets/js/custom_validation/login_validation.js') }}"></script>
        <!-- end login validation-->
        <!-- strat Toastr -->
        <script src="{{ asset('public/assets/js/toastr.js') }}"></script>
        <script>
        // @if (Session::has('error'))
        // toastr.options =
        // {
        // "closeButton" : true,
        // "progressbar" : true
        // }
        // toastr.error("{{ session('error') }}")

        // @endif
        // @if (Session::has('success'))
        // toastr.options =
        // {
        //     "closeButton" = true,
        //     "progressbar" = true
        // }
        //     toastr.success("{{ session('success') }}")
        // @endif
        </script>
        <!-- end Toastr -->
		<!--begin::Page Custom Javascript(used by this page)-->
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
