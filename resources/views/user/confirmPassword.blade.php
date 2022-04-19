<div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
        <form action="{{ route('user.update_confirmPassword',[$users->id]) }}" class="horizontal-form" method="post" id="changePassword">
            {{ csrf_field() }}
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Change Password</h2>
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

                    <div class="col-md-12">
                        <label class="required fs-6 fw-bold mb-2">Password</label>
                        <input type="password" data-msg="Password is required." class="form-control form-control-solid" placeholder="Enter password" name="password" id="password"/>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="col-md-12">
                        <label class="required fs-6 fw-bold mb-2">New Password</label>
                        <input type="password" data-msg="New password is required." class="form-control form-control-solid" placeholder="Enter password" name="new_password" id="new_password"/>
                    </div>
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="row">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-bold mb-2">Confirm Password</label>
                            <input type="password" data-msg="Confirm password is required."
                            data-msg-equalTo="Password and Confirm password not same" class="form-control form-control-solid" placeholder="Enter confirm password" name="confirm_password" id="confirm_password"/>
                        </div>
                        @error('confirm_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-center">
                <button type="reset" class="btn btn-light me-3 close-modal btn-sm">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-check"></i>Update</button>
                </div>
            </form>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#changePassword').validate({
            rules : {
                new_password : "required",
                password : {
                    required : true,
                },
                confirm_password:{
                    required : true,
                    equalTo : "#new_password"
                },
            },
            message: {
                new_password : "New password is required.",
                password : {
                    required : "Password is required.",
                },
                confirm_password : {
                    required : "Confirm password is required",
                    equalTo : "Password and Confirm password not same",
                },
            },
            submitHandler: function(form){
                form.submit();
            }
        })
    })
</script>
