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
    public function storeClient(array $data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->phone = $data['phone'];
        $user->role = 2; // Assuming '2' is the role for clients
        $user->save();
        $user->subscriptions()->create([
            'name_plan' => $data['name_plan'],
            'price' => $data['price'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'starts_at' => $data['starts_at'],
            'ends_at' => $data['ends_at'],
            'status' => 'active',
        ]);
        return $user;
    }
}
