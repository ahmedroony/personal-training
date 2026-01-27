<?php
namespace App\Domains\Captain\Actions;
use Illuminate\Http\Request;

class CaptainService
{
    public function index(){
        return view('Captain.index');
    }
    public function create(){
        return view('Captain.create');
    }
}
