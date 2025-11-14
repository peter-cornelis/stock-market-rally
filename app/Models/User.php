<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'balance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function equities(): BelongsToMany
    {
        return $this->belongsToMany(Equity::class, 'equity_user')
                    ->withPivot('quantity', 'buy_price')
                    ->orderBy('symbol');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function getEquitiesValueAttribute(): float
    {
        return round($this->equities->sum('value'), 2);
    }

    public function getPortfolioValueAttribute(): float
    {
        return round($this->balance + $this->equities_value, 2);
    }

    public function getPortfolioGainAttribute(): float
    {
        return round($this->portfolio_value - $this->starting_balance, 2);
    }

    public function getPortfolioGainPercentageAttribute(): float
    {
        return round(($this->portfolio_gain / $this->starting_balance) * 100, 2);
    }
}
