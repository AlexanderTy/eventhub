<?php

namespace App\Http\Controllers;

use App\Enums\Country;
use App\Enums\UserRole;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\Venue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $venues = Venue::latest()->orderBy('id', 'DESC')->get();
        return Inertia::render(
            'Venue/Index',
            [
                'venues' => $venues,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(Venue $venue): \Inertia\Response
    {
        return Inertia::render(
            'Venue/Edit',
            [
                "venue" => $venue,
                'countries' => Country::list(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateVenueRequest $request
     * @return \Inertia\Response|RedirectResponse
     */
    public function update(UpdateVenueRequest $request, Venue $venue):  \Inertia\Response|RedirectResponse
    {
        $venue->update($request->validated());
        return redirect()->route('venues.index')->with('success', "Successfully updated venue $venue->name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
