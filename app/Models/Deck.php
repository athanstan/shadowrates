<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Deck extends Model
{
    /** @use HasFactory<\Database\Factories\DeckFactory> */
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'user_id',
        'craft_id',        // References Craft model
        'is_public',
        'format',          // e.g., 'rotation', 'unlimited'
        'thumbnail_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the user that owns the deck.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the craft/class this deck belongs to.
     */
    public function craft(): BelongsTo
    {
        return $this->belongsTo(Craft::class);
    }

    /**
     * Get the cards in this deck.
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'deck_cards')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Get the deck code for this deck.
     */
    public function deckCode(): HasOne
    {
        return $this->hasOne(DeckCode::class)->latestOfMany();
    }

    /**
     * Get all deck codes for this deck.
     */
    public function deckCodes(): HasMany
    {
        return $this->hasMany(DeckCode::class);
    }

    /**
     * Get the ratings for this deck.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Calculate the average rating for this deck.
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->ratings()->avg('rating_value') ?? 0.0;
    }

    /**
     * Get the total card count in this deck.
     */
    public function getCardCountAttribute(): int
    {
        return $this->cards()->sum('quantity');
    }
}
