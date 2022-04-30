<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->limit = 10;
        $this->middleware(function ($request, $next) {
			if(Auth::check()) {	
				if(!(User::isAuthorized('module_slug')))
                {
                    return redirect()->route('dashboard')->with('error','Unauthorized access');
                }
			}
			return $next($request);
		});
    }

    public function index()
    {
        if(!(User::isAuthorized('module_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $modules = Module::where('is_delete', '!=', 1)->get();
        return view('module.index', compact('modules'));
    }

    public function create(Request $request)
    {
        if(!(User::isAuthorized('module_create_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        if ($request->method() == 'POST') {

            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:modules,slug,id',
            ], [
                'name.required' => 'Name is required.',
                'slug.required' => 'Slug is required.',
                'slug.unique' => 'Slug is already taken.'
            ]);

            $modules = new Module;
            $modules->name = $request->input('name');
            $modules->slug = $request->input('slug');
            $modules->save();

            Permission::create(['name' => $request->input('slug')]);

            if ($modules) {
                return redirect()->route('module')->with('message', 'Module added successfully');
            }else{
                return redirect()->route('module')->with('error', 'Something went wrong');
            }

        }
    }

    public function moduleEdit(Request $request, $id)
    {
        if(!(User::isAuthorized('module_update_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $editModule = Module::find(getDecrypted($id));
        if ($editModule) {
            $editModule->where('is_delete', '!=', 1)->get()->pluck('name','id')->toArray();
            $view = view('module.edit',compact('editModule'))->render();
            return response()->json(['status'=>'success','content'=>$view]);
        }
        return response()->json(['status'=>'error']);

    }

    public function moduleUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ], [
            'name.required' => 'Name is required.',
            'slug.required' => 'Slug is required.'
        ]);
        $updateModule = Module::find(getDecrypted($id));
        $updateModule->name = $request->input('name');

        if ($updateModule->slug != $request->input('slug')) {
           Permission::where('name',$updateModule->slug)->delete();
           Permission::create(['name' => $request->input('slug')]);
        }

        $updateModule->slug = $request->input('slug');
        $updateModule->save();

        if($updateModule){

            return redirect()->route('module')->with('message', 'Module updated successfully');

        }else{
            return redirect()->route('module')->with('error', 'Something went wrong!');
        }
    }

    public function moduleDelete($id)
    {
        if(!(User::isAuthorized('module_delete_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $deleteModule = Module::where('is_delete',0)->where('id',getDecrypted($id))->first();
        $deleteModule->is_delete = 1;
        $deleteModule->save();
        if($deleteModule){
            Permission::where('name',$deleteModule->slug)->delete();
            $type = 'success';
            $msg = 'Module deleted successfully';
        }else{
            $type = 'error';
            $msg = 'Error! something went wrong!';
        }

        return response()->json(['status'=>$type,'message'=>$msg]);
    }

}
