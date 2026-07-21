<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'event_id',
        'order_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'total_price',
        'status',
        'snap_token',
        'coupon_code',
        'discount_amount',
        'checked_in_at',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
