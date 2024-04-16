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
                    <h4>Services
                        @can('create service')
                            <a href="{{url('services/create')}}" class="btn btn-primary float-end">Add Service</a>
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
                        @foreach ($services as $service )
                        <tbody>
                            <td>{{$service->id}}</td>
                            <td>{{$service->name}}</td>
                            <td>
                            @can('view service')
                                <a href="{{url('services/'.$service->id)}}" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-eye"></i></a>
                            @endcan
                            @can('edit service')
                                <a href="{{url('services/'.$service->id.'/edit')}}" class="btn btn-sm btn-outline-success"><i class="fa-regular fa-pen-to-square"></i></a>
                            @endcan
                            @can('delete service')
                                <a href="{{url('services/'.$service->id.'/delete')}}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
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
