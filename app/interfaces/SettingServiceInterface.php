<?php

namespace App\interfaces;

interface SettingServiceInterface
{
    public function getAllPlans();
    public function deletePlan(int $id);
    public function getAllDietPlans();
    public function deleteDietPlan(int $id);
}
