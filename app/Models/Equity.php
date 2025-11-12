<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equity extends Model
{
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function exchange(): BelongsTo
    {
        return $this->belongsTo(Exchange::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'stock_user');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function financialRatios()
    {
        return $this->hasMany(FinancialRatio::class);
    }

    public function charts(): HasMany
    {
        return $this->hasMany(Chart::class);
    }
}
