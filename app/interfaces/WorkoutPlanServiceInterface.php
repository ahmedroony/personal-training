<?php

namespace App\interfaces;

interface WorkoutPlanServiceInterface
{
    public function index();
    public function updateDescription(array $data);
}
