<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'sale_start' => 'date:d M Y',
        'sale_end' => 'date:d M Y',
        'public' => 'boolean',
    ];
}
