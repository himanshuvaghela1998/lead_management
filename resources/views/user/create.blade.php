<div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
        <form action="{{ route('users.store') }}" class="horizontal-form" method="POST" id="user_store">
            {{ csrf_field() }}
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Add a User</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <button class="btn btn-icon btn-sm btn-active-icon-primary close-modal" type="reset">
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
                    <div class="row">
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Name</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter user name" name="name" id="name"/>
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Role</label>
                            {{Form::select('role',[''=>'Select Role']+$roles,null,['class'=>'form-control form-control-solid capitalize-letter','id'=>'role'])}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Email</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter email address" name="email" id="email"/>
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-bold mb-2">Password</label>
                            <input type="password" class="form-control form-control-solid" placeholder="Enter password" name="password" id="password"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-center">
                <button type="reset" class="btn btn-light me-3 close-modal">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </form>
    </div>
</div>