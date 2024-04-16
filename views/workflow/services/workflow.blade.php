@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" id="table-size">
                <div class="card mt-3 card-size" id="move-left">
                    <div class="card-header">
                        <h4>View Workflow
                            <a href="{{ url('services') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($workflow as $flow)
                                <div class="col-md-2">
                                    <div class="flex">
                                        <div class="wrkFlwBtn">
                                            <button class="button1">{{ $flow->workflowStep->name }}</button>
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
                                            <div class="wrkFlwBtn">
                                                <button class="button1">{{ $flow->rejectWorkflowStep->name }}</button>
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
    </div>
@endsection
