<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrebuiltDeckCard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'prebuilt_deck_id',
        'card_id',
        'quantity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Get the prebuilt deck that owns the card.
     */
    public function prebuiltDeck(): BelongsTo
    {
        return $this->belongsTo(PrebuiltDeck::class);
    }

    /**
     * Get the card in the prebuilt deck.
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
