@extends('layouts.main')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid mt-6" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10" >
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header lead-details-card-header">
                            <div class="badge badge-light-info d-inline capitalize-letter">{{ str_replace('_', ' ', $lead->status) }}</div>
                        </div>
                        <!--begin::Card body-->
                        <div class="card-body lead-details-card-body">
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4">
                                <div class="fw-bolder rotate" aria-expanded="false">
                                    {{ $lead->project_title }}
                                </div>
                            </div>
                            <div class="text-gray-600 capitalize-letter">{{ isset($lead->ProjectType) ? $lead->ProjectType->project_type : '' }}</div>
                            <!--end::Details toggle-->
                            <div class="separator separator-dashed pt-1"></div>
                            <!--begin::Details content-->
                            <div id="kt_customer_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    <div class="fw-bolder mt-5">Client Name</div>
                                    <div class="text-gray-600 capitalize-letter">{{ isset($lead->clients) ? $lead->clients->client_name : '' }}</div>
                                    <div class="fw-bolder mt-5">Client Email</div>
                                    <div class="text-gray-600">{{ isset($lead->clients) ? $lead->clients->client_email : '' }}</div>
                                    <div class="fw-bolder mt-5">Client Details</div>
                                    <div class="text-gray-600">{{ isset($lead->clients) ? $lead->clients->client_other_details : '' }}</div>
                                    <div class="fw-bolder mt-5">Assign To</div>
                                    <div class="text-gray-600 capitalize-letter">
                                        {{ isset($lead->getUser) ? $lead->getUser->name : ''}}
                                        <span class="badge badge-light capitalize-letter">
                                            {{ isset($lead->getUser) && isset($lead->getUser->getRole) ? $lead->getUser->getRole->name : ''}}
                                        </span>
                                    </div>
                                    <div class="fw-bolder mt-5">Estimated Time</div>
                                    <div class="text-gray-600">{{ $lead->time_estimation }}</div>
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                    <!--begin::Messenger-->
                    <div class="card" id="chat_messenger">
                        <!--begin::Card header-->
                        <div class="card-header" id="chat_messenger_header">
                            <!--begin::Title-->
                            <div class="card-title">
                                <!--begin::User-->
                                <div class="d-flex justify-content-center flex-column me-3">
                                    {{ $lead->project_title }}
                                    {{-- <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Brian Cox</a> --}}
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body" id="chat_messenger_body">
                            <!--begin::Messages-->
                            <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto chat-window" id="thread_messages" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #chat_messenger_header, #chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #chat_messenger_body" data-kt-scroll-offset="5px">
                                @foreach ($lead->leadThreads as $lead_thread)
                                    @if ($lead_thread->sender_id == Auth::user()->id)
                                        <!--begin::Message(out)-->
                                        @include('leads.compact.msg_out')
                                        <!--end::Message(out)-->
                                    @else
                                        <!--begin::Message(in)-->
                                        @include('leads.compact.msg_in')
                                        <!--end::Message(in)-->
                                    @endif
                                @endforeach
                            </div>
                            <!--end::Messages-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer pt-4" id="chat_messenger_footer">
                            <form action="{{ route('lead.chat',$lead->secret) }}" method="POST" id="frm_lead_thread" enctype="multipart/form-data">
                            @csrf
                                <!--begin::Input-->
                                {{-- <input class="form-control form-control-flush mb-3" name="message" id="message" autocomplete="off" placeholder="Type a message"/> --}}
                                <textarea class="form-control form-control-flush mb-3" rows="1" name="message" id="message" data-kt-element="input" placeholder="Type a message"></textarea>
                                <!--end::Input-->
                                <!--begin:Toolbar-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center me-2">
                                        <label for="thread_attachment">
                                            <i class="bi bi-paperclip fs-3"></i>
                                          </label>
                                        <input style="display: none" type="file" id="thread_attachment" name="thread_attachment" />
                                    </div>
                                    <!--end::Actions-->
                                    <!--begin::Send-->
                                    <button class="btn btn-primary" id="btn_lead_thread_submit" type='submit' data-kt-element="send">Send</button>
                                    <!--end::Send-->
                                </div>
                                <!--end::Toolbar-->
                            </form>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Messenger-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
