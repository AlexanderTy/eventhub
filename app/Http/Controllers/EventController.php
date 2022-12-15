<?php

namespace App\Http\Controllers;

use App\Enums\DateStatus;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Date;
use App\Models\Event;
use App\Models\Venue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $query = Event::query();
        if (!empty($request->search)) {
            $query
                ->where(function ($query) use ($request) {
                    $query
                        ->where('title', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('sub_title', 'LIKE', '%' . $request->search . '%');
                });
        }

        if (!empty($request->filter)) {
            $query->where($request->filter, true);
        }

        $events = $query->with('artists')->get();

        return Inertia::render(
            'Event/Index',
            [
                "events"  => $events,
                'request' => $request,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return RedirectResponse
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {

        $event = Event::create($request->validated());

        $event->updateOrCreateSlug($event->title);

        return redirect()->route('events.edit', [
            'event' => $event
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return Response
     */
    public function show(Event $event): Response
    {
        $event->load(
            [
                'dates' => fn($query) => $query->with('venue'),
                'artists'
            ]);

        return Inertia::render(
            'Event/Show',
            [
                "event" => $event,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Response
     */
    public function edit(Event $event, Request $request): Response
    {
        $event->load([
            'dates' => fn($query) => $query->with('venue'),
            'artists',
            'slug',
        ]);
        $venueOptions = Venue::all();
        return Inertia::render(
            'Event/Edit',
            [
                "event"        => $event,
                'request'      => $request,
                "dateStatus"   => DateStatus::list(),
                "venueOptions" => $venueOptions,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event): \Inertia\Response|RedirectResponse
    {
        $event->update([
            'title'      => $request->title,
            'sub_title'  => $request->sub_title,
            'sale_start' => $request->sale_start_date . ' ' . $request->sale_start_time,
            'sale_end'   => $request->sale_end_date . ' ' . $request->sale_end_time,
        ]);

        $event->updateOrCreateSlug($request->slug ?? $request->title, $request->meta_title, $request->meta_description);

        //save events->artists
        $event->artists()->sync($request->artists);

        $dates = $event->dates;
        $items = [];
        $now = now();

        foreach ($request->dates as $item) {

            $item = (object)$item;
            $date = null;

            if (!($item->is_new ?? false)) {
                $date = $dates->firstWhere('id', $item->id);
            }

            if (!$date) {
                $date = new Date;
            }

            $date->fill([
                'venue_id' => $item->venue_id,
                'status'   => $item->status,
                'label'    => $item->label,
                'note'    => $item->note,

            ]);

            $date->updateTimestamps();
            $items[] = $date;
        }
        $event->dates()->saveMany($items);

        $event->dates()->where('updated_at', '<', $now)->delete();


        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
