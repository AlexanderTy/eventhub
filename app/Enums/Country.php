<?php

namespace App\Enums;
use App\Enums\Traits\Listable;

enum Country: string
{
    use Listable;

    case DENMARK = 'denmark';
    case SWEDEN = 'sweden';
    case NORWAY = 'norway';


    public function name()
    {
        return match ($this) {
            Country::DENMARK => 'Denmark',
            Country::SWEDEN => 'Sweden',
            Country::NORWAY => 'Norway',
        };
    }


}

