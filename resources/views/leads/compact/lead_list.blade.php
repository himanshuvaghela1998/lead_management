<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px">Client name</th>
            <th class="min-w-125px">Project Title </th>
            <th class="min-w-125px">Project status</th>
            <th class="min-w-125px">Assign To</th>
            <th class="min-w-125px">Created date</th>
            {{-- <th class="min-w-125px">Project Status</th> --}}
            @canany(['lead_update','lead_delete'])
                <th class="text-center min-w-125px">Actions</th>
            @endcanany
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">
        @foreach ($leads as $lead)
        {{-- @dd($lead->getUser->name) --}}
        <tr id="user_{{$lead->secret}}">
            <td><p class="capitalize-letter">{{ ($lead->clients) ?  $lead->clients->client_name : '' }}</p></td>
            <td><p class="capitalize-letter"><a href="{{ route('lead.chat',$lead->secret) }}">{{ $lead->project_title }}</a></p></td>
            <td> <p id="lead_status_span_{{ $lead->secret }}" data-title="lead_status_{{ $lead->secret }}" class="capitalize-letter lead_status_span">{{ str_replace('_', ' ', $lead->status) }} </p>
                <select name="status" id="lead_status_{{ $lead->secret }}" data-url="{{ route('lead.change_status',$lead->secret) }}" data-title="lead_status_span_{{ $lead->secret }}" data-placeholder="Project Status..." class="form-select form-select-solid lead_status" style="display:none ">
                    <option value="">Project Status...</option>
                    @foreach (get_lead_status() as $key => $value)
                        <option value="{{ $key }}" {{ $lead->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </td>
            <td> <p class="capitalize-letter">{{ ($lead->getUser) ? $lead->getUser->name : ''  }}</p></td>
            <td> <p class="capitalize-letter">{{ ($lead) ? date_format($lead->created_at,"m-d-Y h:i A") : ''  }}</p></td>
            <!-- Start drop down list -->
            <!-- End Drop down -->
            @canany(['lead_update','lead_delete'])
                <td class="text-center">
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
                        @can('lead_update')
                            <div class="menu-item px-3">
                                <a class="menu-link px-3 subModule" href="{{ route('edit', $lead->secret )}}">Edit</a>
                            </div>
                        @endcan
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        @can('lead_delete')
                            <div class="menu-item px-3">
                                <a class="menu-link px-3 delete_row" data-title="lead" data-user_id ="{{$lead->secret}}" data-href="{{route('lead.destroy',$lead->secret)}}" data-kt-users-table-filter="delete_row">Delete</a>
                            </div>
                        @endcan
                        <!--end::Menu item-->
                    </div>
                </td>
            @endcanany
        </tr>
         @endforeach
    </tbody>
</table>

{{-- Pagination --}}
<div class="custom-pagination">
    {{ $leads->render('vendor.pagination.default') }}
</div>
{{-- END Pagination --}}
