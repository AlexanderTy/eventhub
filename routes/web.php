<?php

use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/admin', '/admin/login');

require __DIR__.'/web.home.php';
require __DIR__.'/web.admin.php';
