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
            <th style="width: 25%">Module Name</th>
            <th style="width: 25%">Name</th>
            <th style="width: 25%">Slug</th>
            @canany(['submodule_update_slug','submodule_delete_slug'])
                <th style="width: 15%">Actions</th>
            @endcanany
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">

        @foreach ($submodules as $submodule)
        <tr id="user_{{$submodule->secret}}">
                <td>
                    <p>{{ $submodule->getModule->name }}</p>
                </td>
                <td>
                    <p>{{ $submodule->name }}</p>
                </td>
                <td>
                    <p>{{ $submodule->slug }}</p>
                </td>
                @canany(['submodule_update_slug','submodule_delete_slug'])
                    <td>
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                </svg>
                            </span>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4 kt-action-menu" data-kt-menu="true">
                            @can('submodule_update_slug')
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a class="menu-link px-3 edit_subModule" data-url="{{ route('subModule.edit',[$submodule->secret])}}" id="{{ $submodule->secret }}">Edit</a>
                                </div>
                                <!--end::Menu item-->
                            @endcan
                            @can('submodule_delete_sluge')
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a class="menu-link px-3 delete_row" data-title="SubModules" data-user_id ="{{$submodule->secret}}" data-href="{{route('subModules.delete',$submodule->secret)}}" data-kt-users-table-filter="delete_row">Delete</a>
                                </div>
                                <!--end::Menu item-->
                            @endcan
                        </div>
                    </td>
                @endcanany
            </tr>
        @endforeach

    </tbody>
</table>

{{-- Pagination --}}
<div class="custom-pagination">
    {{-- {{ $users->render('vendor.pagination.default') }} --}}
</div>
{{-- END Pagination --}}
