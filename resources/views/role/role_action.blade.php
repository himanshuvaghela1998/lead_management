@extends('layouts.main')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar" style="margin-top: -66px;">
        <!--begin::Container-->
        {{-- <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack "> --}}
            <div class="px-10 mt-0 " >
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('role') }}" class="text-muted text-hover-primary">Roles</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Action</li>
                </ul>
            </div>
        {{-- </div> --}}
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <div class="row justify-content-center">
                <div class="col-md-12" style="margin: 25px">
                    <div class="card" id="role_action_card">
                        <div class="card-header py-3">
                            <h3 class="fw-bolder capitalize-letter">Set Role Permission For {{ $role->name }}</h3>
                        </div>
                        <div class="card-body" id="load_content">
                           @foreach ($modules as $module)
                               <div class="capitalize-letter py-3">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid fw-bolder">
                                        <input type="checkbox" value="" {{ $role->hasPermissionTo($module->slug)?'checked':'' }} class="form-check-input selected_permission_rows" 
                                        data-slug="{{ $module->slug }}" data-url="{{ route('role.set_permission',$role->id)}}" id="{{ $role->id }}">
                                        <label class="form-check-label " for="{{ $role->id }}">{{ $module->name }}</label>
                                    </div>
                                   <div class="container mt-2">
                                       @foreach ($module->getSubModule as $subModule)
                                        <div class="form-check form-check-sm form-check-custom form-check-solid d-inline px-2">
                                            <input type="checkbox" value="" {{ $role->hasPermissionTo($subModule->slug)?'checked':'' }} class="form-check-input selected_permission_rows" data-slug="{{ $subModule->slug }}" data-url="{{ route('role.set_permission',$role->id)}}">
                                            <label class="form-check-label" for="{{ $role->id }}">{{ $subModule->name }}</label>
                                        </div>
                                       @endforeach
                                   </div>
                               </div>
                           @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection