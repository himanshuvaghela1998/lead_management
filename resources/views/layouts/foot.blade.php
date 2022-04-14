<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/create-app.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/upgrade-plan.js')}}"></script>
<script src="{{ asset('assets/js/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/custom/custom.js')}}"></script>
<!--end::Page Custom Javascript-->
<!-- Start Lead Listing -->
<script src="{{ asset('assets/js/custom_listing/lead_listing.js') }}"></script>
<!-- End Lead Listing -->
 <!-- strat Toastr -->
 <script src="{{ asset('assets/js/toastr.js') }}"></script>
 <script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif
  @if (Session::has('error'))
    toastr.options =
    {
    "closeButton" : true,
    "progressbar" : true
    }
    toastr.error("{{ session('error') }}")

    @endif
    @if (Session::has('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressbar" : true
    }
        toastr.success("{{ session('success') }}")
    @endif
 </script>
 <!-- end Toastr -->
<!--end::Javascript-->
