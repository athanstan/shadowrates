<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    /** @use HasFactory<\Database\Factories\CardFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'effect',
        'evolved_effect',
        'card_type_id',
        'craft_id',
        'card_set_id',
        'cost',
        'rarity',
        'image_url',
        'evolved_image_url',
        'attack',
        'defense',
        'evolved_attack',
        'evolved_defense',
        'is_token',
        'is_basic',
        'is_neutral',
        'is_active',
        'original_card_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cost' => 'integer',
        'attack' => 'integer',
        'defense' => 'integer',
        'evolved_attack' => 'integer',
        'evolved_defense' => 'integer',
        'is_token' => 'boolean',
        'is_basic' => 'boolean',
        'is_neutral' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the decks that include this card.
     */
    public function decks(): BelongsToMany
    {
        return $this->belongsToMany(Deck::class, 'deck_cards')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Get the prebuilt decks that include this card.
     */
    public function prebuiltDecks(): BelongsToMany
    {
        return $this->belongsToMany(PrebuiltDeck::class, 'prebuilt_deck_cards')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Get the ratings for this card.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get the card set this card belongs to.
     */
    public function cardSet(): BelongsTo
    {
        return $this->belongsTo(CardSet::class);
    }

    /**
     * Get the type of this card.
     */
    public function cardType(): BelongsTo
    {
        return $this->belongsTo(CardType::class);
    }

    /**
     * Get the craft/class this card belongs to.
     */
    public function craft(): BelongsTo
    {
        return $this->belongsTo(Craft::class);
    }

    /**
     * Get the collections (user cards) of this card.
     */
    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    /**
     * Get the original card if this is an alternate art.
     */
    public function originalCard(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'original_card_id');
    }

    /**
     * Get alternate arts of this card.
     */
    public function alternateArts(): HasMany
    {
        return $this->hasMany(Card::class, 'original_card_id');
    }

    /**
     * Calculate the average rating for this card.
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->ratings()->avg('rating_value') ?? 0.0;
    }

    /**
     * Scope a query to only include active cards.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include cards of a specific craft.
     */
    public function scopeByCraft($query, $craftId)
    {
        return $query->where('craft_id', $craftId);
    }

    /**
     * Scope a query to only include cards of a specific type.
     */
    public function scopeByType($query, $typeId)
    {
        return $query->where('card_type_id', $typeId);
    }

    /**
     * Scope a query to only include cards of a specific set.
     */
    public function scopeBySet($query, $setId)
    {
        return $query->where('card_set_id', $setId);
    }
}
