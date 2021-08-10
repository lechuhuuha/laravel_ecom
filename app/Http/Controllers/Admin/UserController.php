<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {

        return view('admin.users.index', ['users' => User::paginate(5)]);
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }
    public function update(User $user)
    {

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',

        ]);
        $user->update($data);
        return redirect()->route('admin.users.index');
    }
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
    public function changeStatus(User $user)
    {
        $data = request()->validate([
            'active' => 'required'
        ]);
        $data['active'] = !$data['active'];
        $user->update($data);
        return redirect()->route('admin.users.index');
    }
    public function search()
    {
        $user = User::latest();

        if (request('name')) {
            $user->where('name', 'like', '%' . request('name') . '%');
        }
        return view('admin.users.index', ['users' => $user->paginate(5)]);
    }
}
