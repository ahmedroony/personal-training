<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Captain\Actions\CaptainService;
class CaptainController
{
        public function index(){
            $service = new CaptainService();
            return $service->index();
    }
    public function create(){
            $service = new CaptainService();
            return $service->create();
    }
    public function store(Request $request){
            $service = new CaptainService();
            return $service->store($request);
    }
    public function edit($id){
        $service = new CaptainService();
        return $service->edit($id);
    }
    public function update(Request $request,$id){
        $service = new CaptainService();
        return $service->update($request,$id);
    }
    public function toggleStatus($id)
    {
        $service = new CaptainService();
        return $service->toggleStatus($id);
    }
    public function editpage()
    {
        $service = new CaptainService();
        return $service->editpage();
    }
}
