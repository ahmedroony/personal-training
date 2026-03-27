<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\foods\Actions\FoodsService;
use App\Models\Foods;
class FoodsController extends Controller
{
    protected $food;
    public function __construct(FoodsService $food)
    {
        $this->food = $food;
    }
    public function index(Request $request){
            $foods = $request->all();
            return view('foods.index',compact('foods'));
    }
    public function Store(Request $request){
        $food = new Foods();
        $data = $request->all();
        $this->food->StoreFoods($data,$food);
        return redirect()->route('foods.index');
    }
}
