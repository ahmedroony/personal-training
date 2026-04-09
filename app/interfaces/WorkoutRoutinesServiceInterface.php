<?php

namespace App\interfaces;

interface WorkoutRoutinesServiceInterface
{
    public function index();
    public function updateDescription(array $data);
}
