<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_plan',
        'starts_at',
        'ends_at',
        'status',
        'description',
        'price',
        'duration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The 'starts_at' and 'ends_at' attributes should be cast to dates objects for easier manipulation
    //instead of strings. This allows us to use Carbon's date methods directly on these attributes.
    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
    ];

    public function getRemainingDaysAttribute()
    {
        if (! $this->ends_at) {
            return 0;
        }
    //the diffInDays method calculates the difference in days between today and the subscription's end date. The second parameter 'false' ensures that if the end date is in the past, it will return a negative value. We use max(0, ...) to ensure that we don't return negative days, which would indicate an expired subscription.
        return max(0, Carbon::today()->diffInDays($this->ends_at, false));
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'active'
            && $this->ends_at
            //isFuture() method checks if the end date is in the future, meaning the subscription is still valid. If the end date has passed, it will return false, indicating that the subscription is no longer active.
            && $this->ends_at->isFuture();
    }
}
