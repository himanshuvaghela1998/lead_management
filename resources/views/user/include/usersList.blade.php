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
            <th class="min-w-125px">Name</th>
            <th class="min-w-125px">Email</th>
            <th class="min-w-125px">Role</th>
            <th class="min-w-125px">Status</th>
            <th class="min-w-70px">Actions</th>
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">
        @if (count($users)>0)
        @foreach ($users as $user)
        <tr id="user_{{getEncrypted($user->id)}}">
            <td>
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input type="checkbox" name="users_id[]" value="" class="form-check-input selected_rows" id="bulk_update_id">
                </div>
            </td>
            <td>
                {{ $user->name }}
            </td>
            <td>
                {{ $user->email }}
            </td>
            <td>
                <p class="capitalize-letter">{{ isset($user->getRole) ? $user->getRole->name : '' }}</p>
            </td>
            <td>
                <?php
                    $checked = ($user->status == 1) ? "checked" : "";
                    $ids=$user->id;
                ?>
                <label class="form-check form-switch  form-check-custom form-check-solid">
                    <input class="form-check-input update_status" data-title="user" name="status" type="checkbox" href="{{route('user.update_status',getEncrypted($user->id))}}" {{$checked}} />
                </label>
            </td>
            <td>
                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                <span class="svg-icon svg-icon-5 m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                    </svg>
                </span>
                </a>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        {{-- <a href="{{route('users.edit',getEncrypted($user->id))}}" class="menu-link px-3">Edit</a> --}}
                        <a class="menu-link px-3 edit_user" data-url="{{ route('users.edit',[getEncrypted($user->id)])}}" id="{{ getEncrypted($user->id) }}">Edit</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a class="menu-link px-3 delete_row" data-title="user" data-user_id ="{{getEncrypted($user->id)}}" data-href="{{route('users.destroy',getEncrypted($user->id))}}" data-kt-users-table-filter="delete_row">Delete</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
            </td>
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