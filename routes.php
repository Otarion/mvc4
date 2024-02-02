<?php

use App\Controllers\HelloController;
use MVC\Route;

return [
    Route::get('/', [HelloController::class, 'index']),
    Route::get('/hello/{name}', [HelloController::class, 'hello'], ''),
];
