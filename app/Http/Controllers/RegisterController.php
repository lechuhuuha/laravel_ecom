<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return view('register.create');
    }
    public function store()
    {
        $data =   request()->validate([
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:255'
        ]);
        $user = User::create($data);
        Auth::login($user);
        return redirect('/')->with('success', 'You account has been created');
    }
}
