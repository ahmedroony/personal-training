<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'name_plan', 'start_date', 'end_date', 'status', 'description', 'price'
        ];
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        
}
