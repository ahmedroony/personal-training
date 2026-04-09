<?php

namespace App\interfaces;

interface DietPlanServiceInterface
{
    public function index();
    public function store(array $data);
}
