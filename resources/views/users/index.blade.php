@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                    <div class="card-tools">
                        <a href="{{route('users.create')}}" class="btn btn-warning btn-sm">Add New
                            <i class="fas fa-plus-circle fa-fw" aria-hidden="true"></i>
                        </a>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">

                    @if($users->count()>0)
                    <div class="table-responsive p-0">
                        <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ ($loop->index)+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>@if($user->type){{ $user->userType->name }}@endif</td>
                                    <td>{{ Carbon\Carbon::parse($user->created_at)->format('d M y') }}</td>
                                    <td class="text-nowrap">
                                        <a class="btn btn-outline-dark btn-sm mr-1" href="{{route('users.show',$user->id)}}">
                                            <i class="fas fa-eye"></i></a>
                                                <a class="btn btn-dark btn-sm mr-1" href="{{route('users.edit',$user->id)}}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#deleteModal{{$user->id}}"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        <!--deleteModal-->
                                        <div class="modal" id="deleteModal{{$user->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center"><i class="fas fa-exclamation-triangle fa-4x"></i></p>
                                                        <p class="text-center"><strong>Delete user?</strong></p>
                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        <button type="button" class="pull-left btn btn-light btn-sm" data-dismiss="modal">No</button>
                                                        <form method="POST" action="{{route('users.destroy',$user->id)}}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm"> @method('DELETE')Yes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p class="p-5 text-center text-muted">No users</p>
                    @endif

                    <p class="mt-1">
                        {{ $users->links() }}
                    </p>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection
