<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\AuthenticateLoginRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
    public function index(): \Inertia\Response
    {
        $authUser = Auth::user();
        $users = User::latest()->get();
        return Inertia::render(
            'User/Index',
            [
                "users"    => $users,
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $authUser = Auth::user();
        $users = User::latest()->get();
        return Inertia::render(
            'User/Create',
            [
                "roles" => UserRole::list(),
            ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {

        User::create($request->validated());
        return redirect()->route('users.index');
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
                "user" => $user,
                "roles" => UserRole::list(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return \Inertia\Response|RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): \Inertia\Response |RedirectResponse
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
        return redirect()->route('users.index');
    }
}
