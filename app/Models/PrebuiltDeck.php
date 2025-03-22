<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PrebuiltDeck extends Model
{
    /** @use HasFactory<\Database\Factories\PrebuiltDeckFactory> */
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
        'class_id',
        'release_date',
        'image_url',
        'deck_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_date' => 'date',
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
     * Get the craft this prebuilt deck belongs to.
     */
    public function craft(): BelongsTo
    {
        return $this->belongsTo(Craft::class, 'class_id');
    }

    /**
     * Get the cards in this prebuilt deck.
     */
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'prebuilt_deck_cards')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
