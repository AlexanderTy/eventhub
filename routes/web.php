<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => [HandleInertiaRequests::class],
], function () {

    Route::get('/', function () {
        return redirect('login');
    });

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');

    Route::group([
        'middleware' => [Authenticate::class],
    ], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

        Route::resource('users', UserController::class)->except('show');
        Route::resource('events', EventController::class);
        Route::resource('artists', ArtistController::class);
        Route::resource('venues', VenueController::class);

        Route::get('artists-search', [ArtistController::class, 'search'])->name('artists.search');
        Route::get('venues-search', [VenueController::class, 'search'])->name('venues.search');

        /*        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');*/
    });
});
