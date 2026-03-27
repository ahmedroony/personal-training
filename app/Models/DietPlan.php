<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    protected $table = 'diet_plans';
        protected $fillable = [
        'name',
        'base_description',
    ];
}
