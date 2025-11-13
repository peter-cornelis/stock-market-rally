<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function equity(): BelongsTo 
    {
        return $this->belongsTo(Equity::class);
    }

    public function getTotalAttribute(): float
    {
        $total = ($this->quantity * $this->price);
        return $this->type === 'buy' ? $total + $this->fee : $total - $this->fee;
    }
}