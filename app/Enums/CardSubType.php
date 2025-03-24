<?php

namespace App\Enums;

enum CardSubType: string
{
    case Evolved = 'Evolved';
    case Token = 'Token';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
