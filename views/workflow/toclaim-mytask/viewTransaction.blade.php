@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Workflow Image --}}
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card mt-3 card-size" id="move-left">
                @if (session('status'))
                    <div class="alert alert-success" id="alert">{{session('status')}}</div>
                @endif
                <div class="card-header">
                    <h4>Workflow Image</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($workflow as $flow)
                            <div class="col-md-2">
                                <div class="flex">
                                    <div class="wrkFlw">
                                        @if($current_step == $flow->workflowStep->name)
                                        <div class="currentBtn">
                                            <button class="button1">{{ $flow->workflowStep->name }}</button>
                                        </div>
                                        @else
                                        <div class="wrkFlwBtn">
                                            <button class="button1">{{ $flow->workflowStep->name }}</button>
                                        </div>
                                        @endif
                                    </div>
                                    @if (!$loop->last)
                                        <div class="move-right">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    @endif
                                </div>
                                @if ($flow->is_rejectable === 'yes')
                                    <br>
                                    <div class="">
                                        <div class="move-down">
                                            <i class="fa-solid fa-arrow-down"></i>
                                        </div>
                                        <br>
                                        <div class="wrkFlw">
                                            @if($current_step == $flow->rejectWorkflowStep->name)
                                                <div class="currentBtn">
                                                    <button class="button1">{{ $flow->rejectWorkflowStep->name }}</button>
                                                </div>
                                            @else
                                                <div class="wrkFlwBtn">
                                                    <button class="button1">{{ $flow->rejectWorkflowStep->name }}</button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Worksflow History --}}
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card mt-3 card-size" id="move-left1">
                <div class="card-header">
                    <h4>Workflow History</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Transaction ID</th>
                                <th>Service</th>
                                <th>User</th>
                                <th>Claimed Time</th>
                                <th>Approved Time</th>
                            </tr>
                        </thead>
                        @foreach ($workflowlog as $workflowlogs)
                            <tbody>
                                <td>{{$workflowlogs->id}}</td>
                                <td>{{$workflowlogs->transaction_id}}</td>
                                <td>{{ $workflowlogs->service ? $workflowlogs->service->name : 'Service Not Found' }}</td>
                                <td>{{ $workflowlogs->user ? $workflowlogs->user->name : '' }}</td>
                                <td>{{$workflowlogs->claimed_time}}</td>
                                <td>{{$workflowlogs->approved_time}}</td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Property Details --}}
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card mt-3 card-size" id="move-left2">
                <div class="card-header">
                    <h4>Property Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{$property->id}}</td>
                        </tr>
                        <tr>
                            <th>Parcel ID</th>
                            <td>{{$property->parcel_id}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    {{-- Approve Reject --}}
    <div class="row">
        <div class="col-md-6 mb-3 flex move-left-btn">
            <form action="{{url('approve/'.$workflowLogs)}}" method="POST" style=" margin-left:10px;">
                @csrf
                <button type="submit" class="btn btn-sm btn-success">Approve</button>
            </form>
            @if ($isReject == "yes" )
            <form action="{{url('reject/'.$workflowLogs)}}" method="POST" style=" margin-left:10px;">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
