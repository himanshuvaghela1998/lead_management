<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\SubModule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('role.index', compact('roles'));
    }

    public function roleAction($id)
    {
        $modules = Module::where('is_delete', '!=', 1)->with('getSubModule')->get();
        return view('role.role_action',compact('modules'));
    }
}
