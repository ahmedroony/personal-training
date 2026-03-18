<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout_Plans extends Model
{
    protected $fillable = [
        'user_id',
        'description',
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }
}
