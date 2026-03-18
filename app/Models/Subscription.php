<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'price',
        'start_date',
        'end_date',
        'status',
    ];
//this is a cast that convert the start_date and end_date to date
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Calculates and sets the end_date based on the chosen plan's duration_days.
     */
    public function calculateAndSetEndDate()
    {
        if ($this->start_date && $this->plan) {
            $this->end_date = Carbon::parse($this->start_date)->addDays($this->plan->duration_days);
        }
        return $this;
    }

    /**
     * Checks if the end_date has passed today, and updates the status to 'expired' or 'active'.
     */
    public function checkAndUpdateStatus()
    {
        if ($this->end_date && Carbon::today()->gt($this->end_date)) {
            $this->status = 'expired';
        } else {
            $this->status = 'active';
        }
        return $this;
    }

    /**
     * Accessor: Calculates remaining days
     */
    public function getRemainingDaysAttribute()
    {
        if (! $this->end_date) {
            return 0;
        }
        // The second parameter 'false' ensures that if the end date is in the past, it will return a negative value.
        // We use max(0, ...) to ensure that we don't return negative days.
        return max(0, Carbon::today()->diffInDays($this->end_date, false));
    }

    /**
     * isFuture() checks if the end_date is in the future
     */
    public function getIsActiveAttribute()
    {
        return $this->status === 'active'
            && $this->end_date
            && $this->end_date->isFuture();
    }
}
