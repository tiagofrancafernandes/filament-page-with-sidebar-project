<?php

namespace App\CoreLogic\Enums;

use App\CoreLogic\Interfaces\HasColor;

enum LanguageEnum: string implements HasColor
{
    case Portuguese = "pt";

    case English = "en";

    public function label(): string
    {
        return match ($this) {
            self::Portuguese => 'Portuguese',
            self::English => 'English',
            default => 'English'
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Portuguese => ColorEnum::Blue->value,
            self::English => ColorEnum::Indigo->value,
            default => ColorEnum::Indigo->value
        };
    }

    public static function toArray()
    {
        $statuses = [];

        foreach (static::cases() as $status) {
            $statuses[$status->value] = $status->name;
        }

        return $statuses;
    }
}
