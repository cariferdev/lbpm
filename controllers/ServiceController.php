<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Workflow;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $services = Service::get();
        return view('roles-permissions.services.index', compact('services'));
    }

    public function show($id)
    {
        $rejectIds = Workflow::select('reject_workflow_step_id')->whereNotNull('reject_workflow_step_id')->get()->toArray();
        $workflow = Workflow::where('service_id', $id)->whereHas('workflowStep',function($query) use($rejectIds){
            $query->whereNotIn('id',$rejectIds);
        })->orderBy('sort_id')->get();
        return view('roles-permissions.services.workflow', compact('workflow'));
    }

    public function create()
    {
        return view('roles-permissions.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:services,name'
        ]);
        Service::create([
            'name' => $request->name
        ]);
        return redirect('services')->with('status', 'Service Created Successfully');
    }

    public function edit($id)
    {
        $services = Service::find($id);
        return view('roles-permissions.services.edit', compact('services'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:services,name,' . $id
        ]);
        $services = Service::find($id);
        $services->update([
            'name' => $request->name
        ]);
        return redirect('services')->with('status', 'Service Updated Successfully');
    }

    public function destroy($id)
    {
        $services = Service::find($id);
        $services->delete();
        return redirect('services')->with('status', 'Service Deleted Successfully');
    }
}
