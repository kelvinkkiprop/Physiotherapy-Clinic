@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dashboard</h3>
                </div>

                <div class="card-body">

                     <!-- Admin -->
                    @if(Auth::user()->type==1)
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $appointments_count }}</h3>
                                    <p>Appointments</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $users_count }}</h3>
                                    <p>Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $therapy_rooms }}</h3>
                                    <p>Rooms</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-door-closed"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $messages_count }}</h3>
                                    <p>Messages</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    @endif

                    <!-- Therapist -->
                    @if(Auth::user()->type==2)
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Scheduled</span>
                                    <span class="info-box-number">{{$my_appointments->where('status',1)->count()}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Ongoing</span>
                                    <span class="info-box-number">{{$my_appointments->where('status',2)->count()}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Completed</span>
                                    <span class="info-box-number">{{$my_appointments->where('status',3)->count()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    @endif

                </div>
            </div>

            <!-- Admin -->
            @if(Auth::user()->type==1)
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Users</h3>
                </div><!-- /.card-header -->
                <div class="card-body">

                    @if($recent_users->count()>0)
                    <div class="table-responsive p-0">
                        <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ Carbon\Carbon::parse($user->created_at)->format('d M, y h:iA') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p class="p-5 text-muted text-center">No recent users</p>
                    @endif

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            @endif

            <!-- Therapist -->
            @if(Auth::user()->type==2)
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Appointments</h3>
                </div><!-- /.card-header -->
                <div class="card-body">

                    @if($my_recent_appointments->count()>0)
                    <div class="table-responsive p-0">
                        <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>DateTime</th>
                                    <th>Room</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($my_recent_appointments as $appointment)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($appointment->created_at)->format('d M, y h:iA') }}</td>
                                    <td>@if($appointment->appointmentRoom){{ $appointment->appointmentRoom->name }}@endif</td>
                                    <td>{{ Illuminate\Support\Str::limit($appointment->description, 15, '...')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p class="p-5 text-muted text-center">No recent appointments</p>
                    @endif

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            @endif

        </div>
    </div>
</div>
@endsection
