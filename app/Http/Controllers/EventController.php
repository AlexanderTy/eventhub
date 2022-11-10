<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\CreateUserRequest;
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
    public function index(): Response
    {
        $events = Event::latest()->get();
        $eventCount = $events->count();
        return Inertia::render(
            'Event/Index',
            [
                "events"     => $events,
                "eventCount" => $eventCount,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
        return Inertia::render(
            'Event/Create',
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(CreateEventRequest $request)
    {
        $event = Event::create($request->validated());
        return redirect()->route('events.edit', [
            'event'=>$event
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
    public function edit(Event $event)
    {

        return Inertia::render(
            'Event/Edit',
            [
                "event"     => $event,
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
    public function update(Request $request, $id)
    {
        //
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
