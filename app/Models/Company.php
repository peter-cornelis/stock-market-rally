<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    public function exchanges(): BelongsToMany
    {
        return $this->belongsToMany(Exchange::class, 'exchange_company');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Equity::class);
    }
}
