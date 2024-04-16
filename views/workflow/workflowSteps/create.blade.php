@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card card-size" id="move-left">
                <div class="card-header">
                    <h4>Create Workflow Step
                        <a href="{{url('workflowSteps')}}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('workflowSteps')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Workflow Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <select name="role_id[]" class="form-select mt-4" aria-label="Default select example">
                            <option value="">Select Role</option>
                            @if($roles->count()>0)
                            @foreach ($roles as $role )
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        @endif
                        </select>
                        <div class="mb-3 mt-3">
                           <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
