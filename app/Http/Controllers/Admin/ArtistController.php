<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArtistRequest;
use App\Http\Requests\Admin\UpdateArtistRequest;
use App\Models\Artist;
use App\Models\Event;
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
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $query = Artist::query();

        if (!empty($request->search)) {
            $query
                ->where(function ($query) use ($request) {
                    $query
                        ->where('name', 'LIKE', '%' . $request->search . '%');
                });
        }

        if (!empty($request->sortOption)) {
            $query->orderBy($request->sortOption, $request->order);
        }

        $artists = $query->with('events')->get();

        return Inertia::render(
            'Artist/Index',
            [
                "artists" => $artists,
                "request" => $request,
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
        $artist = Artist::create($request->validated());

        return redirect()->route('admin::artists.edit', [
            'artist' => $artist,
        ])->with('success', "Artist $artist->name created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param Artist $artist
     * @return Response
     */
    public function show(Artist $artist): Response
    {
        $artist->load([
            'events' => fn($query) => $query->with('dates')->get(),
        ]);

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
     * @param UpdateArtistRequest $request
     * @param Artist $artist
     * @return Response|RedirectResponse
     */
    public function update(UpdateArtistRequest $request, Artist $artist): Response|RedirectResponse
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = str_replace(' ', '_', $artist->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images/artists/', $image, $imageName);
            $artist->update(array_merge($request->validated(), ['image' => $imageName]));
        } else {
            $artist->update($request->validated());
        }

        return redirect()->back()->with('success', "Artist $artist->name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Artist $artist
     * @return RedirectResponse
     */
    public function destroy(Artist $artist): RedirectResponse
    {
        $artist->delete();
        return redirect()->route('admin::artists.index');
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
