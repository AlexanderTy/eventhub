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

            return redirect()->intended('admin::dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('admin::login');
    }

}