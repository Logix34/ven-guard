<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\ActivityLog;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class BaseController extends Controller
{
    public function getUsers(){
        return view('layouts.Users.index');
    }
    public function usersList(){
        $users = User::whereUserType(2)->get();
        return DataTables::of($users)
            ->editColumn('created_at',function ($row){
            return   Carbon::create($row->created_at)->format('Y-m-d');
            })
            ->addColumn('action',function ($users){
                $button='';
                $button.=' <a class="btn  btn-sm" href="'. url("user/edit".$users->id) .'"><i class="fas fa-edit"></i></a>';
                $button.='<a class="btn  delete btn-sm" onclick="delete_btn('.$users->id .')"><i class="fas fa-trash-alt"></i></a>';
                if($users->status == "Active"){
                    $button.='<a class="btn   btn-sm"><i class="fas fa-check"></i></a>';
                }elseif($users->status == "Baned"){
                    $button.='<a class="btn  btn-sm"><i class="fas fa-times"></i></a>';
                }else{

                }

                return $button;
            })->addColumn('status',function ($users){
                return $users->status==='status'?"Baned":"Active";
            })->rawColumns(['action'])->make(true);
    }
///////////////////////////.........Users Details Section.........//////////////
   public function getUserDetail($id){
       $detail=User::whereId($id)->first();
         $activity_log_latest=ActivityLog::whereUserId($id)->latest()->take(5)->get();
        return view('layouts.Users.user_detail',['detail'=>$detail,'activity_log_latest'=>$activity_log_latest]);
   }
///////////////////////////.........add......Users................//////////////
            public function addUser(Request $request)
            {
                    $users_data = [
                        'user_name' => $request ['user_name'],
                        'email' => $request['email'],
                        'status' => $request['status'],
                        'gender' => $request ['gender'],
                        'dob' => $request['dob'],
                        'address' => $request ['address'],
                        'phone_number' => $request['phone_number'],
                        'password' => Hash::make($request['password']),
                        'user_type' => '2'
                    ];
                    if($request['id'] == ""){
                        $user = User::create($users_data);
                    }else{
                        $user= User::whereId($request['id'])->first();
                         $user->update($users_data);
                    }
                    $user->roles()->sync([$request->role_id]);


                if ($request->file('profile_picture')) {
                        $file = $request->file('profile_picture');
                        $extention = $file->getClientOriginalExtension();
                        $filename = time(). '.' .$extention;
                        $file->move('uploads/profile/'.$user->id,$filename);
                    User::whereId($user->id)->update(['profile_picture'=>'uploads/profile/'.$user->id.'/'.$filename ]);
                        Session::flash('success_user','User Edit  Successfully');
                        return redirect('users');
                    }
                Session::flash('failed_user','User Add/Edit  failed ');
                return redirect('add/new_user');
           }
    Public function getAdd(){
        $roles = Role::whereDeletedAt(0)->get();
        return view('layouts.Users.add',compact('roles',));
    }

    public function editUser($id){
        $roles = Role::whereDeletedAt(0)->get();
        $detail=User::with("roles")->whereId($id)->first();
        return view("layouts/Users/add",['header'=>"Edit User",'detail'=>$detail, 'roles'=>$roles,]);
    }
    public function deleteUser($id){
        User::whereId($id)->delete();
        Session::flash("success","record deleted successfully");
        return redirect('users');
    }


    ///////////////////////////////.........Role Section Admin......../////////////////////
    Public function getRoles(){
        $roles = Role::whereDeletedAt(0)->get();
        return view('layouts.Admin.Roles.index',compact('roles',));
    }
    ///////////////////////////////.........Add Role Section Admin......../////////////////////
     public function createRoles(){
        return view('layouts.Admin.Roles.add');
     }
    public function rolesList(){
        $roles = Role::whereDeletedAt(0)->get();
        return DataTables::of($roles)
            ->addColumn('count',function ($row){
                return  $users =Role::find($row->id)->users->count();
            })
            ->addColumn('action',function ($roles){
                $button='';
                $button.=' <a class="btn  btn-sm" href="'. url("role/edit".$roles->id) .'"><i class="fas fa-edit"></i></a>';
                $button.=' <button class="btn  delete btn-sm" onclick="delete_btn('.$roles->id .')"><i class="fas fa-trash-alt"></i></a>';
                return $button;
            })->addColumn('status',function ($roles){
                return $roles->status==='status'?"Disabled":"Enabled";
            })->rawColumns(['action'])->make(true);
    }
    public function postRolesForm(Request $request)
    {
        $request->validate([
            'role_title' => 'string|required',
            'display_name'=> 'string|required',
            'description'=> 'string|required',

        ]);
            $roles_data = [
                'role_title' => $request ['role_title'],
                'display_name'=>  $request['display_name'],
                'description' => $request ['description'],
                'deleted_at' => 0,

            ];
            if ($request['id'] == "") {
                $roles_data = Role::create($roles_data);
                $roles_data->id;
                Session::flash('Role_add','role Add  Successfully');
                return redirect('/roles');
            } else {
                Role::whereId($request['id'])->update($roles_data);
                Session::flash('Role_edit','Role Edit  successfully');
                return redirect('/roles');
            }
        Session::flash('Role_failed','Role add/edit  Failed ');
        return redirect('/add_roles');
    }
    public function deleteRole($id){
          $userCount=Role::find($id)->users->count();
        if($userCount > 0){
            return response()->json([
                "status" => false,
                 "count" =>$userCount,
                 "url" => redirect('roles'),
            ]);
        }else{
            Role::whereId($id)->delete();
            return response()->json([
                "status" => true,
                "url" => redirect('roles'),
            ]);
        }
    }
    public function editRoles ($id){
        $detail=Role::with("users")->whereId($id)->first();
        return view('layouts.Admin.Roles.add',['header'=>"Edit Roles","detail"=>$detail,]);
    }

}
