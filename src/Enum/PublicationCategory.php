<?php

namespace App\Enum;

enum PublicationCategory: string
{
    case DATA_SCIENCE = 'Data Science';
    case WEB = 'Web Development';
    case MOBILE = 'Mobile Development';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }
}
