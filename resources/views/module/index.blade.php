@extends('layouts.main')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar" style="margin-top: -66px;">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="px-10 mt-0">
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Module</li>
                </ul>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl" >

            <div class="row justify-content-center">
                <div class="col-md-12" style="margin: 25px">
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->

                                </div>

                                <!--end::Filter-->
                            </div>
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                    @can('module_update')
                                        <!--begin::Add module-->
                                        <button type="button" class="btn btn-primary btn-sm" id="add_module_btn"><i class="fas fa-user-plus"></i>Add Module</button>
                                        <!--end::Add module-->
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="load_content">
                            {{-- begain module list --}}
                            @include('module.include.moduleList')
                            {{-- end module list --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<!--begin::Modal - lead model - Add-->
<div class="modal fade" id="add_module_modal" tabindex="-1" aria-hidden="true">
    @include('module.create')
</div>
<!--end::Modal - lead model - Add-->
<!--begin::Modal - lead model - Edit-->
<div class="modal fade" id="edit_lead_modal" tabindex="-1" aria-hidden="true">
</div>
<!--end::Modal - lead model - Edit-->
@endsection
