<?php

use App\Http\Controllers\Home\PageController;

Route::group([
    'as' => 'home::',
], function () {

    Route::get('{slug}', [PageController::class, 'show'])->name('page.show');

});
