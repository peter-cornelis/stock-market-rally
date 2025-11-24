<?php

use App\Models\Equity;
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
        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Equity::class)->constrained()->cascadeOnDelete();
            $table->dateTime('date');
            $table->decimal('price', 10,2);
            $table->bigInteger('volume');
            $table->timestamps();
            
            $table->index(['equity_id', 'date']);
            $table->unique(['equity_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charts');
    }
};
