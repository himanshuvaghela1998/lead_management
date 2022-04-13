<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Client;
use App\Models\ProjectType;
use App\Models\LeadSources;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = Lead::with('clients', 'ProjectType')->paginate(5);

        $leads = Lead::with('clients', 'ProjectType');
        if (!$request->search == '') {
            $leads = $leads->where('status', 'LIKE', "%".$request->search."%")->paginate(5);
            $view =  view('leads.compact.lead_list', compact('leads'))->render();
            return response()->json(['status'=>200,'message','content'=>$view]);
        }
        $leads = $leads->paginate(5)->appends($request->all());
        if ($request->ajax()) {
            $view = view('leads.compact.lead_list', compact('leads'))->render();
            return response()->json(['status'=>200,'message','content'=>$view]);
        }
        return view('leads.index', compact('leads'));
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {

            $leads = new Lead();
            $leads->project_title = $request->input('project_title');
            $leads->project_type_id = $request->input('project_type_id');
            $leads->source_id = $request->input('source_id');
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

        $projects = ProjectType::get();
        $Sources = LeadSources::get();
        return view('leads.create', compact('projects', 'Sources'));

    }

    public function edit($id)
    {
        $leads = Lead::find($id);
        return view('leads.edit', compact('leads'));
    }

}
