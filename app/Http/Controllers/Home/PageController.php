<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Slug;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slugPath)
    {
        $slug = Slug::where('slug', $slugPath)->with('sluggable')->firstOrFail();
        $sluggable = $slug->sluggable;

        return match (get_class($sluggable)) {

            'App\Models\Event' => $this->event($sluggable),

            default => abort(404),
        };
    }
    protected function event(Event $event)
    {
        return view('home.pages.event', [
            'event' => $event,
        ]);
    }
}
