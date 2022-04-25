<?php

use Illuminate\Support\Facades\Route;

Route::name('command-palette.api.')->prefix('/_command-palette/api')->group(function () {
    Route::get('/commands')->name('commands');
});