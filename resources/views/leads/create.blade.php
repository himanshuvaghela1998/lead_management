@extends('layouts.main')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar" style="margin-top: -66px;">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="px-10 mt-0">
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
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <div class="row justify-content-center">
                <div class="col-md-12" style="margin: 25px">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('create') }}" class="horizontal-form" method="POST" id="frm_lead_store" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="required fs-6 fw-bold mb-2">Project Title</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter Project Title" name="project_title" id="project_title"/>
                                            @error('project_title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required fs-6 fw-bold mb-2">Project Type</label>
                                            <select name="project_type_id" aria-label="Project type" data-error="#projectType" class="form-control form-control-solid">
                                                <option value="">Select Project Type</option>
                                                @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ucfirst(trans($project->project_type))}}</option>
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
                                        <label class="required fs-6 fw-bold mb-2">Time Estimation</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter Time Estimation" name="time_estimation" id="time_estimation"/>
                                            @error('time_estimation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="d-flex flex-column col-md-6">
                                        <label class="required fs-6 fw-bold mb-2">
                                            <span >Lead Sources</span>
                                        </label>
                                            <select name="source_id" aria-label="Lead Source" data-error="#leadSource" class="form-control form-control-solid">
                                                <option value="">Select Lead Sources</option>
                                                @foreach ($Sources as $Source)
                                                <option value="{{ $Source->id }}">{{ $Source->source }}</option>
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
                                        <label class="required fs-6 fw-bold mb-2">
                                            <span>Billing Type</span>
                                        </label>
                                            <select name="billing_type" aria-label="Billing type" data-error="#billingType" class="form-control form-control-solid">
                                            <option value="">Select Billing Type</option>
                                            <option value="hourly">Hourly</option>
                                            <option value="fixed_cost">Fixed Cost </option>
                                            <option value="not_mentioned">Not Mentioned</option>
                                            </select>
                                            <div id="billingType"></div>
                                            @error('billing_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="d-flex flex-column  col-md-6">
                                        <label class="required fs-6 fw-bold mb-2">
                                            <span>Project Status</span>
                                        </label>
                                            <select name="status" aria-label="Status" data-error="#status" class="form-control capitalize-letter form-control-solid">
                                                <option value="">Select Project Status</option>
                                                <option value="Open">Open</option>
                                                <option value="in_Conversation">In Conversation</option>
                                                <option value="estimation_submitted">Estimation Submitted</option>
                                                <option value="closed">Closed</option>
                                                <option value="converted">Converted</option>
                                            </select>
                                            <div id="status"></div>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                @can('lead_assign_to_slug')
                                    <div class="row mt-2">
                                        <div class="d-flex flex-column col-md-12">
                                            <label class="required fs-6 fw-bold mb-2">
                                                <span class="">Assigned To</span>
                                            </label>
                                                <select name="user_id" aria-label="Assigned Too" data-error="#assignedTo" class=" form-control form-control-solid">
                                                    <option value="">Assign to a user</option>
                                                    @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" >{{ucfirst(trans($user->name))}}  ({{ucfirst(trans($user->getRole->name))}})</option>
                                                    @endforeach
                                                </select>
                                                <div id="assignedTo"></div>
                                                @error('user_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                @endcan
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="required fs-6 fw-bold mb-2">Client Name</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter client name" name="client_name" id="client_name"/>
                                            @error('client_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required fs-6 fw-bold mb-2">Client Email</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter client Email" name="client_email" id="client Email"/>
                                          @error('client_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-12 fv-row mb-15">
                                        <label class="fs-6 fw-bold mb-2">Client's Details </label>
                                        <textarea class="form-control form-control-solid" name="client_other_details" placeholder="Enter client details" id="client_other_details" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 fv-row mb-15">
                                        <label class="fs-6 fw-bold mb-2">Lead Attachments </label>
                                        <div class="" id="load-lead-media">
                                        </div>
                                        <div class="dropzone" id="dropzoneForm">
                                            <div class="fallback">
                                                <input name="file" type="file" id="file1" class="hide" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="fs-6 fw-bold mb-2">Lead Details</label>
                                        <textarea name="lead_details" id="lead_details" class="form-control form-control-solid"></textarea>
                                        <input type="hidden" name="lead_details_data" id="lead_details_data">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-actions d-flex justify-content-end mt-5">
                                        <a href="{{ route('lead') }}"><button type="button" class="btn btn-secondary btn-sm me-3">Cancel</button></a>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-check "></i> Submit</button>
                                    </div>
                                </div>
                            </form>
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



@section('css')
{{-- Dropzone --}}
<link rel="stylesheet" href="{{ asset('public/assets/plugins/dropzone/dropzone.css') }}" />
@endsection

@section('scripts')
{{-- dropzone --}}
<script src="{{ asset('public/assets/plugins/dropzone/dropzone.js') }}"></script>
<script>
    $(document).ready(function () {
		ClassicEditor.create( document.querySelector( '#lead_details' ) )
		.then( newEditor => {
			desc_editor = newEditor;
			desc_editor.model.document.on( 'change:data', ( evt, data ) => {
				var lead_details =  desc_editor.getData();
                $('#lead_details_data').val(lead_details);
			});
		})
        .catch( error => {
            console.error( error );
        });
	});
    $('#frm_lead_store').submit(function (e) {
        e.preventDefault();
        var form = $(this);

        // check if the input is valid using a 'valid' property
        if (!form.valid) return false;
        var form_data = new FormData($('#frm_lead_store')[0]);
        $.ajax({
            url:"{{ route('create') }}",
            type:'post',
            dataType: 'json',
            cache: false,
            data: form_data,
            processData: false,
            contentType: false,
            success: function (response)
            {
                lead_id = response.secret_id;
                var leadCreateDropzone = Dropzone.forElement('.dropzone');
                leadCreateDropzone.options.url= "{{ url('leads/upload-media') }}/"+lead_id;
                leadCreateDropzone.processQueue();
                window.location.replace("{{ route('lead') }}");
            },
            error: function(xhr) {

            }
        });
    });
    $('#frm_lead_store').validate({
        rules: {
            project_title : {
                required: true
            },
            project_type_id : {
                required: true
            },
            source_id : {
                required: true
            },
            status : {
                required: true
            },
            billing_type : {
                required: true
            },
            time_estimation : {
                required: true
            },
            client_name : {
                required: true
            },
            client_email : {
                required: true
            }
        },
        messages: {
            "project_title":{
                required:"Project title is required here"
            },
            "project_type_id":{
                required:"Project type is required here"
            },
            "source_id":{
                required:"Lead source is required"
            },
            "status":{
                required:"Project status is required"
            },
            "billing_type":{
                required:"Billing type is required"
            },
            "time_estimation":{
                required:"Time estimation is required"
            },
            "client_name":{
                required:"Client name is required"
            },
            "client_email":{
                required:"Client email is required"
            }
        },
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
    });

     /* lead attachments */
        var lead_id = 0;
        Dropzone.options.dropzoneForm = {
            url: "{{ url('leads/upload-media') }}/"+lead_id,
            autoProcessQueue: false,
            maxFilesize: 200,
            parallelUploads: 20,
            acceptedFiles: "jpeg,.jpg,.png,.mp4,.mov,.webm",
            dictFileTooBig: 'File is bigger than 200MB',
            clickable: true,
            addRemoveLinks: true,
            maxFiles: 20,
            init: function() {
                var msg = 'Maximum File Size Video 200MB / Image 1MB';
                var brswr_img = "{{ asset('public/assets/media/misc/upload-cloud.png') }}";
                var apnd_msg = '<img class="center-item" height="40" width="40" src="' + brswr_img +
                    '" alt=""><h1 class="pt-2 mb-1 font-20 text-color-4 font-weight-normal">Drop files here or  <svp class="text-color-1">browse</svp></h1><h3 class="font-14 text-color-4 font-weight-normal">' +
                    msg + '</h3>';
                $('#dropzoneForm .dz-message').append(apnd_msg);
                $('#dropzoneForm .dz-message span').hide();
            },
            error: function(file, response) {
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
                if (data.status == 200) {
                    $('#load-lead-media').html(data.html);
                    toastr.success("Attachment uploaded successfully");
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
