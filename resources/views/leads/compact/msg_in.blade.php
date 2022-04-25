<div class="d-flex justify-content-start mb-10">
    <!--begin::Wrapper-->
    <div class="d-flex flex-column align-items-start">
        <!--begin::User-->
        <div class="d-flex align-items-center mb-2">
            <!--begin::Avatar-->
            <div class="symbol symbol-35px symbol-circle">
                {{-- <img alt="Pic" src="/metronic8/demo8/assets/media/avatars/300-25.jpg" /> --}}
            </div>
            <!--end::Avatar-->
            <!--begin::Details-->
            <div class="ms-3">
                <span class="fw-bolder capitalize-letter">Brian Cox</span>
                <span class="badge badge-light capitalize-letter">
                    Sales
                </span>
                <span class="text-muted fs-9 mb-1">{{get_time_ago(strtotime($lead_thread->created_at))}}</span>
            </div>
            <!--end::Details-->
        </div>
        <!--end::User-->
        <!--begin::Text-->
        <div class="d-flex align-items-center">
            <span class="intial-letter-chat-image">B</span>
            <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">
                {{ $lead_thread->message }}
                @if ($lead_thread->is_attachment == 1)
                    <br>
                    @if ($lead_thread->attachment_type == 'image')
                        <img src="{{ url($lead_thread->attachment_url) }}" alt="attachment" height="70" width="100">
                    @endif
                    @if ($lead_thread->attachment_type == 'video')
                        <video src="{{ url($lead_thread->attachment_url) }}" height="70" width="100"></video>
                    @endif
                @endif
            </div>
        </div>
        <!--end::Text-->
    </div>
    <!--end::Wrapper-->
</div>