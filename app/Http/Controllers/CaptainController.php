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
}
