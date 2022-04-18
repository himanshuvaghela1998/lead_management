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
        <li class="breadcrumb-item text-dark">Update</li>

    </ul>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update', $leads->id) }}" class="horizontal-form" method="POST" id="lead_store">
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="row mt-2">
                            <div class=" col-md-6">
                                <label class="fs-6 fw-bold mb-2">Project Title</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Project Title" value="{{ $leads->project_title }}" name="project_title" id="project_title"/>
                            @error('project_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="d-flex flex-column col-md-6">
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Project Type</span>
                                </label>
                                <select name="project_type_id" aria-label="Project type" data-control="select2" data-placeholder="Select a Project Type..." class="form-select form-select-solid ">
                                  @foreach ($projects as $project)
                                  <option value="">Project Type...</option>
                                  <option value="{{ $project->id }}" {{ ($project->id == $leads->project_type_id) ? 'selected' : '' }}>{{ $project->project_type }}</option>
                                  @endforeach
                                  @error('project_type_id')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class=" fs-6 fw-bold mb-2">Time Estimation</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Time Estimation" value="{{ $leads->time_estimation }}" name="time_estimation" id="time_estimation"/>
                                @error('time_estimation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="d-flex flex-column col-md-6">
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Lead Sources</span>
                                </label>
                                <select name="source_id" aria-label="Project type" data-control="select2" data-placeholder="Select a Lead Sources..." class="form-select form-select-solid">
                                  @foreach ($Sources as $Source)
                                  <option value="">Project Type...</option>
                                  <option value="{{ $Source->id }}"{{ ($Source->id == $leads->source_id) ? 'selected' : '' }}>{{ $Source->source }}</option>
                                  @endforeach
                                  @error('source_id')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="d-flex flex-column  col-md-6">
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Billing Type</span>
                                </label>
                                <select name="billing_type" aria-label="Billing type" data-control="select2" data-placeholder="Select a Billing Type..." class="form-select form-select-solid">
                                  <option value="">Billing Type...</option>
                                  <option value="hourly" {{ ($leads->billing_type == 'hourly') ? 'selected' :'' }} >Hourly</option>
                                  <option value="fixed_cost" {{ ($leads->billing_type == 'fixed_cost') ? 'selected' :'' }} >Fixed Cost </option>
                                  <option value="not_mentioned" {{ ($leads->billing_type == 'not_mentioned') ? 'selected' :'' }} >Not Mentioned</option>
                                </select>
                                @error('billing_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="d-flex flex-column  col-md-6">
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Status</span>
                                </label>
                                <select name="status" aria-label="Status" data-control="select2" data-placeholder="Select a Status..." class="form-select form-select-solid">
                                  <option value="">Status...</option>
                                  <option value="Open" {{ ($leads->status == 'open') ? 'selected' : '' }}>Open</option>
                                  <option value="in_Conversation" {{ ($leads->status == 'in_Conversation') ? 'selected' : '' }}>In Conversation</option>
                                  <option value="estimation_submitted" {{ ($leads->status == 'estimation_submitted') ? 'selected' : '' }}>Estimation Submitted</option>
                                  <option value="closed" {{ ($leads->status == 'closed') ? 'selected' : '' }}>Closed</option>
                                  <option value="converted" {{ ($leads->status == 'converted') ? 'selected' : '' }}>Converted</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Assigned Too</span>
                                </label>
                                <select name="user_id" aria-label="Assigned Too" data-control="select2" data-placeholder="Select a Assigned Too ..." class="form-select form-select-solid">
                                @foreach ($users as $user)
                                <option value="">Project Type...</option>
                                <option value="{{ $user->id }}" {{ ($user->id == $leads->user_id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                                </select>
                                @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        {{-- @dd($leads->clients->client_other_details) --}}
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Client Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter client name" value="{{ $leads->clients->client_name }}" name="client_name" id="client_name"/>
                            @error('client_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Client Email</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter client Email" value="{{ $leads->clients->client_email }}" name="client_email" id="client Email"/>
                                  @error('client_email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 fv-row mb-15">
                                <label class="fs-6 fw-bold mb-2">Client's Details </label>
                                <textarea class="form-control form-control-solid" name="client_other_details" id="" cols="30" rows="5">{{ $leads->clients->client_other_details }}</textarea>
                            </div>
                        </div>
                        <div class="form-actions d-flex justify-content-end mt-5">
                            <a href="{{ route('lead') }}"><button type="button" class="btn btn-secondary me-3">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Update</button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
