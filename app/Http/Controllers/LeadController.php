<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Client;
use App\Models\ProjectType;
use App\Models\LeadSources;
use App\Models\User;

class LeadController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = 10;
    }

    public function index(Request $request)
    {
        $leads = Lead::with('clients', 'projectType');

        if($request->has('search_keyword') && $request->search_keyword != ""){
            $leads = $leads->where(function($q) use($request){
                $q->where('status', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }

        /* Status filter */
          if (!is_null($request->status)) {
            $leads->where('status', $request->status);
        }
        $leads = $leads->paginate($this->limit)->appends($request->all());
        if($request->ajax()){
            $view = view('leads.compact.lead_list',compact('leads'))->render();
            return response()->json(['status'=>200,'message','content'=>$view]);
        }

        return view('leads.index', compact('leads'));
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {

            $request->validate([
                'project_title' => 'required',
                'project_type_id' => 'required',
                'source_id' => 'required',
                'user_id' => 'required',
                'status' => 'required',
                'billing_type' => 'required',
                'time_estimation' => 'required',
                'client_name' => 'required',
                'client_email' => 'required|email',
                'client_other_details' => 'required'
            ]);


            $leads = new Lead();
            $leads->project_title = $request->input('project_title');
            $leads->project_type_id = $request->input('project_type_id');
            $leads->source_id = $request->input('source_id');
            $leads->user_id = $request->input('user_id');
            $leads->status = $request->input('status');
            $leads->billing_type = $request->input('billing_type');
            $leads->time_estimation = $request->input('time_estimation');
            $leads->save();
            $clients = new Client();
            $clients->lead_id = $leads->id;
            $clients->client_name = $request->input('client_name');
            $clients->client_email = $request->input('client_email');
            $clients->client_other_details = $request->input('client_other_details');
            $clients->save();

            return redirect()->route('lead')->with('message','Insert successfully');

        }

        $users = User::where([['role_id', '!=', 1],['status',1],['is_delete', 0]])->get();
        $projects = ProjectType::get();
        $Sources = LeadSources::get();
        return view('leads.create', compact('projects', 'Sources', 'users'));

    }

    public function edit($id)
    {
        $users = User::where([['role_id', '!=', 1],['status',1],['is_delete', 0]])->get();
        $projects = ProjectType::get();
        $Sources = LeadSources::get();
        $leads = Lead::with('clients', 'projectType')->find($id);
        if (!$leads == null) {
        return view('leads.edit', compact('leads', 'projects', 'Sources', 'users'));
        }else{
            return redirect(route('lead'));
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'project_title' => 'required',
            'project_type_id' => 'required',
            'source_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'billing_type' => 'required',
            'time_estimation' => 'required',
            'client_name' => 'required',
            'client_email' => 'required|email',
            'client_other_details' => 'required'
        ]);


        $leads = Lead::find($id);
        $leads->project_title = $request->input('project_title');
        $leads->project_type_id = $request->input('project_type_id');
        $leads->source_id = $request->input('source_id');
        $leads->user_id = $request->input('user_id');
        $leads->status = $request->input('status');
        $leads->billing_type = $request->input('billing_type');
        $leads->time_estimation = $request->input('time_estimation');
        $leads->save();
        $clients = new Client();
        $clients->lead_id = $leads->id;
        $clients->client_name = $request->input('client_name');
        $clients->client_email = $request->input('client_email');
        $clients->client_other_details = $request->input('client_other_details');
        $clients->save();

        if ($clients) {
            return redirect()->route('lead')->with('message', 'Update successfully');
        }else{
            return redirect()->route('lead')->with('error', 'Not update data');
        }

    }

    public function delete(Request $request, $id)
    {
        $leads = Lead::find($id);
        $leads->is_delete = $request->input(0);
        dd($leads);
    }
}
