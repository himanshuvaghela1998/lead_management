<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('getRole')->where('role_id','!=', 1)->where('is_delete','0')->get();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status','1')->where('id','!=','1')->get()->pluck('name','id')->toArray();
        return view('user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->status = 1;
        $user->is_delete = 0;
        $user->save();

        if($user){
            $type = 'success';
            $msg = 'User created successfully';
            // \Session::flash('errorSuccess', 'User created successfully');
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
            // \Session::flash('errorFails', 'Error! something went to wrong!');
        }
        return redirect()->route('users.index')->with($type,$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function isEmailExists(Request $request){
        $isValid = true;
        $message = '';

        $isExist = User::where('email','=',$request->email)->first();

        if($isExist){
            $isValid = false;
            $message = 'Email id already exists';
        }

        return response()->json([
            'valid' => $isValid,
            'message' => $message
        ]);
    }    

    public function status_update(Request $request,$id){
        /* Record status update*/
        $status = User::select('id','status')->find(getDecrypted($id));
        $status->status = $request->status;
        $status->save();
        if($status){
            $type = 'success';
            $msg = 'User created successfully';
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
        }
        return response()->json(['status'=>$type,'message'=>$msg]);
    }
}
