<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Main\Appointment;
use App\Models\Main\TherapyRoom;
use App\Models\Other\UserType;

class DashboardController extends Controller
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
        // $this->middleware('therapistsonly');
    }


    /**
     * Index
     */
    public function index()
    {

        $users_count = User::count();
        $recent_users = User::orderBy('id', 'desc')->get()->take(5);
        $appointments_count = Appointment::count();
        $therapy_rooms = TherapyRoom::count();
        $messages_count = User::count();

        $current_user = Auth::User();
        $my_appointments = Appointment::where('therapist',$current_user->id)->get();
        $my_recent_appointments = Appointment::with('appointmentRoom')->where('therapist',$current_user->id)
        ->orderBy('id', 'desc')->get()->take(5);

        return view('dashboard')->with([
            //Admin
            'users_count' => $users_count,
            'recent_users' => $recent_users,
            'appointments_count' => $appointments_count,
            'therapy_rooms' => $therapy_rooms,
            'messages_count' => $messages_count,
            //Therapist
            'my_recent_appointments' => $my_recent_appointments,
            'my_appointments' => $my_appointments,
        ]);
    }

}
