<div class="d-flex justify-content-end mb-10">
    <!--begin::Wrapper-->
    <div class="d-flex flex-column align-items-end">
        <!--begin::User-->
        <div class="d-flex align-items-center mb-2">
            <!--begin::Details-->
            <div class="me-3">
                <span class="text-muted fs-9 mb-1">{{get_time_ago(strtotime($lead_thread->created_at))}}</span>
                <span class="fw-bolder capitalize-letter">{{ Auth::user()->name }}</span>
                <span class="badge badge-light capitalize-letter">
                    {{ isset(Auth::user()->getRole) ? Auth::user()->getRole->name : ''}}
                </span>
            </div>
            <!--end::Details-->
        </div>
        <!--end::User-->
        <!--begin::Text-->
        <div class="d-flex align-items-center">
            <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text">
                {{ $lead_thread->message }}
            </div>
            <span class="intial-letter-chat-image">{{ Auth::user()->name[0] }}</span>
        </div>
        <!--end::Text-->
    </div>
    <!--end::Wrapper-->
</div>