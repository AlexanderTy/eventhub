<?php

namespace App\Enums\Traits;

trait Listable
{
    public static function list(): array
    {
        return collect(static::cases())
            ->mapWithKeys(function ($item) {
                return [$item->value => $item->name()];
            })
            ->toArray();
    }
}
