<?php

namespace App\Traits;

use App\Models\Slug;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Sluggable
{
    public function slug(): MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable');
    }
    public function updateOrCreateSlug($slugName, $metaTitle = null, $metaDescription = null): void
    {
        $slug = $this->slug()->firstOrNew();
        $slug->slug = Slug::generateUniqueSlug($slugName, $slug->slug);
        $slug->meta_title = $metaTitle;
        $slug->meta_description = $metaDescription;
        $slug->save();
    }
}
