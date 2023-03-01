<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * SearchType enum.
 */
enum SearchType: string
{
    case IMAGE = 'image';

    public function label(): string
    {
        return match ($this) {
            self::IMAGE => '画像',
        };
    }
}
