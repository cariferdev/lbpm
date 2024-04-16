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
                    <h4>Workflow
                        @can('create workflow')
                            <a href="{{url('workflow/create')}}" class="btn btn-primary float-end">Create Workflow</a>
                        @endcan
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Service</th>
                                <th>Workflow Step</th>
                                {{-- <th>Role</th> --}}
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        @foreach ($workflow as $workflowStep )
                        <tbody>
                            <td>{{$workflowStep->id}}</td>
                            <td>{{$workflowStep->service->name}}</td>
                            <td>{{$workflowStep->workflowStep->name}}</td>
                            {{-- <td>{{$workflowStep->role->name}}</td> --}}
                            {{-- <td>
                            @can('edit workflow')
                                <a href="{{url('workflow/'.$workflowStep->id.'/edit')}}" class="btn btn-sm btn-outline-success"><i class="fa-regular fa-pen-to-square"></i></a>
                            @endcan
                            @can('delete workflow')
                                <a href="{{url('workflow/'.$workflowStep->id.'/delete')}}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                            @endcan
                            </td> --}}
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
