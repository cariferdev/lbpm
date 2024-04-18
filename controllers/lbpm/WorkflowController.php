<?php

namespace App\Http\Controllers\Lbpm;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Workflow;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class WorkflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $workflow = Workflow::get();
        return view('workflow.workflow.index', compact('workflow'));
    }

    public function create()
    {
        $workflow      = Workflow::get();
        $workflowSteps = WorkflowStep::get();
        $roles         = Role::get();
        $services      = Service::get();
        return view('workflow.workflow.create', compact('workflowSteps', 'roles', 'services', 'workflow'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'role_id.*'          => 'required',
            'service_id.*'       => 'required',
            'workflow_step_id.*' => 'required',
            'sort_id'            => 'required|numeric',
            'is_rejectable'      => 'required|in:yes,no',
        ]);

        $serviceIds      = $request->input('service_id');
        $workflowStepIds = $request->input('workflow_step_id');
        $sortId          = $request->input('sort_id');
        $isRejectable    = $request->input('is_rejectable');

        foreach ($serviceIds as $key => $serviceId) {

            $existingWorkflow = Workflow::where('service_id', $serviceId)
                ->where('workflow_step_id', $workflowStepIds[$key])
                ->first();

            if ($existingWorkflow) {
                return redirect()->back()->with('status', 'Workflow Already Created')->with('status-type', 'danger');
            }

            // Check if a workflow with the same service_id and sort_id exists
            $existingWorkflowSort = Workflow::where('service_id', $serviceId)
                ->where('sort_id', $sortId)
                ->first();

            // If an existing workflow with the same service_id and sort_id exists, skip creating a new one
            if ($existingWorkflowSort) {
                return redirect()->back()->with('status', 'Workflow Already Created')->with('status-type', 'danger');
            }


            // Create a new Workflow entry
            Workflow::create([
                'service_id'               => $serviceId,
                'workflow_step_id'         => $workflowStepIds[$key],
                'sort_id'                  => $sortId,
                'is_rejectable'            => $isRejectable,
                'reject_workflow_step_id'  => $request->input('role_id.' . $key) ?: null
            ]);

        }

        return redirect('workflow')->with('status', 'Workflow Created Successfully');
    }

    public function edit($id)
    {
        $workflow = Workflow::find($id);
        return view('workflow.workflow.edit', compact('workflow'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:workflows,name,' . $id
        ]);
        $workflow = Workflow::find($id);
        $workflow->update([
            'name' => $request->name
        ]);
        return redirect('workflow')->with('status', 'Workflow Updated Successfully');
    }

    public function destroy($id)
    {
        $workflow = Workflow::find($id);
        $workflow->delete();
        return redirect('workflow')->with('status', 'Workflow Deleted Successfully');
    }
}
