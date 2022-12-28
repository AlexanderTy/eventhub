<?php

namespace App\Enums;

use App\Enums\Traits\Listable;

enum UserRole: string
{
    use Listable;

    case USER = 'user';
    case EDITOR = 'editor';
    case ADMIN = 'admin';

    public function name(): string
    {
        return match ($this) {
            UserRole::USER => 'User',
            UserRole::EDITOR => 'Editor',
            UserRole::ADMIN => 'Admin',
        };
    }


}

