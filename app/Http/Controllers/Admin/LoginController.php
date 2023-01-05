<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthenticateLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function index(): RedirectResponse|Response
    {
        if (Auth::check()) {
            return redirect()->route('admin::dashboard');
        }

        return Inertia::render('Login');
    }

    public function authenticate(AuthenticateLoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()->route('admin::events.index');
        }

        return back()->withErrors([
            'password' => 'The provided credentials do not match our records.',
        ])->onlyInput('password');
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('admin::login');
    }

}
