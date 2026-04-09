<?php

namespace App\interfaces;

interface UserDietPlanServiceInterface
{
    public function index();
    public function store(array $data);
}
