<?php


use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\HandleAdminInertiaRequests;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => [HandleAdminInertiaRequests::class],
    'prefix' => 'admin',
    'as' => 'admin::',
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
        Route::patch('user-save-settings', [UserController::class, 'saveSettings'])->name('user.saveSettings');

    });
});
