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
        'paid_price',
        'start_date',
        'end_date',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function diets()
    {
        return $this->hasMany(Diet::class);
    }
    
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
     * Accessor: Calculates remaining days
     */
    public function getRemainingDaysAttribute()
    {
        if (! $this->end_date) {
            return 0;
        }
        return max(0, Carbon::today()->diffInDays($this->end_date, false));
    }

    /**
     * isFuture() checks if the end_date is in the future
     */
    public function getIsActiveAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return false;
        }
        return Carbon::today()->gte($this->start_date) && Carbon::today()->lte($this->end_date);
    }

    public function getStatusAttribute()
    {
        return $this->is_active ? 'active' : 'expired';
    }
    public function getLastAttendanceInfoAttribute()
    {
        $last = $this->attendances()->latest()->first();
        if (!$last) {
            return 'لم يحضر بعد';
        }
        return $last->date->format('Y-m-d') . ' (' . $last->time . ')';
    }
}
