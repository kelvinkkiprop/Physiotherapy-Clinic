<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Other\UserType;
//Email
use App\Mail\CommonMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
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

        $users = User::with(['userType'])->orderBy('id', 'desc')->paginate(10);
        // return $users;

        return view('users.index')->with([
            'users' =>  $users,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_types = UserType::orderBy('name', 'asc')->get();

        return view('users.create')->with([
            'user_types' => $user_types
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'type' => 'required|string',
        ]);

        $random_password = Str::random(6);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($random_password),
            'created_at'=>date('Y-m-d H:i:s'),
        ]);


        $email = $request['email'];
        $message = "Your email is: {$email}, and the default password is: {$random_password}.";

        //Email
        $data = array(
            'name' =>  $request['name'],
            'subject' =>  "Created Account",
            'url' =>  null,
            'btn-text' => null,
            'message' => $message,
            'file' => null,
            'file_name' => null
        );
        Mail::to($email)->send(new CommonMail($data));

        return redirect()->back()->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show')->with([
            'user' =>  $user,
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
        $user = User::find($id);
        $user_types = UserType::orderBy('name', 'asc')->get();

        return view('users.edit')->with([
            'user' =>  $user,
            'user_types' => $user_types
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,id',
            'type' => 'required|string',
        ]);

        $random_password = Str::random(6);

        User::where('id', $id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($random_password),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        $email = $request['email'];
        $message = "Your email is: {$email}, and the default password is: {$random_password}.";

        //Email
        $data = array(
            'name' =>  $request['name'],
            'subject' =>  "Updated Account",
            'url' =>  null,
            'btn-text' => null,
            'message' => $message,
            'file' => null,
            'file_name' => null
        );
        Mail::to($email)->send(new CommonMail($data));

        return redirect()->route('users.index')->with('info', 'User updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        // return $user;
        $user->delete();
        return redirect()->back()->with('danger', 'User removed successfully');
    }
}
