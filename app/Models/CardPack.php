<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CardPack extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'card_set_id',
        'price',           // In-game currency cost
        'card_count',      // How many cards in the pack
        'guaranteed_rarity',  // Minimum guaranteed rarity
        'description',
        'image_url',
        'available_from',
        'available_until',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'integer',
        'card_count' => 'integer',
        'available_from' => 'datetime',
        'available_until' => 'datetime',
    ];

    /**
     * Get the card set this pack belongs to.
     */
    public function cardSet(): BelongsTo
    {
        return $this->belongsTo(CardSet::class);
    }
}
