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
    public function create()
    {

    }
    public function mange()
    {
    }
}
