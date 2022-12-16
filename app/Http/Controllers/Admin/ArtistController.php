<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArtistRequest;
use App\Http\Requests\Admin\UpdateArtistRequest;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        return redirect()->route('admin::artists.edit', [
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
            $imageName = str_replace(' ', '_', $artist->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images/artists/', $image, $imageName);
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
     * @return void
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
