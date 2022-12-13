<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
                "artists" => $artists,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArtistRequest $request
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Artist $artist
     * @return Response
     */
    public function show(Artist $artist): Response
    {
        $artist->load(['events']);

        return Inertia::render(
            'Artist/Show',
            [
                "artist" => $artist,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Artist $artist
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
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtistRequest $request, Artist $artist): \Inertia\Response|RedirectResponse
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //get the name of the image
            $imageName = str_replace(' ', '_', $artist->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            //move the image to the public folder
            $image->move(public_path('images/artists'), $imageName);
            //set the image name to the image name
            $artist->image = $imageName;
            $artist->update(array_merge($request->validated(), ['image' => $imageName]));

        } else {
            $artist->update($request->validated());
        }


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

    /**
     * Search artists and return array.
     *
     * @param Request $request
     * @return Artist[]|Builder[]|Collection
     */
    public function search(Request $request): Collection|array
    {
        return Artist::query()
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->get();
    }
}
