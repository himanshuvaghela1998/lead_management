<?php

namespace App\Http\Controllers;


use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\SubModel;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;

class SubModelController extends Controller
{
    public function index()
    {
        $submodules = SubModel::with('getModule')->get();
        $models = Module::get();
        return view('subModule.index', compact('submodules', 'models'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {

            $request->validate([
                'model_id' => 'required',
                'name' => 'required|unique:sub_models,name,id',
                'slug' => 'required|unique:sub_models,slug,id'
            ]);

            $subModule = new SubModel;
            $subModule->model_id = $request->input('model_id');
            $subModule->name = $request->input('name');
            $subModule->slug = $request->input('slug');
            $subModule->save();

            if ($subModule) {
                return redirect()->route('submodule')->with('message', 'Insert SuccessFully');
            }else{
                return redirect()->route('submodule')->with('error', 'Sub module not insert ');
            }
        }

    }

    public function editModule($id)
    {
        $submodules = SubModel::with('getModule')->find(getDecrypted($id));
        if ($submodules) {
            $modules = Module::get();
            $view = view('subModule.edit',compact('submodules', 'modules'))->render();
            return response()->json(['status'=>'success','content'=>$view]);
        }
        return response()->json(['status'=>'error']);
    }

    public function updateSubmodule(Request $request, $id)
    {
        $request->validate([
            'model_id' => 'required',
            'name' => 'required',
            'slug' => 'required'
        ]);

        $submodules = SubModel::find(getDecrypted($id));

        if ($submodules) {
            $submodules->model_id = $request->input('model_id');
            $submodules->name = $request->input('name');
            $submodules->slug = $request->input('slug');
            $submodules->save();

            if ($submodules) {
                return redirect()->route('submodule')->with('message', 'Update Successfully');
            }else{
                return redirect()->route('submodule')->with('error', 'Update Failed');
            }
        }
    }

}
