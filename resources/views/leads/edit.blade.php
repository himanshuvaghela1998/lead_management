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
                                <select name="project_type_id" aria-label="Project type" data-error="#projectType" data-control="select2" data-placeholder="Select a Project Type..." class="form-select form-select-solid ">
                                  @foreach ($projects as $project)
                                  <option value="">Project Type...</option>
                                  <option value="{{ $project->id }}" {{ ($project->id == $leads->project_type_id) ? 'selected' : '' }}>{{ucfirst(trans($project->project_type))}}</option>
                                  @endforeach
                                </select>
                                <div id="projectType"></div>
                                @error('project_type_id')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
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
                                <select name="source_id" aria-label="Project type" data-error="#leadSource" data-control="select2" data-placeholder="Select a Lead Sources..." class="form-select form-select-solid">
                                  @foreach ($Sources as $Source)
                                  <option value="">Project Type...</option>
                                  <option value="{{ $Source->id }}"{{ ($Source->id == $leads->source_id) ? 'selected' : '' }}>{{ $Source->source }}</option>
                                  @endforeach
                                </select>
                                <div id="leadSource"></div>
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
                                <select name="billing_type" aria-label="Billing type" data-error="#billingType" data-control="select2" data-placeholder="Select a Billing Type..." class="form-select form-select-solid">
                                  <option value="">Billing Type...</option>
                                  <option value="hourly" {{ ($leads->billing_type == 'hourly') ? 'selected' :'' }} >Hourly</option>
                                  <option value="fixed_cost" {{ ($leads->billing_type == 'fixed_cost') ? 'selected' :'' }} >Fixed Cost </option>
                                  <option value="not_mentioned" {{ ($leads->billing_type == 'not_mentioned') ? 'selected' :'' }} >Not Mentioned</option>
                                </select>
                                <div id="billingType"></div>
                                @error('billing_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="d-flex flex-column  col-md-6">
                                <label class="fs-6 fw-bold mb-2">
                                    <span>Status</span>
                                </label>
                                <select name="status" aria-label="Status" data-error="#status" data-control="select2" data-placeholder="Select a Status..." class="form-select form-select-solid">
                                  <option value="">Status...</option>
                                  <option value="Open" {{ ($leads->status == 'open') ? 'selected' : '' }}>Open</option>
                                  <option value="in_Conversation" {{ ($leads->status == 'in_Conversation') ? 'selected' : '' }}>In Conversation</option>
                                  <option value="estimation_submitted" {{ ($leads->status == 'estimation_submitted') ? 'selected' : '' }}>Estimation Submitted</option>
                                  <option value="closed" {{ ($leads->status == 'closed') ? 'selected' : '' }}>Closed</option>
                                  <option value="converted" {{ ($leads->status == 'converted') ? 'selected' : '' }}>Converted</option>
                                </select>
                                <div id="status"></div>
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
                                <select name="user_id" aria-label="Assigned Too" data-error="#assignedTo" data-control="select2" data-placeholder="Select a Assigned Too ..." class="form-select form-select-solid">
                                @foreach ($users as $user)
                                <option value="">Assigned Too...</option>
                                <option value="{{ $user->id }}" {{ ($user->id == $leads->user_id) ? 'selected' : '' }}>{{ucfirst(trans($user->name))}} ({{ucfirst(trans($user->getRole->name))}}) </option>
                                @endforeach
                                </select>
                                <div id="assignedTo"></div>
                                @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        {{-- @dd($leads->clients->client_other_details) --}}
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Client Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter client name" value="{{ ($leads->clients) ? $leads->clients->client_name : '' }}" name="client_name" id="client_name"/>
                            @error('client_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="fs-6 fw-bold mb-2">Client Email</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter client Email" value="{{ ($leads->clients) ? $leads->clients->client_email : '' }}" name="client_email" id="client Email"/>
                                  @error('client_email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 fv-row mb-15">
                                <label class="fs-6 fw-bold mb-2">Client's Details </label>
                                <textarea class="form-control form-control-solid" name="client_other_details" id="" cols="30" rows="5">{{ ($leads->clients) ? $leads->clients->client_other_details : '' }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 fv-row mb-15">
                                
                            
                                <div class="container" id="load-lead-media">
                                    @include('leads.compact.attachments')
                                </div>
                            </div>
                        </div>
                        <div class="form-actions d-flex justify-content-end mt-5">
                            <a href="{{ route('lead') }}"><button type="button" class="btn btn-secondary me-3">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Update</button>
                        </div>
                    </form>

                    {{ Form::open(['route' => ['lead.upload.media',$leads->secret], 'method' => 'POST','class' => 'dropzone','id'=>'dropzoneForm','files'=>'true']) }}
                    {{-- <div class="dropzone" id="dropzoneForm"> --}}
                        <div class="fallback">
                            <input name="file" type="file" id="file1" class="hide" />
                        </div>
                    {{-- </div> --}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
 {{-- Dropzone --}}
 <link rel="stylesheet" href="{{ asset('public/assets/plugins/dropzone/dropzone.css') }}" />
@endsection

@section('scripts')
{{-- dropzone --}}
<script src="{{ asset('public/assets/plugins/dropzone/dropzone.js') }}"></script>
    <script>
        $('#lead_store').validate({
            rules: {
                project_title : 'required',
                project_type_id : 'required',
                source_id : 'required',
                user_id : 'required',
                status : 'required',
                billing_type :'required',
                time_estimation : 'required',
                client_name : 'required',
                client_email : 'required'
            },
            message: {

            project_title : 'Project title is required',
            project_type_id : 'Project type is required',
            source_id : 'Lead source is required',
            user_id : 'Assigned too is required',
            status : 'Project status is required',
            billing_type : 'Billing type is required',
            time_estimation : 'Time estimation is required',
            client_name : 'Client name is required',
            client_email : 'Client email is required',

            },
            errorPlacement: function(error, element){
                var placement = $(element).data('error');
                if(placement){
                    $(placement).append(error);
                }else{
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form){
                form.submit();
            }
        });

        /* lead attachments */
        Dropzone.options.dropzoneForm = {
            maxFilesize: 200,
            parallelUploads: 20,
            acceptedFiles: "jpeg,.jpg,.png,.mp4,.mov,.webm",
            dictFileTooBig: 'File is bigger than 200MB',
            clickable: true,
            maxFiles: 20,
            init: function() {
                console.log('init');
                var msg = 'Maximum File Size Video 200MB / Image 1MB';
                var brswr_img = "{{ asset('public/assets/media/misc/upload-cloud.png') }}";
                var apnd_msg = '<img class="center-item" height="40" width="40" src="' + brswr_img +
                    '" alt=""><h1 class="pt-2 mb-1 font-20 text-color-4 font-weight-normal">Drop files here or  <svp class="text-color-1">browse</svp></h1><h3 class="font-14 text-color-4 font-weight-normal">' +
                    msg + '</h3>';
                $('#dropzoneForm .dz-message').append(apnd_msg);
                $('#dropzoneForm .dz-message span').hide();
            },
            error: function(file, response) {
                console.log('error');

                if ($.type(response) === "string") {
                    var message = response;
                } else {
                    var message = response.message;
                }
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            },
            success: function(file, data) {
                console.log('sucess');

                if (data.status == 200) {
                    $('#load-lead-media').empty().append(data.html);
                } else {
                    if (!data.message) {
                        toastr.error("Something wrong went");
                    } else {
                        toastr.error(data.message);
                    }
                }
            }
        };

    </script>
@endsection
