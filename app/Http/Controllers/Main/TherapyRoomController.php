<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use App\Models\Main\TherapyRoom;

class TherapyRoomController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('adminsonly');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rooms = TherapyRoom::orderBy('id', 'desc')->paginate(10);

        return view('rooms.index')->with([
            'rooms' =>  $rooms,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $this -> validate($request, [
            'name' => 'required|string|max:255|unique:therapy_rooms',
        ]);

        TherapyRoom::create([
            'name' => $request['name'],
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Room created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = TherapyRoom::find($id);
        return view('rooms.show')->with([
            'room' =>  $room,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = TherapyRoom::find($id);

        return view('rooms.edit')->with([
            'room' =>  $room
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'name' => 'required|string|max:255|unique:therapy_rooms,id',
        ]);

        TherapyRoom::where('id', $id)->update([
            'name' => $request['name'],
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('therapy-rooms.index')->with('info', 'Room updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = TherapyRoom::find($id);
        $room->delete();
        return redirect()->back()->with('danger', 'Room removed successfully');
    }
}
