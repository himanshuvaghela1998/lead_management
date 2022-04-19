<head>
    <base href="">
    <title>Lead Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset('public/assets/media/logos/Aipxperts-logo_1.png')}}" type = "image/x-icon"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!-- Start css in dropdown list-->
    <link rel="stylesheet" href="{{ asset('assets/css/status.css') }}">
    <!--End css-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('public/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <link href="{{ asset('public/assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <!-- highlight Js for ckeditor code block -->
	<link rel="stylesheet" href="{{asset('public/assets/js/ckeditor/highlight/default.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/assets/js/ckeditor/style.css')}}">
</head>
