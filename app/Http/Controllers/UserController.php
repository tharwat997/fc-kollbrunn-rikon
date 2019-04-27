<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userCreate(){
        return view('admin.user.user_create');
    }

    public function userStore(Request $request){

        $user = User::create([
           'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($request->role === "admin"){
            $user->attachRole('admin');
        } else if($request->role === "reporter"){
            $user->attachRole('reporter');
        }

        return redirect()->back();
    }

    public function userManage(){
        $users = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->get();
        $roles = DB::table('roles')->get();
        return view('admin.user.user_manage', compact('users', 'roles', 'roles_users'));
    }

    public function userUpdate(Request $request){

        if ($request->btnUpdate === "btnUpdate"){

            $user = User::find($request->userId);

            if ($user->password == $request->password){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = $request->password;

                if ($request->role == 1){
                DB::table('role_user')->where('user_id', '=', $user->id)
                        ->update(array('role_id' => 1));

                } else if($request->role == 2){
                    DB::table('role_user')->where('user_id', '=', $user->id)
                        ->update(array('role_id' => 2));
                }

            } else {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                if ($request->role == 1){
                    DB::table('role_user')->where('user_id', '=', $user->id)
                        ->update(array('role_id' => 1));
                } else if($request->role == 2){
                    DB::table('role_user')->where('user_id', '=', $user->id)
                        ->update(array('role_id' => 2));
                }

            }

            $user->update();
            return redirect()->back();

        } else if($request->btnDelete === "btnDelete"){
            $user = User::find($request->userId);
            $user->delete();

            return redirect()->back();
        }

    }
}
