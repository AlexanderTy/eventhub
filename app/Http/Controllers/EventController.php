<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Artist;
use App\Models\Event;
use App\Models\User;
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
        return redirect()->route('events.edit', [
            'event' => $event
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return void
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Response
     */
    public function edit(Event $event, Request $request): Response
    {
        $event->load(['dates', 'artists']);

        return Inertia::render(
            'Event/Edit',
            [
                "event" => $event,
                'request' => $request,

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
    public function update(UpdateEventRequest $request, Event $event): \Inertia\Response |RedirectResponse
    {
        $event->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'sale_start' => $request->sale_start_date . ' ' . $request->sale_start_time,
            'sale_end' => $request->sale_end_date . ' ' . $request->sale_end_time,
        ]);
        //save events->artists
        $event->artists()->sync($request->artists);
        //save dates to $event

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
