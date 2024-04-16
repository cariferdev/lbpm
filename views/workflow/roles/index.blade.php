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
                    <h4>Roles
                        @can('create role')
                            <a href="{{url('roles/create')}}" class="btn btn-primary float-end">Add Role</a>
                        @endcan
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($roles as $role )
                        <tbody>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                            @can('view role')
                                <a href="{{url('roles/'.$role->id.'/give-permissions')}}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-user-plus"></i>
                                </a>
                            @endcan
                            @can('edit role')
                                <a href="{{url('roles/'.$role->id.'/edit')}}" class="btn btn-sm btn-outline-success"><i class="fa-regular fa-pen-to-square"></i></a>
                            @endcan
                            @can('delete role')
                                <a href="{{url('roles/'.$role->id.'/delete')}}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
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
