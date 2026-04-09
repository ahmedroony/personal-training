<?php
namespace App\Domains\admin\Actions;
use App\Models\DietPlan;
use App\interfaces\DietPlanServiceInterface;

class DietPlanService implements DietPlanServiceInterface{
    public function index(){
        $DietPlan = DietPlan::all();
        return $DietPlan;
    }
    public function store(array $data){
        DietPlan::create([
            'name'=>$data['name'],
            'base_description'=>$data['base_description'],
        ]);
    }
}
