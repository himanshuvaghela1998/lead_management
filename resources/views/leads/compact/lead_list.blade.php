<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

            <th class="min-w-125px">Project Title</th>
            <th class="min-w-125px">Satatus</th>
            <th class="min-w-125px">Project Type</th>
            <th class="min-w-125px">Client Name</th>
            <th class="min-w-125px">Client Email</th>
            {{-- <th class="min-w-125px">Status</th> --}}
            <th class="text-end min-w-70px">Actions</th>
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">
        <tr>
            {{-- @dd( $leads ) --}}
            @foreach ($leads as $lead)
            {{-- @dd($lead->clients->client_name) --}}
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
