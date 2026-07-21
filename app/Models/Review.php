<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = ['event_id', 'transaction_id', 'rating', 'testimony', 'customer_name'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
