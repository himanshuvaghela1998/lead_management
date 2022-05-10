<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Client;
use App\Models\LeadAttachment;
use App\Models\ProjectType;
use App\Models\LeadSources;
use App\Models\LeadThread;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Thumbnail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Image;

class LeadController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = 10;
        $this->middleware(function ($request, $next) {
			if(Auth::check()) {
				if(!(User::isAuthorized('lead')))
                {
                    return redirect()->route('dashboard')->with('error','Unauthorized access');
                }
			}
			return $next($request);
		});
    }

    public function index(Request $request)
    {
        if(!(User::isAuthorized('lead')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $leads = Lead::with('clients', 'projectType', 'getUser')->where('is_delete',0);

        if($request->has('search_keyword') && $request->search_keyword != ""){
            $leads = $leads->where(function($q) use($request){
                $q->where('status', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('project_title', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhereHas('clients', function($q1) use ($request){
                    $q1->where('client_name', 'LIKE', '%' .$request->search_keyword. '%');
                });
                $q->orWhereHas('getUser', function($q2) use ($request){
                    $q2->where('name', 'LIKE', '%' .$request->search_keyword. '%');
                });
            });
        }
        /* Date filter */
        if ($request->from_date != 0) {
                $leads->whereBetween('created_at', [$request->from_date. ' 00:00:00',$request->to_date . ' 23:59:59'] );
            }

        /* Status filter */
        if (!is_null($request->status_id) && $request->status_id != '-1') {
            $leads->where('status', $request->status_id);
        }
        $leads = $leads->paginate($this->limit)->appends($request->all());
        $users = User::where('is_delete',0)->where('role_id', '!=', 4)->where('status', 1)->get();
        if($request->ajax()){
            $view = view('leads.compact.lead_list',compact('leads','users'))->render();
            return response()->json(['status'=>200,'message','content'=>$view]);
        }

        return view('leads.index', compact('leads', 'users'));
    }

    public function create(Request $request)
    {
        if(!(User::isAuthorized('lead_update')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        if ($request->method() == 'POST') {
            $request->validate([
                'project_title' => 'required',
                'project_type_id' => 'required',
                'client_name' => 'required',
                'source_id' => 'required',
            ],
        [
            'project_title.required' => 'Project title is required',
            'project_type_id.required' => 'Project type is required',
            'client_name.required' => 'Client name is required',
            'source_id.required' => 'Lead source is required',

        ]);


            $lead = new Lead();
            $lead->project_title = $request->input('project_title');
            $lead->project_type_id = $request->input('project_type_id');
            $lead->source_id = $request->input('source_id');
            if(User::isAuthorized('lead_assign_to'))
            {
                $lead->user_id = $request->input('user_id');
            }
            $lead->status = 'open';
            $lead->billing_type = $request->input('billing_type');
            $lead->time_estimation = $request->input('time_estimation');
            $lead->lead_details = $request->input('lead_details');
            $lead->save();

            $clients = new Client();
            $clients->lead_id = $lead->id;
            $clients->client_name = $request->input('client_name');
            $clients->client_email = $request->input('client_email');
            $clients->client_skype = $request->input('client_skype');
            $clients->client_other_details = $request->input('client_other_details');
            $clients->save();

            return response()->json(['success' => true,'secret_id' => $lead->secret]);

        }
        $auth_user = User::where('id',Auth::user()->id)->first();
        $users = User::with('getRole')->where([['role_id', '!=', 1],['status',1],['is_delete', 0]])->get();
        $projects = ProjectType::get();
        $Sources = LeadSources::get();
        return view('leads.create', compact('projects', 'Sources', 'users', 'auth_user'));

    }

    public function edit($id)
    {
        if(!(User::isAuthorized('lead_update')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $auth_user = User::where('id',Auth::user()->id)->first();
        $users = User::with('getRole')->where([['role_id', '!=', 1],['status',1],['is_delete', 0]])->get();
        $projects = ProjectType::get();
        $Sources = LeadSources::get();
        $leads = Lead::with('clients', 'projectType','leadAttachments')->find(getDecrypted($id));
        $lead_attachments = $leads->leadAttachments;
        if (!$leads == null) {
        return view('leads.edit', compact('leads', 'projects', 'Sources', 'users','lead_attachments', 'auth_user'));
        }else{
            return redirect(route('lead'));
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'project_title' => 'required',
            'project_type_id' => 'required',
            'client_name' => 'required',
            'source_id' => 'required',
        ],
    [
        'project_title.required' => 'Project title is required',
        'project_type_id.required' => 'Project type is required',
        'client_name.required' => 'Client name is required',
        'source_id.required' => 'Lead source is required',

    ]);

        $lead = Lead::find($id);
        $lead->project_title = $request->input('project_title');
        $lead->project_type_id = $request->input('project_type_id');
        $lead->source_id = $request->input('source_id');
        if(User::isAuthorized('lead_assign_to'))
        {
            $lead->user_id = $request->input('user_id');
        }
        $lead->billing_type = $request->input('billing_type');
        $lead->time_estimation = $request->input('time_estimation');
        $lead->lead_details = $request->input('lead_details');
        $lead->save();
        $clients = Client::where('lead_id',$id)->first();
        $clients->lead_id = $lead->id;
        $clients->client_name = $request->input('client_name');
        $clients->client_email = $request->input('client_email');
        $clients->client_skype = $request->input('client_skype');
        $clients->client_other_details = $request->input('client_other_details');
        $clients->save();

        if ($clients) {
            return redirect()->route('lead')->with('message', 'Update successfully');
        }else{
            return redirect()->route('lead')->with('error', 'Not update data');
        }

    }

    public function delete($id)
    {
        if(!(User::isAuthorized('lead_delete')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $lead = Lead::where('is_delete',0)->where('id',getDecrypted($id))->first();
        if($lead){
            $lead->is_delete = 1;
            $lead->save();
            $type = 'success';
            $msg = 'Leads deleted successfully';
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
        }
        return response()->json(['status'=>$type,'message'=>$msg]);
    }

    public function uploadLeadMedia(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => 401, 'message' => $validator->errors()->first()]);
        } else {
            $ismime = $request->file->getClientMimeType();
            if (strstr($ismime, "image/")) {
                $validator = Validator::make($request->all(), [
                    'file' => 'mimetypes:image/jpg,image/jpeg,image/png|max:1024'
                ], [
                    'file.max' => 'File is larger than 1MB'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'file' => 'mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:204800'
                ], [
                    'file.max' => 'File is larger than 200MB'
                ]);
            }

            if ($validator->fails()) {
                return response()->json(['success' => false, 'status' => 401, 'message' => $validator->errors()->first()]);
            }
        }
        try {
            $lead_id = getDecrypted($id);
            $original_name = $request->file->getClientOriginalName();
            $mime = $request->file->getClientMimeType();
            $filesize = formatBytes($request->file->getSize(), 2);
            $extension = $request->file->extension();
            $file_name = time() . rand() . '.' . $extension;
            $image_extension = ['jpg', 'jpeg', 'png'];
            $thumb_name = 'thumb_' . time() . rand() . '.png';
            $destination_path = 'public/uploads/lead_attachments';
            $thumbnail_source_path = '';
            $media_type = '';
            if (!in_array($extension, $image_extension)) {
                $media_type = 'video';
                $input['media_url'] = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file->move($destination_path, $input['media_url']);
                $thumbnail_source_path = $destination_path . '/' . $input['media_url'];
            } else {
                $media_type = 'image';
                // Image thumbnail
                $thumbnail_source_path = $destination_path . '/' . $thumb_name;
                // Local Thumbnail Url
                Image::make($request->file->getRealPath())->fit(env('THUMBNAIL_IMAGE_WIDTH'), env('THUMBNAIL_IMAGE_HEIGHT'), NULL, 'top')->save($thumbnail_source_path, 85);
                //End Generate thumbnail
            }
            $lead_attachment = new LeadAttachment;
            $lead_attachment->lead_id = $lead_id;
            $lead_attachment->type = $media_type;
            $lead_attachment->url = $thumbnail_source_path;
            $lead_attachment->s3_key = $thumbnail_source_path;
            $lead_attachment->save();
            $lead_attachments = LeadAttachment::where('lead_id', $lead_id)->orderBy('id', 'desc')->get();
            $view = view('leads.compact.attachments', compact('lead_attachments'))->render();
            return response()->json(['success' => true, 'status' => 200, 'html' => $view, 'message' => 'Attachment uploaded successfully.', '']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'status' => 401, 'message' => 'Something went wrong. Please try again.']);
        }
    }

    public function lead_media_delete(Request $request)
    {
        $lead_attachment =LeadAttachment::where('id',$request->id)->delete();
        if($lead_attachment){
            return response()->json(['status'=>"success",'message'=>'Lead attachment deleted successfully.']);
        }
        else{
            return response()->json(['status'=>"success",'message'=>'Something went wrong.']);
        }
    }

    public function leadChat(Request $request,$id)
    {
        if(!(User::isAuthorized('lead_thread')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $lead = Lead::with('clients', 'projectType', 'getUser','leadThreads','leadThreads.getSender')->where('id',getDecrypted($id))->first();
        if ($request->method() == 'POST') {
            $lead_thread = new LeadThread;
            if ($request->file('thread_attachment') != null) {
                $ismime = $request->thread_attachment->getClientMimeType();
                if (strstr($ismime, "image/")) {
                    $validator = Validator::make($request->all(), [
                        'thread_attachment' => 'mimetypes:image/jpg,image/jpeg,image/png|max:'.(int)env('OTHER_MAX_SIZE')*1024
                    ], [
                        'thread_attachment.max' => 'File is larger than '.env('OTHER_MAX_SIZE').'MB'
                    ]);
                } elseif(strstr($ismime, "video/")) {
                    $validator = Validator::make($request->all(), [
                        'thread_attachment' => 'mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:'.(int)env('VIDEO_MAX_SIZE')*1024
                    ], [
                        'thread_attachment.max' => 'File is larger than '.env('VIDEO_MAX_SIZE').'MB'
                    ]);
                }else
                {
                    $validator = Validator::make($request->all(), [
                        'thread_attachment' => 'mimetypes:application/pdf,application/msword|max:'.(int)env('OTHER_MAX_SIZE')*1024
                    ], [
                        'thread_attachment.max' => 'File is larger than '.env('OTHER_MAX_SIZE').'MB'
                    ]);
                }


                if ($validator->fails()) {
                    return response()->json(['status' => 401, 'message' => $validator->errors()->first()]);
                }
                try {
                    $thumb_name = 'thumb_' . time() . rand() . '.png';
                    $destination_path = 'public/uploads/thread_attachments';
                    $thumbnail_source_path = '';
                    $media_type = '';
                    if (strstr($ismime, "video/")) {
                        $media_type = 'video';
                        $input['media_url'] = time() . '.' . $request->thread_attachment->getClientOriginalExtension();
						$request->thread_attachment->move($destination_path, $input['media_url']);
						$source_url = $destination_path . '/' . $input['media_url'];
                        $lead_thread->attachment_url = $source_url;
                    } elseif(strstr($ismime, "image/"))
                    {
                        $media_type = 'image';
                        // Image thumbnail
                        $thumbnail_source_path = $destination_path . '/' . $thumb_name;
                        // Local Thumbnail Url
                        Image::make($request->thread_attachment->getRealPath())->fit(env('THUMBNAIL_IMAGE_WIDTH'), env('THUMBNAIL_IMAGE_HEIGHT'), NULL, 'top')->save($thumbnail_source_path, 85);
                        //End Generate thumbnail
                        $lead_thread->attachment_url = $thumbnail_source_path;
                    }else
                    {
                        $media_type = 'doc';
                        $input['media_url'] = time() . '.' . $request->thread_attachment->getClientOriginalExtension();
						$request->thread_attachment->move($destination_path, $input['media_url']);
						$source_url = $destination_path . '/' . $input['media_url'];
                        $lead_thread->attachment_url = $source_url;
                    }
                    $lead_thread->is_attachment = 1;
                    $lead_thread->attachment_type = $media_type;
                }
                catch (Exception $e) {
                    return response()->json(['success' => false, 'status' => 401, 'message' => 'Something went wrong. Please try again.']);
                }
            }
            $lead_thread->lead_id = $lead->id;
            $lead_thread->sender_id = Auth::user()->id;
            $lead_thread->message = $request->message;
            $lead_thread->save();

            $view = view('leads.compact.msg_out',compact('lead_thread'))->render();
            return response()->json(['status' => 200 , 'message' => "Message sent", 'content' => $view]);
        }
        return view('leads.chat',compact('lead'));
    }

    public function changeLeadStatus(Request $request,$id)
    {
        if(!(User::isAuthorized('lead_change_status')))
        {
            return response()->json(['status'=>'error','message'=>'Unauthorized access']);
        }
        /* Record status update*/
        $lead = Lead::select('id','status')->find(getDecrypted($id));
        $lead->status = $request->selected_status;
        $lead->save();
        if($lead){
            $type = 'success';
            $msg = 'Status updated successfully';
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
        }
        return response()->json(['status'=>$type,'message'=>$msg]);
    }

    public function changeLeadAssignee(Request $request, $id)
    {
        if (!(User::isAuthorized('lead_change_assignee'))) {
            return response()->json(['status'=>'error', 'message'=>'Unauthorized access']);
        }

        // $user = User::select('id','name')->find(getDecrypted($id));
        $lead = Lead::select('id', 'user_id')->find(getDecrypted($id));
        $lead->user_id = $request->selected_assignee;
        $lead->save();

        $data = user::select('id','name')->find($request->selected_assignee);

        // $lead->save();
        if ($lead) {
            $type = 'success';
            $msg = 'Lead assigned successfully';
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
        }

        return response()->json(['status'=>$type, 'message'=>$msg, 'content'=>$data]);
    }

    public function uploadLeadDetails(Request $request)
    {

        $path_url = 'storage/uploads';

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $lead_details = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $lead_details = $lead_details . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('storage/uploads'), $lead_details);

            $url = asset('storage/uploads/' . $lead_details);
            return response()->json(['lead_details' => $lead_details, 'uploaded'=> 1, 'url' => $url]);


        }

    }


}
