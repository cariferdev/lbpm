<?php

namespace App\Http\Controllers\Lbpm;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Workflow;
use App\Models\WorkflowLog;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToClaimMyTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function claim_task()
    {
        $workflowLog = WorkflowLog::get();
        return view('workflow.toclaim-mytask.index',compact('workflowLog'));
    }

    public function claim($id)
    {
        $workflowLog               = WorkflowLog::find($id);
        $workflowLog->user_id      = Auth::id();
        $workflowLog->claimed_time = date('Y-m-d H:i:s');
        $workflowLog->save();
        return redirect()->back();
    }

    public function release($id)
    {
        $workflowLog               = WorkflowLog::find($id);
        $workflowLog->user_id      = null;
        $workflowLog->claimed_time = null;
        $workflowLog->save();
        return redirect()->back();
    }

    public function approve($id)
    {
        $workflowLog      = WorkflowLog::where('id',$id)->first();
        $transaction_id   = $workflowLog->transaction_id;
        $service_id       = $workflowLog->service_id;

        $wlog             = WorkflowLog::select('workflow_id')->where('transaction_id',$transaction_id)->get()->toArray();
        $arr              = array_column($wlog,'workflow_id');

        $getWorkflow_id   = Workflow::where('service_id',$service_id)->whereNotIn('id',$arr)->first();

        if($getWorkflow_id === null)
        {
            $transaction                  = Transaction::where('id',$transaction_id)->first();
            $transaction->workflow_status = 'Finalized';
            $transaction->save();
            $workflowLog->approved_time   = date('Y-m-d H:i:s');
            $workflowLog->save();
            return redirect('claim-task')->with('status', 'Transaction Completed Successfully');
        }

        $workflow_id      = $getWorkflow_id->id;

        $workflow_step_id = $getWorkflow_id->workflow_step_id;
        $getRole_id       = WorkflowStep::where('id',$workflow_step_id)->first();
        $role_id          = $getRole_id->role_id;

        $workflowLog->approved_time     = date('Y-m-d H:i:s');
        $workflowLog->save();

        $workflowLogNew                 = new WorkflowLog();
        $workflowLogNew->transaction_id = $transaction_id;
        $workflowLogNew->service_id     = $service_id;
        $workflowLogNew->workflow_id    = $workflow_id;
        $workflowLogNew->role_id        = $role_id;
        $workflowLogNew->user_id        = null;
        $workflowLogNew->save();

        return redirect('claim-task')->with('status', 'Transaction Approved Successfully');
    }

    public function reject($id)
    {
        $workflowLog      = WorkflowLog::where('id',$id)->first();
        $transaction_id   = $workflowLog->transaction_id;
        $service_id       = $workflowLog->service_id;

        $workflow_id      = $workflowLog->workflow_id;
        $getWorkflow      = Workflow::where('id', $workflow_id)->first();
        $rejectID         = $getWorkflow->reject_workflow_step_id;
        $workflow_step_id = WorkflowStep::where('id',$rejectID)->first();
        $role_id          = $workflow_step_id->role_id;
        $getCrt_WrkId     = $workflow_step_id->id;
        $current_wrkFlw   = Workflow::where('workflow_step_id',$getCrt_WrkId)->first();
        $wr_id            = $current_wrkFlw->id;

        $workflowLog->rejected_time     = date('Y-m-d H:i:s');
        $workflowLog->save();

        $workflowLogNew                 = new WorkflowLog();
        $workflowLogNew->transaction_id = $transaction_id;
        $workflowLogNew->service_id     = $service_id;
        $workflowLogNew->workflow_id    = $wr_id;
        $workflowLogNew->role_id        = $role_id;
        $workflowLogNew->user_id        = null;
        $workflowLogNew->save();

        return redirect('claim-task')->with('status', 'Transaction Rejected');
    }
}
