<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialRatio extends Model
{
    public function stock(): BelongsTo
    {
        return $this->belongsTo(Equity::class);
    }
}
