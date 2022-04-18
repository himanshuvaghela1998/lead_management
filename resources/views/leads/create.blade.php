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
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('lead') }}" class="text-muted text-hover-primary">Leads</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Create</li>

    </ul>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('create') }}" class="horizontal-form" method="POST" id="user_store">
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Project Title</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Project Title" name="project_title" id="project_title"/>
                            @error('project_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Project Type</span>
                                </label>
                                <select name="project_type_id" aria-label="Project type" data-control="select2" data-placeholder="Select a Project Type..." class="form-select form-select-solid fw-bolder">
                                  @foreach ($projects as $project)
                                  <option value="">Project Type...</option>
                                  <option value="{{ $project->id }}">{{ $project->project_type }}</option>
                                  @endforeach
                                </select>
                                @error('project_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Time Estimation</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Time Estimation" name="time_estimation" id="time_estimation"/>
                            @error('time_estimation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="d-flex flex-column col-md-6">
                                <label class="fs-6 fw-bold mb-2">
                                    <span >Lead Sources</span>
                                </label>
                                <select name="source_id" aria-label="Project type" data-control="select2" data-placeholder="Select a Lead Sources..." class="form-select form-select-solid fw-bolder">
                                  @foreach ($Sources as $Source)
                                  <option value="">Project Type...</option>
                                  <option value="{{ $Source->id }}">{{ $Source->source }}</option>
                                  @endforeach
                                </select>
                                @error('source_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="d-flex flex-column  col-md-6">
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Billing Type</span>
                                </label>
                                <select name="billing_type" aria-label="Billing type" data-control="select2" data-placeholder="Select a Billing Type..." class="form-select form-select-solid fw-bolder">
                                  <option value="">Billing Type...</option>
                                  <option value="hourly">Hourly</option>
                                  <option value="fixed_cost">Fixed Cost </option>
                                  <option value="not_mentioned">Not Mentioned</option>
                                </select>
                                @error('billing_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="d-flex flex-column  col-md-6">
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Project Status</span>
                                </label>
                                <select name="status" aria-label="Status" data-control="select2" data-placeholder="Select a Project Status..." class="form-select form-select-solid fw-bolder">
                                  <option value="">Status...</option>
                                  <option value="Open">Open</option>
                                  <option value="in_Conversation">In Conversation</option>
                                  <option value="estimation_submitted">Estimation Submitted</option>
                                  <option value="closed">Closed</option>
                                  <option value="converted">Converted</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="d-flex flex-column col-md-12">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">Assigned Too</span>
                                </label>
                                <select name="user_id" aria-label="Assigned Too" data-control="select2" data-placeholder="Select a Assigned Too ..." class="form-select form-select-solid fw-bolder">
                                @foreach ($users as $user)
                                <option value="">Assigned Too...</option>
                                <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Client Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter client name" name="client_name" id="client_name"/>
                            @error('client_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Client Email</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter client Email" name="client_email" id="client Email"/>
                                  @error('client_email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-12 fv-row mb-15">
                                <label class="fs-6 fw-bold mb-2">Client's Details </label>
                                <textarea class="form-control form-control-solid" name="client_other_details" id="" cols="30" rows="5"></textarea>
                            </div>
                            <div class="form-actions d-flex justify-content-end mt-5">
                                <a href="{{ route('lead') }}"><button type="button" class="btn btn-secondary me-3">Cancel</button></a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i> Submit</button>
                            </div>
                        </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
