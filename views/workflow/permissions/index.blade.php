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
                    <h4>Permissions
                        @can('add permission')
                            <a href="{{url('permissions/create')}}" class="btn btn-primary float-end">Add Permission</a>
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
                        @foreach ($permissions as $permission )
                        <tbody>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>
                                @can('edit permission')
                                    <a href="{{url('permissions/'.$permission->id.'/edit')}}" class="btn btn-sm btn-outline-success"><i class="fa-regular fa-pen-to-square"></i></a>
                                @endcan
                                @can('delete permission')
                                    <a href="{{url('permissions/'.$permission->id.'/delete')}}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
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
