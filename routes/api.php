<?php

use Illuminate\Support\Facades\Route;
use IsaEken\LaravelCommandPalette\Controllers\CommandController;
use IsaEken\LaravelCommandPalette\Controllers\DataController;

Route::name('command-palette.api.')->prefix('/_command-palette/api')->group(function () {
    Route::get('/data', [DataController::class, 'index'])->name('data.index');
    Route::get('/commands', [CommandController::class, 'index'])->name('commands.index');
    Route::post('/commands/{id}', [CommandController::class, 'execute'])->name('commands.execute');
});
