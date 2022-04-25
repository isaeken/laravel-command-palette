<?php

use Illuminate\Support\Facades\Route;
use IsaEken\LaravelCommandPalette\Controllers\AssetController;

Route::name('command-palette.web.')->prefix('/_command-palette/web')->group(function () {
    Route::prefix('/assets')->name('assets.')->group(function () {
        Route::get('app.css', [AssetController::class, 'css'])->name('css');
        Route::get('app.js', [AssetController::class, 'js'])->name('js');
    });
});
