<?php
namespace App\Domains\admin\Actions;
use App\Models\User;
class MealsService{
    public function index(){
        $users = User::where('role', 2)->with('subscription')->get();
        return $users;
    }
}
