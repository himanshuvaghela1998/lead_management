@extends('layouts.main')
@section('content')
<div class="px-10 mt-0 mb-4">
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Users</li>
    </ul>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <form id="filter_form" action="{{route('users.index')}}" method="GET">
                                <input type="hidden" name="status_id" class="input-sm form-control" id="status_id">
                                <input type="hidden" name="page" value="1" id="filter_page">
                                <input type="text" name="search_keyword" class="form-control form-control-solid w-250px ps-15" placeholder="Search" />
                            </form>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Filter-->
                            <div class="w-150px me-3">
                                <!--begin::Select2-->
                                <select class="form-select form-select-solid" id="status_filter" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
                                    <option></option>
                                    <option value="-1">All</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <!--end::Select2-->
                            </div>
                            <!--end::Filter-->
                            <!--begin::Add customer-->
                            <button type="button" class="btn btn-primary btn-sm" id="add_user_btn">Add User</button>
                            <!--end::Add customer-->
                        </div>
                    </div>
                </div>

                <div class="card-body" id="load_content">
                    {{-- begain User list --}}
                    @include('user.include.usersList')
                    {{-- end User list --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!--begin::Modal - User - Add-->
<div class="modal fade" id="add_user_modal" tabindex="-1" aria-hidden="true">
    @include('user.create')
</div>
<!--end::Modal - User - Add-->
<!--begin::Modal - User - Edit-->
<div class="modal fade" id="edit_user_modal" tabindex="-1" aria-hidden="true">
</div>
<!--end::Modal - User - Edit-->
<!--begin::Modal - User - cgange password-->

<div class="modal fade" id="change_password_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form action="{{ route('user.update_confirmPassword', [$users->id]) }}" class="horizontal-form" method="post" id="changePassword">
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
</div>
<!--end::Modal - User - Edit-->

@endsection
