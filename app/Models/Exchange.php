<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exchange extends Model
{
    public $timestamps = false;

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'exchange_company');
    }

    public function equities()
    {
        return $this->hasMany(Equity::class);
    }
}
