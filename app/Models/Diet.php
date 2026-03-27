<?php

namespace App\Models;

use App\Models\User;
use App\Models\Dietplan;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'subscription_id',
        'diet_plan_id',
        'custom_notes',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function dietPlan()
    {
        return $this->belongsTo(DietPlan::class);
    }
}
