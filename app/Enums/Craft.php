<?php

namespace App\Enums;

enum Craft: string
{
    case FORESTCRAFT = 'forestcraft';
    case SWORDCRAFT = 'swordcraft';
    case RUNECRAFT = 'runecraft';
    case DRAGONCRAFT = 'dragoncraft';
    case ABYSSCRAFT = 'abysscraft';
    case HAVENCRAFT = 'havencraft';
    case NEUTRAL = 'neutral';
    case UMAMUSUME = 'umamusume';
    case IDOLMASTER_CINDERELLA = 'idolmaster_cinderella';
    case CF_VANGUARD = 'cf_vanguard';

    /**
     * Get the display name for the craft
     */
    public function name(): string
    {
        return match ($this) {
            self::FORESTCRAFT => 'Forestcraft',
            self::SWORDCRAFT => 'Swordcraft',
            self::RUNECRAFT => 'Runecraft',
            self::DRAGONCRAFT => 'Dragoncraft',
            self::ABYSSCRAFT => 'Abysscraft',
            self::HAVENCRAFT => 'Havencraft',
            self::NEUTRAL => 'Neutral',
            self::UMAMUSUME => 'Umamusume',
            self::IDOLMASTER_CINDERELLA => 'Idolmaster Cinderella',
            self::CF_VANGUARD => 'CF Vanguard',
        };
    }

    /**
     * Get the background CSS class for this craft
     */
    public function background(): string
    {
        return match ($this) {
            self::FORESTCRAFT => 'bg-[#4CAF50]',
            self::SWORDCRAFT => 'bg-[#FFC107]',
            self::RUNECRAFT => 'bg-[#a35bae]',
            self::DRAGONCRAFT => 'bg-[#c1432e]',
            self::ABYSSCRAFT => 'bg-[#53565a]',
            self::HAVENCRAFT => 'bg-[#d9a93e]',
            self::NEUTRAL => 'bg-[#8e262d]',
            self::UMAMUSUME => 'bg-[#7e57c2]',
            self::IDOLMASTER_CINDERELLA => 'bg-[#7e57c2]',
            self::CF_VANGUARD => 'bg-[#7e57c2]',
        };
    }

    /**
     * Get all available crafts as an array
     */
    public static function toArray(): array
    {
        return array_map(
            fn(self $craft) => [
                'value' => $craft->value,
                'name' => $craft->name(),
                'background' => $craft->background(),
            ],
            self::cases()
        );
    }
}
