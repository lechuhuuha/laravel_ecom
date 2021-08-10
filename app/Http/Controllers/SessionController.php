<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    //
    public function destroy()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You has been logout');
    }
    public function create()
    {
        return view('login.create');
    }
    public function store()
    {
        $atttributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'

        ]);
        if (!Auth::attempt($atttributes)) {
            throw  ValidationException::withMessages(['email' => 'Your provided credentials could not be verified']);
        }
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back');
    }
}
