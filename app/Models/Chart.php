<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chart extends Model
{
    public function equity(): BelongsTo
    {
        return $this->belongsTo(Equity::class);
    }
}
