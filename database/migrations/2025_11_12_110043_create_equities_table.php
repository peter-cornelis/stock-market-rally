<?php

use App\Models\Company;
use App\Models\Exchange;
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
        Schema::create('equities', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');
            $table->string('isin')->unique();
            $table->foreignIdFor(Exchange::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
            $table->decimal('lastDividend', 3, 3)->nullable();
            $table->timestamps();

            $table->unique(['exchange_id', 'symbol']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equities');
    }
};
