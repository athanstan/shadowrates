<?php

namespace App\Enums;

enum Rarity: string
{
    case BRONZE = 'Bronze';
    case SILVER = 'Silver';
    case GOLD = 'Gold';
    case LEGENDARY = 'Legendary';

    /**
     * Get the background CSS class for this rarity
     */
    public function background(): string
    {
        return match ($this) {
            self::BRONZE => 'bg-gradient-to-r from-amber-800 to-amber-600',
            self::SILVER => 'bg-gradient-to-r from-gray-400 to-gray-300',
            self::GOLD => 'bg-gradient-to-r from-yellow-600 to-yellow-400',
            self::LEGENDARY => 'bg-gradient-to-r from-red-700 to-red-500',
        };
    }

    /**
     * Get all available rarities as an array
     */
    public static function toArray(): array
    {
        return array_map(
            fn(self $rarity) => [
                'value' => $rarity->value,
                'background' => $rarity->background(),
            ],
            self::cases()
        );
    }

    /**
     * Get all rarity values as a simple array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
