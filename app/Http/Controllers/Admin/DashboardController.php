<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show dashboard.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Dashboard', ["authUser" => Auth::user()]);
    }
}
