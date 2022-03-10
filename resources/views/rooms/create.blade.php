@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Room</h3>
                </div><!-- /.card-header -->
                <div class="card-body">

                    <form method="POST" action="{{route('therapy-rooms.store')}}">
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

                        <!-- Buttons -->
                        <a href="{{route('therapy-rooms.index')}}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>

                    </form>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection
