<?php
namespace App\Domains\admin\Actions;
use App\Models\DietPlan;
class DietPlanService{
    public function index(){
    }
    public function store(array $data){
        DietPlan::create([
            'name'=>$data['name'],
            'base_description'=>$data['base_description'],
        ]);
    }
}
