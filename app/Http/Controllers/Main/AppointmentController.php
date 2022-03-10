<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use App\Models\User;
use App\Models\Main\Appointment;
use App\Models\Main\TherapyRoom;
use App\Models\other\AppointmentStatus;
use Illuminate\Support\Facades\Auth;
//Email
use App\Mail\CommonMail;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('adminsonly');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_appointments = Appointment::with(['appointmentTherapist','appointmentRoom','appointmentStatus']);

        if(Auth::user()->type==2){//Therapist
            $appointments = $all_appointments->where('therapist', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        }else{
            $appointments = $all_appointments->orderBy('id', 'desc')->paginate(10);
        }
        // return $appointments;
        $therapists = User::where('type', 2)->orderBy('name', 'asc')->get();
        $appointment_statuses = AppointmentStatus::orderBy('id', 'asc')->get();

        return view('appointments.index')->with([
            'appointments' =>  $appointments,
            'therapists' =>  $therapists,
            'appointment_statuses' =>  $appointment_statuses,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $therapists = User::where('type', 2)->orderBy('name', 'asc')->get();
        $rooms = TherapyRoom::orderBy('name', 'asc')->get();

        return view('appointments.create')->with([
            'therapists' => $therapists,
            'rooms' => $rooms,
        ]);

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
            'therapist' => 'required|integer|max:255',
            'room' => 'required|string|integer|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'description' => 'required|string',
        ]);

        Appointment::create([
            'therapist' => $request['therapist'],
            'room' => $request['room'],
            'date' => $request['date'],
            'time' => $request['time'],
            'description' => $request['description'],
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        $therapist = User::find($request['therapist']);
        $email = $therapist->email;
        $message = "Your have a new appointment on {$request['date']}, starting {$request['time']} at Room No. {$request['room']}";

        //Email
        $data = array(
            'name' =>  $therapist->name,
            'subject' =>  "New Appointment",
            'url' =>  null,
            'btn-text' => null,
            'message' => $message,
            'file' => null,
            'file_name' => null
        );
        Mail::to($email)->send(new CommonMail($data));

        return redirect()->back()->with('success', 'Appointment created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);
        return view('appointments.show')->with([
            'appointment' =>  $appointment,
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
        $appointment = Appointment::find($id);
        $therapists = User::where('type', 2)->orderBy('name', 'asc')->get();
        $rooms = TherapyRoom::orderBy('name', 'asc')->get();

        return view('appointments.edit')->with([
            'appointment' =>  $appointment,
            'therapists' => $therapists,
            'rooms' => $rooms,
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
            'therapist' => 'required|integer|max:255',
            'room' => 'required|string|integer|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'description' => 'required|string',
        ]);

        Appointment::where('id', $id)->update([
            'therapist' => $request['therapist'],
            'room' => $request['room'],
            'date' => $request['date'],
            'time' => $request['time'],
            'description' => $request['description'],
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        $therapist = User::find($request['therapist']);
        $email = $therapist->email;
        $message = "An appointment assigned to you has been updated to {$request['date']}, starting {$request['time']} at Room No. {$request['room']}";

        //Email
        $data = array(
            'name' =>  $therapist->name,
            'subject' =>  "New Appointment",
            'url' =>  null,
            'btn-text' => null,
            'message' => $message,
            'file' => null,
            'file_name' => null
        );
        Mail::to($email)->send(new CommonMail($data));

        return redirect()->route('appointments.index')->with('info', 'Appointment updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->back()->with('danger', 'Appointment removed successfully');
    }


    /**
     * filterAppointments
     */
    public function filterAppointments(Request $request)
    {
        $therapist = $request['therapist'];
        $status = $request['status'];
        $date = $request['date'];

        if(Auth::user()->type==2){//Therapist
            $all_appointments = Appointment::with(['appointmentTherapist','appointmentRoom','appointmentStatus'])->where('therapist', Auth::user()->id);
        }else{
            $all_appointments = Appointment::with(['appointmentTherapist','appointmentRoom','appointmentStatus']);
        }

        if (empty($therapist) && empty($status) && is_null($date)){
            return redirect()->back()->with('warning', 'No filter category selected');
        }else{

            if(!empty($therapist) && !empty($status) && !is_null($date)){
                $appointments = $all_appointments->where('therapist',$therapist)->where('status',$status)->where('date',$date)->orderBy('id', 'desc')->paginate(10);;

            }else if(!empty($therapist) && !empty($status) && is_null($date)){
                $appointments = $all_appointments->where('therapist',$therapist)->where('status',$status)->orderBy('id', 'desc')->paginate(10);

            }else if(!empty($therapist) && empty($status) && !is_null($date)){
                $appointments = $all_appointments->where('therapist',$therapist)->where('date',$date)->orderBy('id', 'desc')->paginate(10);

            }else if(empty($therapist) && !empty($status) && !is_null($date)){
                $appointments = $all_appointments->where('status',$status)->where('date',$date)->orderBy('id', 'desc')->paginate(10);

            }else if(!empty($therapist) && !empty($status) && is_null($date)){
                $appointments = $all_appointments->where('therapist',$therapist)->orderBy('id', 'desc')->paginate(10);

            }else if(empty($therapist) && !empty($status) && is_null($date)){
                $appointments = $all_appointments->where('status',$status)->orderBy('id', 'desc')->paginate(10);

            }else if(empty($therapist) && empty($status) && !is_null($date)){
                $appointments = $all_appointments->where('date',$date)->orderBy('id', 'desc')->paginate(10);

            }else{
                $appointments = $all_appointments->orderBy('id', 'desc')->paginate(10);

            }


            $therapists = User::where('type', 2)->orderBy('name', 'asc')->get();
            $appointment_statuses = AppointmentStatus::orderBy('id', 'asc')->get();

            return view('appointments.index')->with([
                'appointments' =>  $appointments,
                'therapists' => $therapists,
                'appointment_statuses' => $appointment_statuses,
            ]);

        }
    }



    /**
     * updateAppointmentStatus
     */
    public function updateAppointmentStatus(Request $request)
    {

        $id = $request['appointment_id'];
        Appointment::where('id', $id)->update([
            'status' => $request['appointment_status'],
        ]);
        return redirect()->back()->with('info', 'Appointment marked successfully');

    }



}
