<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Models\Artist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $artists = Artist::latest()->get();
        return Inertia::render(
            'Artist/Index',
            [
                "artists"     => $artists,
            ]
        );    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreArtistRequest $request
     * @return RedirectResponse
     */
    public function store(StoreArtistRequest $request): RedirectResponse
    {
        $artist = Artist::create($request->validate());
        return redirect()->route('artists.edit', [
            'artist' => $artist,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Artist  $artist
     * @return Response
     */
    public function show(Artist $artist): Response
    {
        $artist->load(['events']);

        return  Inertia::render(
            'Artist/Show',
            [
                "artist" => $artist,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Artist $artist
     * @return Response
     */
    public function edit(Artist $artist): Response
    {
        return Inertia::render(
            'Artist/Edit',
            [
                "artist" => $artist,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtistRequest $request, Artist $artist): \Inertia\Response |RedirectResponse
    {
        $artist->update(
            $request->validated()
        );
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Search artists and return array.
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        return Artist::query()
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->get();
    }
}
