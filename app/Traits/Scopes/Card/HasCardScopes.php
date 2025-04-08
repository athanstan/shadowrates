<?php

namespace App\Traits\Scopes\Card;

trait HasCardScopes
{
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

    public function scopeWithBaseRelations($query)
    {
        return $query->with([
            'cardType',
            'cardSet',
            'craft'
        ]);
    }
}
