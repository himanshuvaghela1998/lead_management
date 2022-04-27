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
                    <div class="card">
                        <div class="card-body" id="load_content">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="users_table">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" name="select_all" value="1" id="search-select-all" />
                                            </div>
                                        </th>
                                        <th style="width: 25%">Modules</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modules as $module)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input type="checkbox" name="module_id[]" value="" class="form-check-input" id="search_select_all">
                                                </div>
                                            </td>
                                            <td>
                                                <p class="capitalize-letter">{{ $module->name }}</p>
                                            </td>
                                            @foreach ($module->getSubModule as $item)
                                                <td>
                                                    <div class="d-flex capitalize-letter">
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input type="checkbox" name="module_id[]" value="" class="form-check-input selected_rows" id="selected_rows">
                                                        </div>
                                                        {{ $item->name }}
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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