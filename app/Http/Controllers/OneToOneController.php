<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class OneToOneController extends Controller
{
    public function index(){
        return view('OneToOneRelation.create_user');
    }
    public function userCreated(Request $request){
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        $user->UserRole()->create([
            'user_role'=>$request->userRole,
            'status'=>"Active"
        ]);
        $user->save();


        return redirect()->back()->with('done','message');
    }
    public function showAllUser(){
        $users=User::all();
        // dd($users);
        return view('OneToOneRelation.show_user')->with('users',$users);
    }
    public function EditUser($id){
        $editUser=User::find($id);
        return view('OneToOneRelation.edit_user')->with('editUser',$editUser);
    }
    public function UpdateUser($id,Request $request)
    {
        $user=User::find($id);
        // dd($user->userRole->user_role);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();
        $user->UserRole->user_role=$request->userRole;
        // dd($user->UserRole->user_role);
        $user->UserRole->save();
        return redirect('showUser')->with('done','message');
    }
    public function DeleteUser($id){
        $deleteUser=User::find($id);
        $deleteUser->UserRole()->where('uid',$id)->delete();
        $deleteUser=User::find($id)->delete();
        return redirect()->back();
    }
}
