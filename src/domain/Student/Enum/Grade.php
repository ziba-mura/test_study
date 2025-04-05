<?php

namespace domain\Student\Enum;

enum Grade: int
{
    case FIRST = 1;
    case SECOND = 2;
    case THIRD = 3;

    public function label(): string
    {
        return match($this) {
            self::FIRST => '1年',
            self::SECOND => '2年',
            self::THIRD => '3年',
        };
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
