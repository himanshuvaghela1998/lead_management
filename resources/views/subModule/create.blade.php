<div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
        <form action="{{ route('subModule.create') }}"  class="horizontal-form" method="POST" id="store_submodule">
            {{ csrf_field() }}
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Add Sub Module </h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <button class="btn btn-icon btn btn-light me-3 btn-sm close-subModule-modal" type="reset">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </button>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body">
                <!--begin::Scroll-->
                <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                    <!--begin::Input group-->
                    <div class="row mt-2">
                        <div class="d-flex flex-column col-md-12">
                            <label class="required fs-6 fw-bold mb-2">
                                <span class="">Select Module</span>
                            </label>
                                <select name="module_id" aria-label="Module name" class="form-select form-select-solid fw-bolder">
                                    <option value="">Select a Module</option>
                                    @foreach ($modules as $module)
                                    <option value="{{ $module->id }}" >{{ucfirst(trans($module->name))}}</option>
                                    @endforeach
                                </select>
                                @error('module_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                        <div class="col-md-12">
                            <label class="required fs-6 fw-bold mb-2">Sub Module Name</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter sub module name" name="name" id="name"/>
                        </div>
                    <div class="col-md-12">
                        <label class="required fs-6 fw-bold mb-2">Sub Module Slug</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Slug" name="slug" id="slug"/>
                    </div>

                </div>
            </div>
            <div class="modal-footer flex-center">
                <button type="reset" class="btn btn-light me-3 btn-sm close-subModule-modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-check"></i> Create</button>
                </div>
        </form>
    </div>
</div>

