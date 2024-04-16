@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card card-size" id="move-left">
                <div class="card-header">
                    <h4>Create Roles
                        <a href="{{url('roles')}}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('roles')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Role Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                           <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
