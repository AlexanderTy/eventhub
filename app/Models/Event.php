<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property string|null $permalink
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Date[] $dates
 * @property-read int|null $dates_count
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePermalink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSeoTitle($value)
 */

class Event extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'sub_title',
        'sale_start',
        'sale_end',
        'public',
        'permalink',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
        'public' => 'boolean',
    ];

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'artist_event')->withTimestamps();
    }
    public function dates(): HasMany
    {
        return $this->hasMany(Date::class);
    }
}
