<?php

namespace App\Enums;

use App\Enums\Traits\Listable;

enum DateStatus: string
{
    use Listable;

    case AVAILABLE = 'available';
    case PREMIER = 'premier';
    case PREVIEW = 'preview';
    case EXTRA = 'extra';
    case FEW = 'few tickets';
    case SOLDOUT = 'sold out';


    public function name()
    {
        return match ($this) {
            DateStatus::AVAILABLE => 'Available',
            DateStatus::PREMIER => 'Premier',
            DateStatus::PREVIEW => 'Preview',
            DateStatus::EXTRA => 'Extra',
            DateStatus::FEW => 'Few tickets',
            DateStatus::SOLDOUT => 'Sold out',
        };
    }


}

