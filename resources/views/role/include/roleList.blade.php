<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px">Name</th>
        @can('role_action')
            <th class="text-center min-w-125px">Actions</th>
        @endcan
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">
        @foreach ($roles as $role)
        <tr>
        <td>
            <p class="capitalize-letter">{{ $role->name }}</p>
        </td>
        @can('role_action')
            <td class="text-center">
                <a href="{{ route('role.action',[$role->id]) }}"><i class="fa fa-lock"></i></a>
            </td>
        @endcan
        </tr>
        @endforeach

    </tbody>
</table>

{{-- Pagination --}}
<div class="custom-pagination">
    {{-- {{ $leads->render('vendor.pagination.default') }} --}}
</div>
{{-- END Pagination --}}
