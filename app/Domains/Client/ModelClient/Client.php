<?php

namespace App\Domains\Client\ModelClient;

use App\Domains\Captain\ModelCaptain\Captain;
use App\Domains\packages\Modelpackages\Package;
use Carbon\Carbon;
use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_number', 'password', 'status', 'captain_id', 'package_name', 'subscription_starts_at', 'subscription_ends_at', 'package_id'];

    protected $casts = [
        'subscription_starts_at' => 'datetime',
        'subscription_ends_at' => 'datetime',
    ];

    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    protected static function newFactory()
    {
        return ClientFactory::new();
    }

    // دي الدالة اللي بتخترع خاصية اسمها days_left
    public function getDaysLeftAttribute()
    {
        // لو مفيش تاريخ نهاية، نرجع 0
        if (! $this->subscription_ends_at) {
            return 0;
        }
        // نحول تاريخ النهاية لكائن Carbon عشان نعرف نطرحه
        $endDate = Carbon::parse($this->subscription_ends_at);
        // نحسب الفرق بين دلوقتي وتاريخ النهاية
        $remaining = now()->diffInDays($endDate, false);
        // لو الرقم موجب نرجعه، لو سالب (الاشتراك انتهى) نرجع 0
        return $remaining > 0 ? (int) $remaining : 0;
    }
}
