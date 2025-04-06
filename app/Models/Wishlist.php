<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Wishlist extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'is_public',
        'deck_id',
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
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    /**
     * Get the user that owns the wishlist.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the deck associated with this wishlist, if any.
     */
    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }

    /**
     * Get the cards in this wishlist.
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class)
            ->withPivot(['quantity'])
            ->withTimestamps()
            ->as('wishlist_item');
    }
}
