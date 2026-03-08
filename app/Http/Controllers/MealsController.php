<?php

namespace App\Http\Controllers;

use App\Domains\admin\Actions\MealsService;

class MealsController extends Controller
{
    protected $meal;

    public function __construct(MealsService $meal)
    {
        $this->meal = $meal;
    }
    public function index(){
        $users = $this->meal->index();
        return view('meals.index',compact('users'));
    }
}
