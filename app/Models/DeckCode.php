<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeckCode extends Model
{
    /** @use HasFactory<\Database\Factories\DeckCodeFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'deck_id',
        'version',
        'is_valid',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'version' => 'integer',
        'is_valid' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * Get the deck this code belongs to.
     */
    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }

    /**
     * Generate a unique deck code.
     */
    public static function generateCode(): string
    {
        // Implementation for encoding deck to a shareable code string
        // Typically uses base64 encoding or similar approach
        return bin2hex(random_bytes(8));
    }

    /**
     * Parse a deck code string into a deck structure.
     */
    public static function parseCode(string $code): ?array
    {
        // Implementation for decoding a deck code string back into a deck structure
        // Returns null if invalid code
        return null; // Placeholder - real implementation would decode the string
    }
}
