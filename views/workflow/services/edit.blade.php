@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="table-size">
            <div class="card card-size" id="move-left">
                <div class="card-header">
                    <h4>Edit Service
                        <a href="{{url('services')}}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('services/'.$services->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Service Name</label>
                            <input type="text" name="name" value="{{$services->name}}" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                           <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
