<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{

    public function index()
    {
        $roles= Role::with('permissions')->get();
      $permissions= Permission::with('roles')->get();
     return view('layouts.Admin.Permission.index',compact('roles','permissions',));
    }


    public function create()
    {
        return view('layouts.Admin.Permission.add');
    }

    public function createpermission(Request $request){

        $permission_data = [
            'permission_name' => $request ['permission_name'],
            'display_name' => $request['display_name'],
            'description' => $request['description'],
        ];
        if ($request['id'] == "") {
            $permission_data = Permission::create($permission_data);
            $permission_data->id;
            Session::flash("success_permission_create","Permission create Successfully");
            return redirect('permissions');
        } else {
            Permission::whereId($request['id'])->update($permission_data);
            Session::flash("success_permission_edit","Permission Edit Successfully");
            return redirect('permissions');
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $input = $request->roles;
        $roles=Role::get();
                foreach ($roles as $role){
                    if(!isset($input[$role->id])){
                        $input[$role->id]=[];
                    }
                    //$role->role_title;
        }
      foreach($input as $role=>$permission){
             $res=Role::whereId($role)->first();
            $res->permissions()->sync($permission);
      }
        Session::flash('success_msg','permissions Assign to the Roles Successfully');
        return redirect('permissions');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePermission($id){
        Permission::whereId($id)->delete();
        Session::flash("success_delete","record deleted successfully");
        return redirect('permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPermissions($id)
    {
        $detail=Permission::whereId($id)->first();
        return view("layouts/Admin/Permission/add",['header'=>"Edit Permissions",'detail'=>$detail,]);
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
}
