@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Show Room</h3>
                </div><!-- /.card-header -->
                <div class="card-body">


                    <!-- Name -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name:</label>
                        <div class="col-md-8">
                            <label class="col-form-label font-weight-normal text-black-75">{{$room->name}}</label>
                        </div>
                    </div>

                    <!-- Created At -->
                    <div class="form-group row">
                        <label for="created_at" class="col-md-4 col-form-label text-md-right">Created At:</label>
                        <div class="col-md-8">
                            <label class="col-form-label font-weight-normal text-black-75">
                                {{Carbon\Carbon::parse($room->created_at)->format('d M, Y')}}</label>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <a href="{{route('therapy-rooms.index')}}" class="btn btn-warning">Cancel</a>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection
