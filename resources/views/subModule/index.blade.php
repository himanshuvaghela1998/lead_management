@extends('layouts.main')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl" >

            <div class="row justify-content-center">
                <div class="col-md-12 extra_space">
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
                                    @can('submodule_update')
                                        <!--begin::Add SubModule-->
                                        <button type="button" class="btn btn-primary btn-sm" id="add_subModule_btn"><i class="fas fa-user-plus"></i>Add Sub Module</button>
                                        <!--end::Add SubModule-->
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="load_content">
                            {{-- begain SubModule list --}}
                            @include('subModule.include.subModuleList')
                            {{-- end SubModule list --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<!--begin::Modal - SubModule - Add-->
<div class="modal fade" id="add_subModule_modal" tabindex="-1" aria-hidden="true">
@include('subModule.create')
</div>
<!--end::Modal - SubModule - Add-->
<!--begin::Modal - SubModule - Edit-->
<div class="modal fade" id="edit_subModule_modal" tabindex="-1" aria-hidden="true">
</div>
<!--end::Modal - SubModule - Edit-->

@endsection
