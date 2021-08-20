<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use App\Models\User;
use App\Rules\ArraySumToNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\UserPermissionsExists;

class PermissionController extends Controller
{
    //
    public function index()
    {
        $user = User::all();
        // dd($user);
        // foreach ($user as $item) {
        //     dump($item->permissions()->get());
        // }
        // die;
        return view('admin.permissions.index', ['users' => $user]);
    }
    public function create()
    {
        $users = User::all();
        return view('admin.permissions.create', ['users' => $users]);
    }
    public function store()
    {
        $newPermissions = array("name" => request('name'), "created_at" => DB::raw('CURRENT_TIMESTAMP'), "updated_at" => DB::raw('CURRENT_TIMESTAMP'));
        DB::table('permissions')->insert($newPermissions);

        if (request('user_id')) {
            $newPermissionsId = DB::getPdo()->lastInsertId();
            $newPermissionsUser = array("user_id" => request('user_id'), "permission_id" => $newPermissionsId, "permissions" => array_sum(request('permissions') ?? []), "created_at" => DB::raw('CURRENT_TIMESTAMP'), "updated_at" => DB::raw('CURRENT_TIMESTAMP'));
            DB::table('permisison_user')->insert($newPermissionsUser);
        }
        return redirect()->route('admin.permissions.index');
    }
    public function edit($userId)
    {
        $user = User::find($userId);
        // dd($user);
        return view('admin.permissions.edit', ['user' => $user]);
    }
    public function show($userId, $permissionsId)
    {
        $user = User::find($userId);
        foreach ($user->permissions as $item) {
            if ($item->id == $permissionsId) {
                $permissions = ($item->pivot->permissions);
            }
        }
        return view('admin.permissions.show', ['user' => $user, 'permissions' => $permissions, 'permissionsId' => $permissionsId]);
    }
    public function saveAction($userId, $permissionsId)
    {
        if ($userId) {
            $newPermissionsUser = array("permissions" => array_sum(request('permissions') ?? []), "updated_at" => DB::raw('CURRENT_TIMESTAMP'));
            DB::table('permisison_user')->where('user_id', $userId)->where('permission_id', $permissionsId)->update($newPermissionsUser);
        }
        return redirect()->route('admin.permissions.index');
    }
    public function addUser()
    {
        $permissions = Permissions::all();
        $user = User::all();
        return view('admin.permissions.add-user', ['permissions' => $permissions, 'users' => $user]);
    }
    public function storeAddUser()
    {
        // dd(request()->all());
        request()->validate([
            'permissionsArr' => [new UserPermissionsExists],
            'permissions' => [new ArraySumToNumber]
        ]);
        // dd(request('permissions')['permission_id']);
        $userPermisisonsArr = array("permission_id" => request('permissionsArr')['permission_id'], "user_id" => request('permissionsArr')['user_id'], "permissions" => array_sum(request('permissions') ?? []), "created_at" => DB::raw('CURRENT_TIMESTAMP'), "updated_at" => DB::raw('CURRENT_TIMESTAMP'));
        DB::table('permisison_user')->insert($userPermisisonsArr);
        return redirect()->route('admin.permissions.index');
    }
    public function userDelete($userId, $permissionsId)
    {
        DB::table('permisison_user')->where('user_id', $userId)->where('permission_id', $permissionsId)->delete();
        return redirect()->route('admin.permissions.index');
    }
}
