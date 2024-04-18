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
                    <h4>My Task</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Transaction ID</th>
                                <th>Property ID</th>
                                <th>Seller</th>
                                <th>Buyer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($workflowLog as $workflowLogs)
                            @if($workflowLogs->user_id != null && $workflowLogs->role_id == Auth::id() && $workflowLogs->approved_time == null && $workflowLogs->rejected_time == null )
                                <tbody>
                                    <td>{{$workflowLogs->id}}</td>
                                    <td>{{$workflowLogs->transaction_id}}</td>
                                    <td>@if($workflowLogs->transaction->property_id > 0)
                                            {{$workflowLogs->transaction->property_id}}
                                        @endif
                                    </td>
                                    <td>@if($workflowLogs->transaction->seller_id > 0)
                                            {{$workflowLogs->transaction->seller->first_name}}
                                        @endif
                                    </td>
                                    <td>@if($workflowLogs->transaction->buyer_id > 0)
                                            {{$workflowLogs->transaction->buyer->first_name}}
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display: flex;">
                                            <div style="margin-right: 10px">
                                                <form action="{{url('release/'.$workflowLogs->id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Release</button>
                                                </form>
                                            </div>
                                            <div>
                                               <button class="btn btn-sm btn-success"><a style="color:#fff" href="{{url('viewTransaction',[$workflowLogs->transaction_id, $workflowLogs->id, $workflowLogs->workflow_id ])}}"><i class="fa-solid fa-eye"></i></a></button>
                                            </div>
                                        </div>
                                    </td>
                                </tbody>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card mt-3 card-size" id="move-left1">
                <div class="card-header">
                    <h4>To Claim</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Transaction ID</th>
                                <th>Property ID</th>
                                <th>Seller</th>
                                <th>Buyer</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        @foreach ($workflowLog as $workflowLogs)
                            @if($workflowLogs->user_id == null && $workflowLogs->role_id == Auth::id() && $workflowLogs->claimed_time == null)
                                <tbody>
                                    <td>{{$workflowLogs->id}}</td>
                                    <td>{{$workflowLogs->transaction_id}}</td>
                                    <td>@if($workflowLogs->transaction->property_id > 0)
                                            {{$workflowLogs->transaction->property_id}}
                                        @endif
                                    </td>
                                    <td>@if($workflowLogs->transaction->seller_id > 0)
                                            {{$workflowLogs->transaction->seller->first_name}}
                                        @endif
                                    </td>
                                    <td>@if($workflowLogs->transaction->buyer_id > 0)
                                            {{$workflowLogs->transaction->buyer->first_name}}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{url('claim/'.$workflowLogs->id)}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">Claim</button>
                                        </form>
                                    </td>
                                </tbody>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
