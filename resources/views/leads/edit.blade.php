@extends('layouts.main')
@section('page_name','Add User')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('create') }}" class="horizontal-form" method="POST" id="user_store">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="fs-6 fw-bold mb-2">
                                <label class="required fs-6 fw-bold mb-2">Project Title</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter user name" name="project_title" id="project_title"/>
                            </div>
                            <div class="fs-6 fw-bold mb-2">
                                <label class="required fs-6 fw-bold mb-2">Time Estimation</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Time Estimation" name="time_estimation" id="time_estimation"/>
                            </div>
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="required">Project Type</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" title="Project Type"></i>
                                </label>
                                <select name="project_type_id" aria-label="Project type" data-control="select2" data-placeholder="Select a Project Type..." class="form-select form-select-solid fw-bolder">
                                  @foreach ($projects as $project)
                                  <option value="">Project Type...</option>
                                  <option value="{{ $project->id }}">{{ $project->project_type }}</option>
                                  @endforeach

                                </select>
                                <!--end::Input-->
                            </div>
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="required">Lead Sources</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" title="Lead Sources"></i>
                                </label>
                                <select name="source_id" aria-label="Project type" data-control="select2" data-placeholder="Select a Lead Sources..." class="form-select form-select-solid fw-bolder">
                                  @foreach ($Sources as $Source)
                                  <option value="">Project Type...</option>
                                  <option value="{{ $Source->id }}">{{ $Source->source }}</option>
                                  @endforeach

                                </select>
                                <!--end::Input-->
                            </div>
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="required">Billing Type</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" title="Billing Type"></i>
                                </label>
                                <select name="billing_type" aria-label="Billing type" data-control="select2" data-placeholder="Select a Billing Type..." class="form-select form-select-solid fw-bolder">
                                  <option value="">Project Type...</option>
                                  <option value="hourly">Hourly</option>
                                  <option value="fixed_cost">Fixed Cost </option>
                                  <option value="not_mentioned">Not Mentioned</option>
                                </select>
                                <!--end::Input-->
                            </div>
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="required">Status</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" title="Status"></i>
                                </label>
                                <select name="status" aria-label="Status" data-control="select2" data-placeholder="Select a Status..." class="form-select form-select-solid fw-bolder">
                                  <option value="">Status...</option>
                                  <option value="Open">Open</option>
                                  <option value="in_Conversation">In Conversation</option>
                                  <option value="estimation_submitted">Estimation Submitted</option>
                                  <option value="closed">Closed</option>
                                  <option value="converted">Converted</option>
                                </select>
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="required fs-6 fw-bold mb-2">client Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter email address" name="client_name" id="client_name"/>
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-bold mb-2">client Email</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter client Email" name="client Email" id="client Email"/>
                            </div>
                        </div>
                        <div class="fv-row mb-15">
                            <label class="fs-6 fw-bold mb-2">Client's Details </label>
                            <textarea class="form-control form-control-solid" name="client_other_details" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-actions d-flex justify-content-end mt-5">
                            <a href="{{ route('users.index') }}"><button type="button" class="btn btn-secondary me-3">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
