@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card card-size" id="move-left">
                <div class="card-header">
                    <h4>Assign Roles to Users
                        <a href="{{url('assign')}}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('assign')}}/{{$selectedUser->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <select disabled name="user_id" class="form-select mt-3" aria-label="Default select example">
                            <option value="">Select User</option>
                            @if($users->count()>0)
                                @foreach ($users as $user )
                                    <option
                                    @if ($user->id == $selectedUser->id )
                                        selected
                                    @endif
                                    value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <select name="role_id[]" class="form-select mt-4" aria-label="Default select example">
                            <option value="">Select Role</option>
                            @if($roles->count()>0)
                            @foreach ($roles as $role )
                                <option
                                @if (in_array($role->id,$selectedUser->roles->pluck('id')->toArray()))
                                    selected
                                @endif
                                value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        @endif
                        </select>
                        <div class="mb-3 mt-3">
                           <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
