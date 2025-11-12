<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_ratios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equity_id')->constrained()->cascadeOnDelete()->unique();
            $table->date('date');
            $table->decimal('beta', 5, 3);
            $table->decimal('priceToEarningsRatio', 5, 2);
            $table->decimal('priceToBookRatio', 5, 2);
            $table->decimal('dividendYieldPercentage', 5, 2);
            $table->decimal('currentRatio', 5, 2);
            $table->decimal('revenuePerShare', 5, 2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_ratios');
    }
};
