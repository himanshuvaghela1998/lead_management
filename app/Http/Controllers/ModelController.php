<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModelController extends Controller
{
    public function index()
    {
        $modules = Module::get();
        return view('module.index', compact('modules'));
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {

            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:lead_modals,slug,id',
            ], [
                'name.required' => 'Name is required.',
                'slug.required' => 'Slug is required.'
            ]);

            $model = new Module();
            $model->name = $request->input('name');
            $model->slug = $request->input('slug');
            $model->save();

            if ($model) {

                return redirect()->route('module')->with('message', 'model insert successfully');
            }else{
                return redirect()->route('module')->with('error', 'model not insert');
            }

        }
    }

    public function moduleEdit($id)
    {
        $editModule = Module::find(getDecrypted($id));
        if ($editModule) {
            // $editModule = Lead_model::find(getDecrypted($id));
            $view = view('module.edit',compact('editModule'))->render();
            return response()->json(['status'=>'success','content'=>$view]);
        }
        return response()->json(['status'=>'error']);
    }

    public function moduleUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:lead_modals,slug,', $id
        ], [
            'name.required' => 'Name is required.',
            'slug.required' => 'Slug is required.'
        ]);

            $updateModule = Module::find(getDecrypted($id));
            $updateModule->name = $request->input('name');
            $updateModule->slug = $request->input('slug');
            $updateModule->save();

            if($updateModule){

                return redirect()->route('module')->with('message', 'Module Update successfully');

            }else{
                return redirect()->route('module')->with('error', 'something went to wrong!');
            }

            // return response()->json(['status'=>$type,'message'=>$msg

    }

    public function moduleDelete($id)
    {
        $deleteModule = Module::where('is_delete',0)->where('id',getDecrypted($id))->first();
        $deleteModule->is_delete = 1;
        $deleteModule->save();
        if($deleteModule){
            $type = 'success';
            $msg = 'User deleted successfully';
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
        }

        return response()->json(['status'=>$type,'message'=>$msg]);
    }

}
