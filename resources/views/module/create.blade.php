<div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
        <form  action="{{ route('module.create') }}" class="horizontal-form" method="POST" id="store_module">
            {{ csrf_field() }}
            <div class="modal-header">
                <h2 class="fw-bolder">Add a Module</h2>
                <button class="btn btn-icon btn btn-light me-3 btn-sm close-module-modal" type="reset">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-bold mb-2">Module Name</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter full name" name="name" id="name"/>
                        </div>
                    <div class="col-md-12">
                        <label class="required fs-6 fw-bold mb-2">Module Slug</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Slug" name="slug" id="slug"/>
                    </div>

                </div>
            </div>
            <div class="modal-footer flex-center">
                <button type="reset" class="btn btn-light me-3 btn-sm close-module-modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-check"></i> Create</button>
                </div>
        </form>
    </div>
</div>

