<table class="table align-middle table-row-dashed fs-6 gy-5" id="users_table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            {{-- <th class="w-10px pe-2">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true" name="select_all" value="1" id="search-select-all" />
                </div>
            </th> --}}
            <th style="width: 25%">Name</th>
            <th style="width: 25%">Email</th>
            <th style="width: 25%">Role</th>
            <th style="width: 10%">Status</th>
            @canany([get_permission_name('user','edit'),get_permission_name('user','delete'),get_permission_name('user','change password')])
                <th style="width: 15%">Actions</th>
            @endcanany
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">
        @if (count($users)>0)
        @foreach ($users as $user)
        <tr id="user_{{$user->secret}}">
            {{-- <td>
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input type="checkbox" name="users_id[]" value="" class="form-check-input selected_rows" id="bulk_update_id">
                </div>
            </td> --}}
            <td>
                <p class="capitalize-letter">{{ $user->name }}</p>
            </td>
            <td>
                <p>{{ $user->email }}</p>
            </td>
            <td>
                <p class="capitalize-letter">{{ isset($user->getRole) ? $user->getRole->name : '' }}</p>
            </td>
            <td>
                <?php
                    $checked = ($user->status == 1) ? "checked" : "";
                    $ids=$user->id;
                    $readonly = App\Models\User::isAuthorized('user','change status') == true ? '' : 'disabled';
                ?>
                <label class="form-check form-switch  form-check-custom form-check-solid">
                    <input class="form-check-input update_status" data-title="user" name="status" type="checkbox" href="{{route('user.update_status',$user->secret)}}" {{$checked}} {{$readonly}} />
                </label>
            </td>
            @canany([get_permission_name('user','edit'),get_permission_name('user','delete'),get_permission_name('user','change password')])
                <td>
                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                    <span class="svg-icon svg-icon-5 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                        </svg>
                    </span>
                    </a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4 kt-action-menu" data-kt-menu="true">
                        @can(get_permission_name('user','edit'))
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a class="menu-link px-3 edit_user" data-url="{{ route('users.edit',[$user->secret])}}" id="{{ $user->secret }}">Edit</a>
                            </div>
                            <!--end::Menu item-->
                        @endcan
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 change_password" data-url="{{ route('user.edit_confirmPassword',[$user->secret])}}" id="{{ $user->secret }}">Chnage Password</a>
                        </div>
                        <!--end::Menu item-->
                        @can(get_permission_name('user','delete'))
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a class="menu-link px-3 delete_row" data-title="user" data-user_id ="{{$user->secret}}" data-href="{{route('users.destroy',$user->secret)}}" data-kt-users-table-filter="delete_row">Delete</a>
                            </div>
                            <!--end::Menu item-->
                        @endcan
                    </div>
                    <!--end::Menu-->
                </td>
            @endcanany
        </tr>
        @endforeach
        @else
            <tr>
                <th colspan="7" class="text-center">
                    No records found
                </th>
            </tr>
        @endif
    </tbody>
</table>

{{-- Pagination --}}
<div class="custom-pagination">
    {{ $users->render('vendor.pagination.default') }}
</div>
{{-- END Pagination --}}
