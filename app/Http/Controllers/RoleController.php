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
    public function index()
    {
        $roles = Role::get();
        return view('role.index', compact('roles'));
    }

    public function roleAction($id)
    {
        $role = Role::find($id);
        $modules = Module::where('is_delete', '!=', 1)->with('getSubModule')->get();
        return view('role.role_action',compact('modules','role'));
    }

    public function setPermission(Request $request, $id)
    {
        $permission_name = $request->module_slug;
        if(isset($request->submodule_slug))
        {
            $permission_name = $permission_name.'.'.$request->submodule_slug;
        }

        $role = Role::find($id);
        $user = User::find(Auth::user()->id);
        if($request->status == 1){
            $role->givePermissionTo($permission_name);
            $user->assignRole($user->getRole->name);
        }else
        {
            $role->revokePermissionTo($permission_name);
        }
        return response()->json(['status'=>200,'message' => "Permission changed"]);

    }
}
