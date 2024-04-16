@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card mt-3 card-size" id="move-left">
                @if (session('status'))
                    <div class="alert alert-success" id="alert">{{session('status')}}</div>
                @endif
                <div class="card-header">
                    <h4>User List
                        {{-- @can('switch role to user') --}}
                            <a href="{{url('assign/create')}}" class="btn btn-primary float-end">Assign Role to User</a>
                        {{-- @endcan --}}
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user )
                        <tbody>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>@if (count($user->roles->pluck('name')->toArray())>0)
                                    {{implode(",",$user->roles->pluck('name')->toArray())}}
                                @else
                                    No Role Assigned
                                @endif
                            </td>
                            <td>
                                @can('edit user')
                                    <a href="{{url('assign/'.$user->id.'/edit')}}" class="btn btn-sm btn-outline-success"><i class="fa-regular fa-pen-to-square"></i></a>
                                @endcan
                                @can('delete user')
                                    <a href="{{url('assign/'.$user->id.'/delete')}}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                @endcan
                            </td>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
