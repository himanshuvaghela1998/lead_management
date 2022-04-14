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
            <th class="min-w-125px">Project Title</th>
            <th class="min-w-125px">Satatus</th>
            <th class="min-w-125px">Project Type</th>
            <th class="min-w-125px">Client Name</th>
            <th class="min-w-125px">Client Email</th>
            <th class="text-end min-w-70px">Actions</th>
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">
        <tr>
            @foreach ($leads as $lead)
            <td>
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input type="checkbox" name="id[]" value="" class="form-check-input selected_rows" id="bulk_update_id">
                </div>
            </td>
            <td>{{ $lead->project_title }}</td>
            <td>{{ $lead->status }}</td>
            <td>{{ $lead->ProjectType->project_type }}</td>
            <td>{{ ($lead->clients) ? $lead->clients->client_name : ''  }}</td>
            <td>{{ ($lead->clients) ? $lead->clients->client_email : ''  }}</td>
            <td>
                <a href="{{ route('edit', $lead->id) }}" class="btn btn-success">Edit</a>
                <a href="  " class="btn btn-danger">Delete</a>
            </td>
        </tr>
         @endforeach
    </tbody>
</table>

{{-- Pagination --}}
<div class="custom-pagination">
    {{ $leads->render('vendor.pagination.default') }}
</div>
{{-- END Pagination --}}
