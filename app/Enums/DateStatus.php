<?php

namespace App\Enums;

use App\Enums\Traits\Listable;

enum DateStatus: string
{
    use Listable;

    case AVAILABLE = 'available';
    case PREMIER = 'premiere';
    case PREVIEW = 'forpremiere';
    case EXTRA = 'ekstra';
    case FEW = 'Få pladser';
    case SOLDOUT = 'udsolgt';


    public function name()
    {
        return match ($this) {
            DateStatus::AVAILABLE => 'Available',
            DateStatus::PREMIER => 'Premiere',
            DateStatus::PREVIEW => 'Forpremiere',
            DateStatus::EXTRA => 'Ekstra',
            DateStatus::FEW => 'Få pladser',
            DateStatus::SOLDOUT => 'Udsolgt',
        };
    }


}

