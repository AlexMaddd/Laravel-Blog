<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('destroy'); // middleware will lock down other methods except for destroy if not guest
    }
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $this->validate(request(),[

            'email' => 'required',
            'password' => 'required'

        ]);

        if(! auth()->attempt(request(['email', 'password'])))
        {
            return back()->withErrors([

                'message' => "Please check credentials and try again"

            ]);
        }

        return redirect('/');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }
}
