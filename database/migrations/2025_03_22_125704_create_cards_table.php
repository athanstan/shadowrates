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
        Schema::dropIfExists('cards');

        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('effect')->nullable();
            $table->text('evolved_effect')->nullable();

            // Foreign keys
            $table->foreignId('card_type_id')->constrained('card_types');
            $table->foreignId('craft_id')->constrained('crafts');
            $table->foreignId('card_set_id')->constrained('card_sets');

            // Card attributes
            $table->integer('cost');
            $table->string('rarity');
            $table->string('image')->nullable();
            $table->string('evolved_image')->nullable();

            // Follower stats (nullable for spells and amulets)
            $table->integer('attack')->nullable();
            $table->integer('defense')->nullable();
            $table->integer('evolved_attack')->nullable();
            $table->integer('evolved_defense')->nullable();

            // Card metadata
            $table->boolean('is_token')->default(false);
            $table->boolean('is_basic')->default(false);
            $table->boolean('is_neutral')->default(false);
            $table->boolean('is_active')->default(true);

            // If this is an alternate art version, reference the original card
            $table->string('original_card_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
