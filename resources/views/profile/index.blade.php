@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profile</h3>
                    {{-- <div class="card-tools">
                        <a href="{{route('profile.create')}}" class="btn btn-warning btn-sm">Add New
                            <i class="fas fa-plus-circle fa-fw" aria-hidden="true"></i>
                        </a>
                    </div> --}}
                </div><!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-warning card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <span alt="User profile picture" class="profile-user-img img-fluid img-circle">
                                            <i class="fas fa-user-alt fa-4x" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <h3 class="profile-username text-center">{{$profile->name}}</h3>
                                    <p class="text-muted text-center">@if($profile->userType!=null){{ $profile->userType->name }}@endif</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <span class="float-right">{{ $profile->email }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Phone</b><span class="float-right">{{ $profile->phone }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Joined</b> <span class="float-right">{{ Carbon\Carbon::parse($profile->created_at)->format('d M Y') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header p-2">
                                    <h3 class="card-title">Update Password</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('profile.update', $profile->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="password" class="col-form-label required">Password:</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" required>
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-form-label required">Confirm Password:</label>
                                            <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror"
                                            name="password_confirmation" required>
                                            @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">@method('PUT')Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection
