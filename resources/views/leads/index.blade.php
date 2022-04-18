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
        <li class="breadcrumb-item text-dark">Leads</li>
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
                            <form id="filter_form" action="{{route('lead')}}" method="GET">
                                <input type="hidden" name="status" class="input-sm form-control" id="form-status">
                                <input type="hidden" name="page" value="1" id="filter_page">
                                <input type="text" name="search_keyword" class="form-control form-control-solid w-250px ps-15" placeholder="Search" />
                            </form>
                        </div>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <a class="btn btn-primary" href="{{ route('create') }}">Add Leads</a>
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
@endsection
