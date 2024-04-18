<?php

namespace App\Http\Controllers\Lbpm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AssignRoleToUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $users = User::with('roles')->get();
        //$roles = Role::with('Permissions')->get();
        $users = User::get();
        return view('workflow.assignRolesToUsers.index',compact('users'));
    }

    public function create()
    {
        $users = User::get();
        $roles = Role::get();
        return view('workflow.assignRolesToUsers.create',compact('users','roles'));
    }

    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        // $role = Role::find($request->role_id);
        $user->syncRoles($request->role_id);
        return redirect('assign')->with('status','Role Assigned Successfully');
    }

    public function edit($id)
    {
        // $selectedUser = User::with('roles')->find($id);
        $selectedUser = User::find($id);
        $users = User::get();
        $roles = Role::get();
        return view('workflow.assignRolesToUsers.edit',compact('selectedUser','users','roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->syncRoles($request->role_id);
        return redirect('assign')->with('status','Role Updated Successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('assign')->with('status','User Deleted Successfully');
    }
}
