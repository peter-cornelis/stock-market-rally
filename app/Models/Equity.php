<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'stock_user');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function financialRatio():HasOne
    {
        return $this->HasOne(FinancialRatio::class);
    }

    public function charts(): HasMany
    {
        return $this->hasMany(Chart::class);
    }

    public function getCurrentPriceAttribute(): ?float
    {
        return $this->charts()->latest('date')->value('price');
    }

    public function getDailyChangeAttribute(): float
    {
        $latest = $this->charts()->latest('date')->limit(2)->get();
        
        return round($latest[0]->price - $latest[1]->price, 2);
    }

    public function getChangePercentageAttribute(): float
    {
        $price = $this->current_price;
        $change = $this->daily_change;
        
        return round(($change / $price) * 100, 2);
    }
}
