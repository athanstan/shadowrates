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
            $table->string('original_card_id')->nullable(); // From 'id' in JSON

            // Card attributes from JSON
            $table->string('main_type'); // follower, spell, amulet
            $table->string('sub_type')->nullable(); // evolved, etc.
            $table->text('description')->nullable(); // Maps to flavor_text in some cards
            $table->text('effects')->nullable();
            $table->string('traits')->nullable(); // Natura/Beast etc.
            $table->string('language')->default('en');

            // Foreign keys
            $table->foreignId('card_type_id')->constrained('card_types');
            $table->foreignId('craft_id')->constrained('crafts'); // Maps to clan_id
            $table->foreignId('card_set_id')->constrained('card_sets'); // Maps to expansion_id

            // Card attributes
            $table->integer('cost');
            $table->string('rarity');
            $table->string('image')->nullable();
            $table->string('evolved_image')->nullable();

            // Follower stats (nullable for spells and amulets)
            $table->integer('atk')->nullable(); // Instead of attack
            $table->integer('health')->nullable(); // Instead of defense
            $table->integer('evolved_atk')->nullable(); // For evolved cards
            $table->integer('evolved_health')->nullable(); // For evolved cards

            // Card metadata
            $table->boolean('is_token')->default(false);
            $table->boolean('is_basic')->default(false);
            $table->boolean('is_neutral')->default(false);
            $table->boolean('is_active')->default(true);

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
