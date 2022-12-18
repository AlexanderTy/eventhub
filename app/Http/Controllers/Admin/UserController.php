<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\UpdateUserSettingsRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{


    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        $query = User::query();
        if (!empty($request->search)) {
            $query
                ->where(function ($query) use ($request) {
                    $query
                        ->where('first_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->search . '%');
                });
        }
        if (!empty($request->sortOption)) {
            $query->orderBy($request->sortOption, $request->order);
        }

        $users = $query->get();



        return Inertia::render(
            'User/Index',
            [
                "users" => $users,
                "request" => $request,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {

        User::create($request->validated());
        return redirect()->route('admin::users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {

        return Inertia::render(
            'User/Create',
            [
                "roles" => UserRole::list(),
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Inertia\Response
     */
    public function edit(User $user): \Inertia\Response
    {
        return Inertia::render(
            'User/Edit',
            [
                "user"  => $user,
                "roles" => UserRole::list(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Inertia\Response|RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): \Inertia\Response|RedirectResponse
    {
        $user->update(
            $request->validated()
        );
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        //

        $user->delete();
        return redirect()->route('admin::users.index');
    }

    public function saveSettings(UpdateUserSettingsRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->settings = $request->validated();
        $user->save();
        return redirect()->back();
    }
}
