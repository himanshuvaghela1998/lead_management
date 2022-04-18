<script src="public/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{ asset('public/assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('public/assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('public/assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('public/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{ asset('public/assets/js/custom/modals/create-app.js')}}"></script>
<script src="{{ asset('public/assets/js/custom/modals/upgrade-plan.js')}}"></script>
<script src="{{ asset('public/assets/js/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/js/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<!--end::Page Custom Javascript-->
<!-- CKEditor -->
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script> --}}
<script src="{{asset('public/assets/js/ckeditor/build/ckeditor.js')}}" type="text/javascript"></script>
 <!-- strat Toastr -->
 <script src="{{ asset('public/assets/js/toastr.js') }}"></script>
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
