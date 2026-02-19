<?php

namespace App\Domains\admin\Actions;

use App\interfaces\main;
use App\Models\User;

class AdminService implements main
{
    public function index()
    {
        $users = User::all();
        return $users;
    }
    public function createClient()
    {

    }
    public function mange()
    {
    }
    public function storeClient($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'client';
        $user->save();

    }
}
