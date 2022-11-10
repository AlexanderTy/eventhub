<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $title
 * @property string $sub_title
 * @property \Illuminate\Support\Carbon $sale_start
 * @property \Illuminate\Support\Carbon $sale_end
 * @property bool $public
 * @property string $artist
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereArtist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSaleEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSaleStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Artist[] $artists
 * @property-read int|null $artists_count
 */

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
        'public' => 'boolean',
    ];

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'artist_event')->withTimestamps();
    }
}
