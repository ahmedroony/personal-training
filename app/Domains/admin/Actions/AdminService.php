<?php

namespace App\Domains\admin\Actions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
class AdminService
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', ['users' => $users]);
    }
    }
