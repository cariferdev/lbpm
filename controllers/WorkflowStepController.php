<?php

namespace App\Http\Controllers;

use App\Models\WorkflowStep;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class WorkflowStepController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $workflowSteps = WorkflowStep::get();
        return view('roles-permissions.workflowSteps.index', compact('workflowSteps'));
    }

    public function create()
    {
        $roles         = Role::get();
        return view('roles-permissions.workflowSteps.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'               => 'required|string|unique:workflow_steps,name',
            'role_id.*'          => 'required',
        ]);

        $roleIds = $request->input('role_id');

        foreach ($roleIds as $key => $roleId) {
            WorkflowStep::create([
                'name'     => $request->name,
                'role_id'  => $roleId
            ]);
        }
        return redirect('workflowSteps')->with('status', 'Workflow Step Created Successfully');
    }

    public function edit($id)
    {
        $workflowSteps = WorkflowStep::find($id);
        $roles         = Role::get();
        return view('roles-permissions.workflowSteps.edit', compact('workflowSteps', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $workflowStep = WorkflowStep::find($id);
        $workflowStep->update(['role_id' => $request->role_id]);
        return redirect('workflowSteps')->with('status', 'Workflow Step Updated Successfully');
    }

    public function destroy($id)
    {
        $workflowSteps = WorkflowStep::find($id);
        $workflowSteps->delete();
        return redirect('workflowSteps')->with('status', 'Workflow Step Deleted Successfully');
    }
}
