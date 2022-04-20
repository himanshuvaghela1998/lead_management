<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = 10;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('getRole')->where('role_id','!=', 1)->where('is_delete','0');

        if($request->has('search_keyword') && $request->search_keyword != ""){
            $users = $users->where(function($q) use($request){
                $q->where('name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('email', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhereHas('getRole',function($q1) use ($request){
					$q1->where('name', 'like', '%' . $request->search_keyword . '%');
                });
            });
        }
        $roles = Role::where('status','1')->where('id','!=','1')->get()->pluck('name','id')->toArray();
        /* Status filter */
        if (!is_null($request->status_id) && $request->status_id != '-1') {
            $users->where('status', $request->status_id);
        }
        $users = $users->paginate($this->limit)->appends($request->all());
        if($request->ajax()){
            $view = view('user.include.usersList',compact('users'))->render();
            return response()->json(['status'=>200,'message','content'=>$view]);
        }
        return view('user.index',compact('users','roles'));
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
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
        }
        return redirect()->route('users.index')->with($type,$msg);
    }

    public function editPassword($id)
    {
        $user = User::find(getDecrypted($id));
        if ($user) {
            $roles = Role::where('status','1')->where('id','!=','1')->get()->pluck('name','id')->toArray();
            $view = view('user.confirmPassword',compact('user','roles'))->render();
            return response()->json(['status'=>'success','content'=>$view]);
        }
        return response()->json(['status'=>'error']);
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::where('is_delete',0)->where('id',getDecrypted($id))->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $user = User::where('is_delete',0)->where('id',getDecrypted($id))->first();
                $user->password = Hash::make($request->new_password);
                $user->save();

                if ($user) {
                    return redirect()->route('users.index')->with('message', 'Password changes success fully');
                }else{
                    return redirect()->route('users.index')->with('error', 'Password not changed');
                }

            }else{
                return redirect()->route('users.index')->with('error', 'Not work');
            }


        }else{
            return redirect()->route('dashboard')->with('error', 'data not found');
        }
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
        $user = User::find(getDecrypted($id));
        if ($user) {
            $roles = Role::where('status','1')->where('id','!=','1')->get()->pluck('name','id')->toArray();
            $view = view('user.edit',compact('user','roles'))->render();
            return response()->json(['status'=>'success','content'=>$view]);
        }
        return response()->json(['status'=>'error']);
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
        $user = User::where('is_delete',0)->where('id',getDecrypted($id))->first();
        $user->name = $request->name;
        $user->role_id = $request->role;
        $user->email = $request->email;
        $user->save();

        if($user){
            $type = 'success';
            $msg = 'User updated successfully';
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
        }

        return redirect()->route('users.index')->with($type,$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('is_delete',0)->where('id',getDecrypted($id))->first();
        $user->is_delete = 1;
        $user->save();
        if($user){
            $type = 'success';
            $msg = 'User deleted successfully';
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
        }

        return response()->json(['status'=>$type,'message'=>$msg]);
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
            $msg = 'Status updated successfully';
        }else{
            $type = 'error';
            $msg = 'Error! something went to wrong!';
        }
        return response()->json(['status'=>$type,'message'=>$msg]);
    }
}
