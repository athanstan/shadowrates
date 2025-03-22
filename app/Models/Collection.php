<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collection extends Model
{
    /** @use HasFactory<\Database\Factories\CollectionFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'card_id',
        'quantity',
        'foil_quantity',      // Premium/animated version count
        'liquefied',          // Whether user has liquefied all copies
        'date_acquired',      // When first acquired
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'foil_quantity' => 'integer',
        'liquefied' => 'boolean',
        'date_acquired' => 'datetime',
    ];

    /**
     * Get the user who owns this collection entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the card this collection entry refers to.
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
