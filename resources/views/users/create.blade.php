@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create User</h3>
                </div><!-- /.card-header -->
                <div class="card-body">

                    <form method="POST" action="{{route('users.store')}}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="col-form-label required">Name:</label>
                            <input id="name" type="name" name="name" value="{{old('name')}}"
                            class="form-control @error('name') is-invalid @enderror" required autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="col-form-label required">Email:</label>
                            <input id="email" type="email" name="email" value="{{old('email')}}"
                            class="form-control @error('email') is-invalid @enderror" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="form-group">
                            <label for="type" class="col-form-label required">Type:</label>
                            <select id="type" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                            name="type" value="{{ old('type') }}" required>
                                <option value="0" disabled="true" selected="true">--- Select User Type ---</option>
                                @if($user_types->count()>0)
                                    @foreach ($user_types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <a href="{{route('users.index')}}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>

                    </form>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection
