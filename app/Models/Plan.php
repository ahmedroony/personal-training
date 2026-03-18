<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration_days',
        'description',
        'price',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
