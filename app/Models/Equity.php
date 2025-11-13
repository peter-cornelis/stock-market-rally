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
        return $this->belongsToMany(User::class, 'equity_user');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function financialRatio(): HasOne
    {
        return $this->hasOne(FinancialRatio::class);
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
        
        return count($latest) == 2 ? round($latest[0]->price - $latest[1]->price, 2) : 0;
    }

    public function getDailyChangePercentageAttribute(): float
    {
        $price = $this->current_price;
        $change = $this->daily_change;
        
        return $price > 0 ? round(($change / $price) * 100, 2) : 0;
    }

    public function getQuantityAttribute(): int
    {
        return $this->pivot?->quantity ?? 0;
    }

    public function getBuyPriceAttribute(): float
    {
        return $this->pivot?->buyPrice ?? 0;
    }

    public function getValueAttribute(): float
    {
        return $this->quantity * $this->current_price;
    }

    public function getStartingValueAttribute(): float
    {
        return $this->quantity * $this->buyPrice;
    }

    public function getValueChangeAttribute(): float
    {
        return $this->value - $this->starting_value;
    }

    public function getValueChangePercentageAttribute(): float
    {
        $value = $this->starting_value;
        $change = $this->value_change;
        
        return $value > 0 ? round(($change / $value) * 100, 2) : 0;
    }
}
