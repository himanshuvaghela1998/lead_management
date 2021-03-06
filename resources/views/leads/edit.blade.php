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
                        <div class="card-body">
                            <form action="{{ route('update', $leads->id) }}" class="horizontal-form" method="POST" id="lead_store">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="row mt-2">
                                        <div class=" col-md-6">
                                            <label class="required fs-6 fw-bold mb-2">Project Title</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Enter Project Title" value="{{ $leads->project_title }}" name="project_title" id="project_title"/>
                                                @error('project_title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                        <div class="d-flex flex-column col-md-6">
                                            <label class="required fs-6 fw-bold mb-2">
                                                <span>Project Type</span>
                                            </label>
                                            <select name="project_type_id" aria-label="Project type" data-error="#projectType" class="form-select form-select-solid ">
                                                <option value="">Select project type</option>
                                                @foreach ($projects as $project)
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
                                            <label class="required fs-6 fw-bold mb-2">Client Name</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Enter client name" value="{{ ($leads->clients) ? $leads->clients->client_name : '' }}" name="client_name" id="client_name"/>
                                                @error('client_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class=" fs-6 fw-bold mb-2">Client Email</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Enter client Email" value="{{ ($leads->clients) ? $leads->clients->client_email : '' }}" name="client_email" id="client_email"/>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        @if(isset($auth_user) && $auth_user->hasRole('Super Admin') || $auth_user->hasRole('admin') || $auth_user->hasRole('sales'))
                                        <div class="col-md-6">
                                            <label class=" fs-6 fw-bold mb-2">Client Skype</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Enter client skype" value="{{ ($leads->clients) ? $leads->clients->client_skype : '' }}" name="client_skype" id="client_skype"/>
                                        </div>
                                        @endif
                                        <div class="col-md-6">
                                            <label class="fs-6 fw-bold mb-2">Client's Details </label>
                                            <textarea class="form-control form-control-solid" name="client_other_details" id="" cols="30" rows="5">{{ ($leads->clients) ? $leads->clients->client_other_details : '' }}</textarea>
                                        </div>
                                        <div class="d-flex flex-column col-md-6">
                                            <label class="required fs-6 fw-bold mb-2">
                                                <span>Lead Sources</span>
                                            </label>
                                            <select name="source_id" aria-label="Lead Source" data-error="#leadSource" class="form-select form-select-solid">
                                                <option value="">Select lead source</option>
                                                @foreach ($Sources as $Source)
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
                                        <div class="col-md-12">
                                            <label class="fs-6 fw-bold mb-2">Lead Details</label> {{-- TODO this fileld need to do required --}}
                                            <textarea name="lead_details" id="lead_details" class="form-control form-control-solid">{{ str_replace( '&', '&amp;', $leads->lead_details) }}</textarea>
                                        </div>
                                        @error('lead_details')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label class="fs-6 fw-bold mb-2">Lead Attachments</label>
                                            <div class="" id="load-lead-media">
                                                @include('leads.compact.attachments')
                                            </div>
                                            <div class="dropzone" id="dropzoneForm">
                                                <div class="fallback">
                                                    <input name="file" type="file" id="file1" class="hide" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="d-flex flex-column  col-md-6">
                                            <label class=" fs-6 fw-bold mb-2">
                                                <span>Billing Type</span>
                                            </label>
                                            <select name="billing_type" aria-label="Billing type" data-error="#billingType" class="form-select form-select-solid">
                                                <option value="">Select billing type</option>
                                                <option value="hourly" {{ ($leads->billing_type == 'hourly') ? 'selected' :'' }} >Hourly</option>
                                                <option value="fixed_cost" {{ ($leads->billing_type == 'fixed_cost') ? 'selected' :'' }} >Fixed Cost </option>
                                                <option value="not_mentioned" {{ ($leads->billing_type == 'not_mentioned') ? 'selected' :'' }} >Not Mentioned</option>
                                            </select>
                                            <div id="billingType"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class=" fs-6 fw-bold mb-2">Time Estimation</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Enter Time Estimation" value="{{ $leads->time_estimation }}" name="time_estimation" id="time_estimation"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions d-flex justify-content-end mt-5">
                                    <a href="{{ route('lead') }}"><button type="button" class="btn btn-secondary me-3 btn-sm">Cancel</button></a>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-check"></i> Update</button>
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
       $('#lead_store').validate({
           rules: {
               project_title : 'required',
               project_type_id : 'required',
               source_id : 'required',
               client_name : 'required',
           },
           message: {

           project_title : 'Project title is required',
           project_type_id : 'Project type is required',
           source_id : 'Lead source is required',
           client_name : 'Client name is required',

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
               var leadEditDropzone = Dropzone.forElement('.dropzone');
               leadEditDropzone.processQueue();
               form.submit();
           }
       });

       /* lead attachments */
       Dropzone.options.dropzoneForm = {
           url: "{{ route('lead.upload.media',$leads->secret) }}",
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

       /* delete lead attachment */
       $(document).on('click','.image_trash',function(){
           var id =$(this).attr('data-value');
           Swal.fire({
               text: "Are you want to delete this attachment?",
               icon: "warning",
               showCancelButton: !0,
               buttonsStyling: !1,
               confirmButtonText: "Confirm",
               cancelButtonText: "Cancel",
               customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
           }).then(function (result) {
               console.log(result.isConfirmed);
               if(result.isConfirmed){
                   $.ajax({
                       url: "{{route('lead.media.delete')}}",
                       type: "POST",
                       data: {
                           id: id,
                           _token: '{{csrf_token()}}'
                       },
                       dataType: 'json',
                       success: function (data) {
                           $('.pic_'+id+'_delete').remove();
                           toastr.success('Attachment deleted successfully');
                       }
                   });
               }else{

                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            ClassicEditor.create( document.querySelector( '#lead_details' ) )
            .then( newEditor => {
                desc_editor = newEditor;
                desc_editor.model.document.on( 'change:data', ( evt, data ) => {
                    var lead_details =  desc_editor.getData();
                });
            })
            .catch( error => {
                console.error( error );
            });
        });
    </script>
@endsection
