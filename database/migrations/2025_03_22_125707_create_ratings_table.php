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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('card_id')->nullable()->constrained('cards')->cascadeOnDelete();
            $table->foreignId('deck_id')->nullable()->constrained('decks')->cascadeOnDelete();
            $table->decimal('rating_value', 3, 1);
            $table->text('review')->nullable();
            $table->string('format')->default('rotation'); // 'rotation', 'unlimited', 'take-two', etc.
            $table->timestamps();

            $table->unique(['user_id', 'card_id', 'format']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
