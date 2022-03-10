@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rooms</h3>
                    <div class="card-tools">
                        <a href="{{route('therapy-rooms.create')}}" class="btn btn-warning btn-sm">Add New
                            <i class="fas fa-plus-circle fa-fw" aria-hidden="true"></i>
                        </a>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">

                    @if($rooms->count()>0)
                    <div class="table-responsive p-0">
                        <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ ($loop->index)+1 }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($room->created_at)->format('d M y') }}</td>
                                    <td class="text-nowrap">
                                        <a class="btn btn-outline-dark btn-sm mr-1" href="{{route('therapy-rooms.show',$room->id)}}">
                                            <i class="fas fa-eye"></i></a>
                                                <a class="btn btn-dark btn-sm mr-1" href="{{route('therapy-rooms.edit',$room->id)}}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#deleteModal{{$room->id}}"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        <!--deleteModal-->
                                        <div class="modal" id="deleteModal{{$room->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center"><i class="fas fa-exclamation-triangle fa-4x"></i></p>
                                                        <p class="text-center"><strong>Delete room?</strong></p>
                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        <button type="button" class="pull-left btn btn-light btn-sm" data-dismiss="modal">No</button>
                                                        <form method="POST" action="{{route('therapy-rooms.destroy',$room->id)}}">
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
                        <p class="p-5 text-center text-muted">No rooms</p>
                    @endif

                    <p class="mt-1">
                        {{ $rooms->links() }}
                    </p>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection
