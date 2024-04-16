@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card card-size" id="move-left">
                @if (session('status'))
                    <div class="alert alert-{{ session('status-type', 'danger') }}" id="alert">{{session('status')}}</div>
                @endif
                <div class="card-header">
                    <h4>Create Workflow
                        <a href="{{url('workflow')}}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('workflow')}}" method="POST">
                        @csrf
                        <select name="service_id[]" class="form-select mt-4" aria-label="Default select example">
                            <option value="">Select Service</option>
                            @if($services->count()>0)
                                @foreach ($services as $service )
                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <select name="workflow_step_id[]" class="form-select mt-4" aria-label="Default select example">
                            <option value="">Select Workflow Role</option>
                            @if($workflowSteps->count()>0)
                                @foreach ($workflowSteps as $workflowStep )
                                    <option value="{{$workflowStep->id}}">{{$workflowStep->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="mb-3 mt-4">
                            <input type="number" name="sort_id" id="step" class="form-control" placeholder="Enter Workflow Step">
                        </div>
                        <div class="mb-3 mt-4">
                            <select name="is_rejectable" id="is_rejectable" class="form-select">
                                <option value="">Is Rejectable</option>
                                <option value="yes" {{ $workflowStep->is_rejectable == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $workflowStep->is_rejectable == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="reject" id="selectRoleContainer">
                            <select name="role_id[]" class="form-select mt-4" aria-label="Default select example">
                                <option value="">Select Role</option>
                                @if($roles->count()>0)
                                    @foreach ($roles as $role )
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                           <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('is_rejectable').addEventListener('change', function() {
    var selectRoleContainer = document.getElementById('selectRoleContainer');
    if (this.value === 'yes') {
        selectRoleContainer.style.display = 'block';
    } else {
        selectRoleContainer.style.display = 'none';
    }
});
</script>
@endsection

