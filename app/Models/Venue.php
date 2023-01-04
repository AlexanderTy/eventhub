<?php

namespace App\Models;

use App\Enums\Country;
use App\Enums\DateStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Venue
 *
 * @property int $id
 * @property string $venue
 * @property string $zipcode
 * @property string $city
 * @property string $country
 * @property string|null $latitude
 * @property string|null $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Venue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Venue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Venue query()
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereVenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereZipcode($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereName($value)
 * @property string|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Date[] $dates
 * @property-read int|null $dates_count
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereAddress($value)
 */

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'zipcode',
        'city',
        'country',
        'public',
        'latitude',
        'longitude',
    ];
    protected $casts = [
        'country'=> Country::class,
    ];

    public function calculateCoordinates()
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($this->zipcode . ' ' . $this->city . ' ' . $this->country) . '&key=' . config('integrations.google.geocoding_api_key');
        $data = Http::acceptJson()
            ->get($url)
            ->object();

        $this->latitude = $data->results[0]->geometry->location->lat;
        $this->longitude = $data->results[0]->geometry->location->lng;
        $this->save();
    }

  /*  protected static function boot()
    {
        parent::boot();

        static::updating(function (Venue $venue) {
            if ($venue->isDirty(['address', 'zipcode', 'city', 'country'])) {
                $venue->calculateCoordinates();
            }
        });
    }*/

    public function dates(): HasMany
    {
        return $this->hasMany(Date::class);
    }

}
