<?php

namespace App\Models;

use App\Enums\DateStatus;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Date
 *
 * @property int $id
 * @property string $release_date
 * @property string $venue
 * @property string $city
 * @property string $country
 * @property string $latitude
 * @property string $longitude
 * @property \App\Models\Event|null $date
 * @property string $duration
 * @property string $status
 * @property string $label
 * @property string $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $event_id
 * @method static \Illuminate\Database\Eloquent\Builder|Date newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Date newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Date query()
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereVenue($value)
 * @mixin \Eloquent
 * @property int|null $venue_id
 * @property-read \App\Models\Event|null $event
 * @method static \Illuminate\Database\Eloquent\Builder|Date whereVenueId($value)
 */
class Date extends Model
{
    use HasFactory;

    protected $fillable = [
        'release_date',
        'date',
        'duration',
        'status',
        'label',
        'note',
    ];
    protected $casts = [
        'status'=> DateStatus::class,
    ];


    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }
}

