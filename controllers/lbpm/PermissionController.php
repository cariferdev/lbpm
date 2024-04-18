<?php

namespace App\Http\Controllers\Lbpm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = Permission::get();
        return view('workflow.permissions.index',compact('permissions'));
    }

    public function create()
    {
        return view('workflow.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name'
        ]);
        Permission::create([
            'name' => $request->name
        ]);
        return redirect('permissions')->with('status','Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        return view('workflow.permissions.edit',compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,'.$permission->id
        ]);
        $permission->update([
            'name' => $request->name
        ]);
        return redirect('permissions')->with('status','Permission Updated Successfully');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect('permissions')->with('status','Permission Deleted Successfully');
    }
}
