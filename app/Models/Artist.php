<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Artist
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @method static \Illuminate\Database\Eloquent\Builder|Artist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $image
 * @property string|null $description_short
 * @property string|null $description_long
 * @property string|null $link_facebook
 * @property string|null $link_youtube
 * @property string|null $link_spotify
 * @property string|null $link_instagram
 * @property string|null $link_website
 * @property string|null $link_press
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereDescriptionLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereDescriptionShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereLinkFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereLinkInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereLinkPress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereLinkSpotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereLinkWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereLinkYoutube($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereSeoTitle($value)
 */
class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description_short',
        'description_long',
        'link_facebook',
        'link_youtube',
        'link_spotify',
        'link_instagram',
        'link_website',
        'link_press',
        'seo_title',
        'seo_description',
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'artist_event')->withTimestamps();
    }
}
