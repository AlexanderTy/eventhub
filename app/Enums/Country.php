<?php

namespace App\Enums;

use App\Enums\Traits\Listable;

enum Country: string
{
    use Listable;

    case DENMARK = 'DK';
    case SWEDEN = 'SE';
    case NORWAY = 'NO';

    public function name(): string
    {
        return match ($this) {
            Country::DENMARK => 'Denmark',
            Country::SWEDEN => 'Sweden',
            Country::NORWAY => 'Norway',
        };
    }
}

