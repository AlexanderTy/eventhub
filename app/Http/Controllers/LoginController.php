<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateLoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Login', [
            "message" => "yo",
        ]);
    }

    public function authenticate(AuthenticateLoginRequest $request): RedirectResponse
    {

        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
