<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Permission;
use App\Models\SubModule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubModuleController extends Controller
{
    public function __construct()
    {
        $this->limit = 10;
        $this->middleware(function ($request, $next) {
			if(Auth::check()) {	
				if(!(User::isAuthorized('submodule_slug')))
                {
                    return redirect()->route('dashboard')->with('error','Unauthorized access');
                }
            }
			return $next($request);
		});
    }

    public function index()
    {
        if(!(User::isAuthorized('submodule_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $submodules = SubModule::where('is_delete', '!=', 1)->with('getModule')->get();
        $modules = Module::where('is_delete', '!=', 1)->get();
        return view('subModule.index', compact('submodules', 'modules'));
    }

    public function create(Request $request)
    {
        if(!(User::isAuthorized('submodule_create_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }


        if ($request->method() == 'POST') {

            $validator = Validator::make($request->all(),[
                'module_id' => 'required',
                'name' => 'required',
                'slug' => 'required|unique:sub_modules,slug'
            ], [
                'module_id.required' => 'Module name is required',
                'name.required' => 'Name is required.',
                'slug.required' => 'Slug is required.',
                'slug.unique' => 'Slug is already taken.'
            ]);
            if ($validator->fails()) {
                return redirect()->route('submodule')->with('error', $validator->errors()->first());
            }

            $subModule = new SubModule;
            $subModule->module_id = $request->input('module_id');
            $subModule->name = $request->input('name');
            $subModule->slug = $request->input('slug');
            $subModule->save();

            $permission_name = $request->input('slug');
            Permission::create(['name' => $permission_name]);

            if ($subModule) {
                return redirect()->route('submodule')->with('message', 'Submodule created Successfully');
            }else{
                return redirect()->route('submodule')->with('error', 'Error! Something went wrong.');
            }
        }

    }

    public function editModule($id)
    {
        if(!(User::isAuthorized('submodule_update_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

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
        ],[
            'module_id.required' => 'Module name is required',
            'name.required' => 'Name is required.',
            'slug.required' => 'Slug is required.',
        ]);
 

        $submodule = SubModule::find(getDecrypted($id));

        if ($submodule) {
            $submodule->module_id = $request->input('module_id');
            $submodule->name = $request->input('name');

            if ($submodule->slug != $request->input('slug')) {
                $permission_name = $request->input('slug');
                Permission::where('name',$permission_name)->delete();
                Permission::create(['name' => $permission_name]);
            }
            $submodule->slug = $request->input('slug');
            $submodule->save();
            return redirect()->route('submodule')->with('message', 'Submodule Updated Successfully');
        }
        else{
            return redirect()->route('submodule')->with('error', 'Error! Something went wrong.');
        }
    }

    public function deleteSubModule($id)
    {
        if(!(User::isAuthorized('submodule_delete_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $subModule = SubModule::find(getDecrypted($id));

        if (isset($subModule)) {

            $subModule->is_delete = 1;
            $subModule->save();
            $permission_name = $subModule->getModule->slug .'.'. $subModule->slug;
            Permission::where('name',$permission_name)->delete();
            if($subModule){
                $type = 'success';
                $msg = 'SubModule deleted successfully';
            }else{
                $type = 'error';
                $msg = 'Error! something went wrong!';
            }

        return response()->json(['status'=>$type,'message'=>$msg]);

        }else{

            return redirect()->back()->with('error', 'No data found');
        }
    }


}
