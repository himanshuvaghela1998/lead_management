@extends('layouts.main')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <div class="row justify-content-center">
                <div class="col-md-12" style="margin: -31px;">
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
                                    <form id="filter_form" action="{{route('lead')}}" method="GET">
                                        <input type="hidden" name="status_id" class="input-sm form-control" id="status_id">
                                        <input type="hidden" name="page" value="1" id="filter_page">
                                        <input type="text" name="search_keyword" class="form-control form-control-solid w-250px ps-15" placeholder="Search" />
                                    </form>
                                </div>
                                <!--end::Search-->
                                <div class="w-150px mx-3">
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" id="status_filter" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
                                        <option></option>
                                        <option value="open">Open</option>
                                        <option value="in_Conversation">In Conversation</option>
                                        <option value="estimation_submited">Estimation Submited</option>
                                        <option value="closed">Closed</option>
                                        <option value="converted">Converted</option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                    @can('lead_update')
                                        <a class="btn btn-primary btn-sm" href="{{ route('create') }}"><i class="fa-solid fa-plus"></i>Add Leads</a>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="load_content">
                            {{-- begain User list --}}
                            @include('leads.compact.lead_list')
                            {{-- end User list --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

@endsection

