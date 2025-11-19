<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'equity_id',
        'quantity',
        'price',
        'fee',
        'total',
        'type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function equity(): BelongsTo 
    {
        return $this->belongsTo(Equity::class);
    }
}