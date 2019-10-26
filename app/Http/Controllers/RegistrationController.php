<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest'); // only guests can access these methods
    }

    public function create()
    {
        return view('registration.create');
    }

    public function store()
    {
        $this->validate(request(), [

            'name' => 'required',
            'email' => 'required|email', // of type email
            'password' => 'required|confirmed' // checks if password confirmation matches * because of _confirmation in form
        ]);

        // $user = User::create(request(['name', 'email', 'password']));
        // or User::register to be even clearer but have to define register method

        $user = new User;

        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));

        $user->save();

        // signs user in
        auth()->login($user);

        // dd(auth());

        return redirect()->home();
    }

}
