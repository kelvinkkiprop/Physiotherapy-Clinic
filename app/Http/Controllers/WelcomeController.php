<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Add
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Index
     */
    public function index()
    {

        $user = Auth::user();
        if($user->type=1){
            return redirect('/dashboard');
        }else{
            Auth::logout();
            return redirect('/');
        }

    }

}
