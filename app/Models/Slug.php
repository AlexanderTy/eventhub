<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

/**
 * App\Models\Slug
 *
 * @property int $id
 * @property string $sluggable_type
 * @property int $sluggable_id
 * @property string $slug
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $sluggable
 * @method static \Illuminate\Database\Eloquent\Builder|Slug newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slug newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slug query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereSluggableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereSluggableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class Slug extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'meta_title',
        'meta_description',
    ];

    public function sluggable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function generateUniqueSlug( $slug, $current = '' )
    {
        $slug = Str::slug($slug, '-', 'da');

        if ($slug === $current || !self::checkIfSlugExists($slug)) {
            return $slug;
        }

        $n = 0;

        do {
            $n++;
            $newSlug = "{$slug}-{$n}";
        } while (self::checkIfSlugExists($newSlug) && $newSlug != $current);

        return $newSlug;
    }

    public static function checkIfSlugExists($slug): bool
    {
        return Slug::query()
            ->where('slug', $slug)
            ->exists();
    }
}
