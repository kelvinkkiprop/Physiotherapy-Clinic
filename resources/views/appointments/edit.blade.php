@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Appointment</h3>
                </div><!-- /.card-header -->
                <div class="card-body">

                    <form method="POST" action="{{route('appointments.update', $appointment->id)}}">
                        @csrf

                        <!-- Therapist -->
                        <div class="form-group">
                            <label for="therapist" class="col-form-label required">Therapist:</label>
                            <select id="therapist" type="text" class="form-control{{ $errors->has('therapist') ? ' is-invalid' : '' }}"
                            name="therapist" value="{{ old('therapist') }}" required>
                                <option value="0" disabled="true" selected="true">--- Select Therapist ---</option>
                                @if($therapists->count()>0)
                                    @foreach ($therapists as $therapist)
                                    <option @if($therapist->id==$appointment->therapist) selected="true" @endif
                                        value="{{$therapist->id}}">{{$therapist->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('therapist')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Room -->
                        <div class="form-group">
                            <label for="room" class="col-form-label required">Room:</label>
                            <select id="room" type="text" class="form-control{{ $errors->has('therapist') ? ' is-invalid' : '' }}"
                            name="room" value="{{ old('room') }}" required>
                                <option value="0" disabled="true" selected="true">--- Select Room ---</option>
                                @if($rooms->count()>0)
                                    @foreach ($rooms as $room)
                                        <option @if($room->id==$appointment->room) selected="true" @endif
                                            value="{{$room->id}}">{{$room->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('room')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Date -->
                                <div class="form-group">
                                    <label for="date" class="col-form-label required">Date:</label>
                                    <input id="date" type="date" name="date" value="{{ $appointment->date }}"
                                    class="form-control @error('date') is-invalid @enderror" required autocomplete="date">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Time -->
                                <div class="form-group">
                                    <label for="time" class="col-form-label required">Time:</label>
                                    <input id="time" type="time" name="time" value="{{ $appointment->time }}"
                                    class="form-control @error('time') is-invalid @enderror" required autocomplete="time">
                                    @error('time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="col-form-label required">Description:</label>
                            <textarea id="description" type="description" name="description" value="{{old('description')}}"
                            class="form-control @error('description') is-invalid @enderror" required autocomplete="description"
                            rows="3">{{$appointment->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <a href="{{route('appointments.index')}}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-success">@method('PUT')Submit</button>

                    </form>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection
