@extends('layouts.main')

@section('content')
<div class="container">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="{{ route('create') }}" id="kt_modal_add_customer_form" method="POST">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_customer_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Add a Lead</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-bold mb-2">Project Title</label>
                            <input type="text" class="form-control form-control-solid" placeholder="" name="project_title" value="" >
                        </div>
                        <div class="d-flex flex-column mb-7 fv-row">
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">Project Type</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" title="Project Type"></i>
                            </label>
                            <select name="project_type" aria-label="Project type" data-control="select2" data-placeholder="Select a Project Type..." class="form-select form-select-solid fw-bolder">
                                <option value="">Project Type...</option>

                            </select>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">client Name</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="" name="client_name" value="" >
                        </div>
                        <div class="fv-row mb-15">
                            <label class="fs-6 fw-bold mb-2">client Email</label>
                            <input type="text" class="form-control form-control-solid" placeholder="" name="client_email" >
                        </div>
                        <div class="fv-row mb-15">
                            <label class="fs-6 fw-bold mb-2">Client's Details </label>
                            <textarea class="form-control form-control-solid" name="client_other_details" id="" cols="30" rows="10"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    {{-- <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Discard</button> --}}
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">Submit
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
@endsection
