<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
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
        <tr>
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
                <a class="btn btn-sm btn-primary" href="{{route('users.edit',getEncrypted($user->id))}}"><i class="fas fa-edit" style="margin-left: 5px;"></i></a>

                {{-- <button class="btn btn-sm btn-danger delete_row" data-title="user" data-href="{{route('users.destroy',getEncrypted($user->id))}}" data-user_id ="{{getEncrypted($user->id)}}" data-kt-customer-table-filter="delete_row" ><i class="fas fa-trash" style="margin-left: 5px;"></i></button> --}}
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