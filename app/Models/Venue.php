<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'zipcode',
        'city',
        'country',
        'public',
        'latitude',
        'longitude',
    ];


}
