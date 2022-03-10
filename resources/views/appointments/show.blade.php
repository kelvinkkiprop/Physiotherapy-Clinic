@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Show Appointment</h3>
                </div><!-- /.card-header -->
                <div class="card-body">


                    <!-- Therapist -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Therapist:</label>
                        <div class="col-md-8">
                            <label class="col-form-label font-weight-normal text-black-75">@if($appointment->appointmentTherapist)
                                {{$appointment->appointmentTherapist->name}}@endif</label>
                        </div>
                    </div>

                    <!-- Room -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Room:</label>
                        <div class="col-md-8">
                            <label class="col-form-label font-weight-normal text-black-75">@if($appointment->appointmentRoom)
                                {{$appointment->appointmentRoom->name}}@endif</label>
                        </div>
                    </div>

                    <!-- DateTime -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">DateTime:</label>
                        <div class="col-md-8">
                            <label class="col-form-label font-weight-normal text-black-75">{{Carbon\Carbon::parse($appointment->date . $appointment->time)->format('d/m/y, H:iA')}}</label>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Status:</label>
                        <div class="col-md-8">
                            <label class="col-form-label font-weight-normal text-black-75">@if($appointment->appointmentStatus)
                                {{$appointment->appointmentStatus->name}}@endif</label>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Description:</label>
                        <div class="col-md-8">
                            <label class="col-form-label font-weight-normal text-black-75">{{$appointment->description}}</label>
                        </div>
                    </div>

                    <!-- Created At -->
                    <div class="form-group row">
                        <label for="created_at" class="col-md-4 col-form-label text-md-right">Created At:</label>
                        <div class="col-md-8">
                            <label class="col-form-label font-weight-normal text-black-75">
                                {{Carbon\Carbon::parse($appointment->created_at)->format('d M, Y')}}</label>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <a href="{{route('appointments.index')}}" class="btn btn-warning">Cancel</a>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection
