<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\SubModule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->limit = 10;
        $this->middleware(function ($request, $next) {
			if(Auth::check()) {	
                if(!(User::isAuthorized('role_slug')))
                {
                    return redirect()->route('dashboard')->with('error','Unauthorized access');
                }
			}
			return $next($request);
		});
    }

    public function index()
    {
        if(!(User::isAuthorized('role_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $roles = Role::get();
        return view('role.index', compact('roles'));
    }

    public function roleAction($id)
    {
        if(!(User::isAuthorized('role_action_slug')))
        {
            return redirect()->route('dashboard')->with('error','Unauthorized access');
        }

        $role = Role::find($id);
        $modules = Module::where('is_delete', '!=', 1)->with('getSubModule')->get();
        return view('role.role_action',compact('modules','role'));
    }

    public function setPermission(Request $request, $id)
    {
        $permission_name = $request->slug;
        $role = Role::find($id);
        if($request->status == 1){
            $role->givePermissionTo($permission_name);
        }else
        {
            $role->revokePermissionTo($permission_name);
        }
        return response()->json(['status'=>200,'message' => "Permission changed"]);

    }
}
