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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('equity_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['buy', 'sell']);
            $table->decimal('quantity', 10, 4);
            $table->decimal('price', 10, 2);
            $table->decimal('fees', 8, 2)->default(0);
            $table->timestamp('executed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
