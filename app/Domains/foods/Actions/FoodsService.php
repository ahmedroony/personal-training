<?php
namespace App\Domains\foods\Actions;
use App\Models\Foods;
class FoodsService{
    public function index(){
        
    }
    function StoreFoods(array $data,Foods $food){
            return $food->create([
            'name' => $data['name'],
            'calories' => $data['calories'],
            'protein' => $data['protein'],
            'carbs' => $data['carbs'],
            'fat' => $data['fat'],
            'unit' => $data['unit'],
        ]);
    }
}
