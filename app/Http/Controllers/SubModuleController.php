<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\SubModule;



class SubModuleController extends Controller
{
    public function index()
    {
        $submodules = SubModule::where('is_delete', '!=', 1)->with('getModule')->get();
        $modules = Module::get();
        return view('subModule.index', compact('submodules', 'modules'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {

            $request->validate([
                'module_id' => 'required',
                'name' => 'required|unique:sub_modules,name,id',
                'slug' => 'required|unique:sub_modules,slug,id'
            ]);

            $subModule = new SubModule;
            $subModule->module_id = $request->input('module_id');
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
        $submodules = SubModule::with('getModule')->find(getDecrypted($id));
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
            'module_id' => 'required',
            'name' => 'required',
            'slug' => 'required'
        ]);

        $submodule = SubModule::find(getDecrypted($id));

        if ($submodule) {
            $submodule->module_id = $request->input('module_id');
            $submodule->name = $request->input('name');
            $submodule->slug = $request->input('slug');
            $submodule->save();

            if ($submodule) {
                return redirect()->route('submodule')->with('message', 'Update Successfully');
            }else{
                return redirect()->route('submodule')->with('error', 'Update Failed');
            }
        }
    }

    public function deleteSubModule($id)
    {
        $subModule = SubModule::find(getDecrypted($id));

        if (isset($subModule)) {

            $subModule->is_delete = 1;
            $subModule->save();
            if($subModule){
                $type = 'success';
                $msg = 'SubModule deleted successfully';
            }else{
                $type = 'error';
                $msg = 'Error! something went to wrong!';
            }

        return response()->json(['status'=>$type,'message'=>$msg]);

        }else{

            return redirect()->back()->with('error', 'No data found');
        }
    }


}
