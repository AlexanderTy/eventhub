<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $this->middleware('auth');

        return Inertia::render('Dashboard', ["authUser" => Auth::user()]);
    }
}
