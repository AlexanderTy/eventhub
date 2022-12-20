<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Slug;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show page based on slug.
     *
     * @param $slugPath
     * @return View
     */
    public function show($slugPath): View
    {
        $slug = Slug::where('slug', $slugPath)->with('sluggable')->firstOrFail();
        $sluggable = $slug->sluggable;

        return match (get_class($sluggable)) {
            'App\Models\Event' => $this->event($sluggable),
            default => abort(404),
        };
    }

    /**
     * Show page for Event.
     *
     * @param Event $event
     * @return View
     */
    protected function event(Event $event): View
    {
        return view('home.pages.event', [
            'event' => $event,
        ]);
    }
}
