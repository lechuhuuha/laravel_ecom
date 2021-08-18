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
        // $user = User::all();
        // $activeUser = auth()->user();
        // foreach ($activeUser->permissions as $item2) {
        //     if ($item2->pivot->permissions & config('permissions.action.index')) {
        //         dd('nice');
        //     } else {
        //         abort(403);
        //     };
        // }
        // foreach ($user as $item) {
        //     foreach ($item->permissions as $item2) {
        //         if ($item2->pivot->permissions) {
        //         }
        //     }
        // }
        // die();
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
