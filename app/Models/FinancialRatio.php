<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialRatio extends Model
{
    protected $guarded = [];

    public function equity(): BelongsTo
    {
        return $this->belongsTo(Equity::class);
    }
}
