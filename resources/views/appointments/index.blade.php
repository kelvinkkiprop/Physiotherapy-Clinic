@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/appointments" class="text-success">Filter</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Showing {{$appointments->count()}} results</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-9">
                    {{-- @if($appointments->count() != 0) --}}
                        <div class="form-group row">
                            <label for="sort_by" class="col-md-2 col-form-label text-md-right"></label>
                            <div class="col-md-10">
                                <form method="POST" action="{{route('appointments-filter')}}">
                                    @csrf
                                    <div class="input-group">
                                        @if(Auth::user()->type==1)
                                        @if($therapists->count() != 0)
                                            <select id="therapist" type="text" class="form-control{{ $errors->has('therapist') ? ' is-invalid' : '' }}"
                                            name="therapist" value="{{ old('therapist') }}" required>
                                                <option value="0" disabled="true" selected="true">--- Filter by Therapist ---</option>
                                                @if($therapists->count()>0)
                                                    @foreach ($therapists as $therapist)
                                                        <option value="{{$therapist->id}}">{{$therapist->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        @endif
                                        @endif
                                        @if($appointment_statuses->count() != 0)
                                            <select id="status" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                            name="status" value="{{ old('status') }}" required>
                                                <option value="0" disabled="true" selected="true">--- Filter by Status ---</option>
                                                @if($appointment_statuses->count()>0)
                                                    @foreach ($appointment_statuses as $status)
                                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        @endif
                                        <input id="date" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                        name="date" value="{{ old('date') }}" placeholder="Filter by date" />
                                        @error('filter_by')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <button type="submit" title="Click here to filter"
                                            class="btn btn-success">@method('PUT')<i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    {{-- @endif --}}
                </div>
            </div>


            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Appointments</h3>
                    <div class="card-tools">
                        <a href="{{route('appointments.create')}}" class="btn btn-warning btn-sm">Add New
                            <i class="fas fa-plus-circle fa-fw" aria-hidden="true"></i>
                        </a>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">

                    @if($appointments->count()>0)
                    <div class="table-responsive p-0">
                        <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @if(Auth::user()->type==1)<th>Therapist</th>@endif
                                    <th>Room</th>
                                    <th>DateTime</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ ($loop->index)+1 }}</td>
                                    @if(Auth::user()->type==1)<td>@if($appointment->appointmentTherapist){{ $appointment->appointmentTherapist->name }}@endif</td>@endif
                                    <td>@if($appointment->appointmentRoom){{ $appointment->appointmentRoom->name }}@endif</td>
                                    <td>{{ Carbon\Carbon::parse($appointment->date . $appointment->time)->format('d/m/y, H:iA') }}
                                    <td>{{ Illuminate\Support\Str::limit($appointment->description, 10, '...')}}</td>
                                    <td><span class="badge @if($appointment->status==1) badge-secondary @elseif($appointment->status==2) badge-warning @else badge-success @endif">
                                        @if($appointment->appointmentStatus){{ $appointment->appointmentStatus->name }}@endif</span></td>
                                    <td>{{ Carbon\Carbon::parse($appointment->created_at)->format('d M y') }}</td>

                                    <td class="text-nowrap">
                                        @if(Auth::user()->type==2)<!--Therapist-->
                                        <a href="#" data-toggle="modal" data-target="#statusModal{{$appointment->id}}"
                                        class="btn btn-secondary btn-sm"><i class="fas fa-pen-alt"></i></a>
                                         <!--statusModal-->
                                         <div class="modal" id="statusModal{{$appointment->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{route('update-appointment-status')}}">
                                                        @csrf
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title w-100">Mark Appointment</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if($appointment_statuses->count() != 0)

                                                            <div class="form-group">
                                                                <input id="appointment_id" type="id" class="form-control{{ $errors->has('appointment_id') ? ' is-invalid' : '' }}"
                                                                name="appointment_id" value="{{ $appointment->id }}" required hidden/>
                                                            </div>
                                                            <div class="form-group">
                                                                <select id="appointment_status" type="text" class="form-control{{ $errors->has('appointment_status') ? ' is-invalid' : '' }}"
                                                                name="appointment_status" value="{{ old('appointment_status') }}" required>
                                                                    <option value="0" disabled="true" selected="true">--- Filter by Status ---</option>
                                                                    @if($appointment_statuses->where('id','!=',1)->count()>0)
                                                                        @foreach ($appointment_statuses->where('id','!=',1) as $status)
                                                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>

                                                            @endif

                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <button type="button" class="pull-left btn btn-light btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if(Auth::user()->type==1)<!--Admin-->
                                        <a class="btn btn-outline-dark btn-sm mr-1" href="{{route('appointments.show',$appointment->id)}}">
                                            <i class="fas fa-eye"></i></a>
                                                <a class="btn btn-dark btn-sm mr-1" href="{{route('appointments.edit',$appointment->id)}}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#deleteModal{{$appointment->id}}"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        <!--deleteModal-->
                                        <div class="modal" id="deleteModal{{$appointment->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center"><i class="fas fa-exclamation-triangle fa-4x"></i></p>
                                                        <p class="text-center"><strong>Delete appointment?</strong></p>
                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        <button type="button" class="pull-left btn btn-light btn-sm" data-dismiss="modal">No</button>
                                                        <form method="POST" action="{{route('appointments.destroy',$appointment->id)}}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm"> @method('DELETE')Yes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p class="p-5 text-center text-muted">No appointments</p>
                    @endif

                    <p class="mt-1">
                        {{ $appointments->links() }}
                    </p>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection
