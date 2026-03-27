<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaptainAttendance extends Model
{
    protected $fillable = ['user_id', 'date', 'time'];

    protected $casts = ['date' => 'date'];

    public function captain()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
