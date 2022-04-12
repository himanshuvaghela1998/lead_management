<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\project_types;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = Lead::where('status', 1)->get();
        return view('leads.index');
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {

            $leads = new Lead();
            $leads->project_title = $request->input('project_title');
            $leads->project_type_id = $request->input('project_type_id');
            dd($leads);
            $leads->save();

        }

        $project = project_types::get();
        return view('leads.create', compact('project'));

    }

}
