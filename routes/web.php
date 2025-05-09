<?php

use App\Http\Controllers\PageController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Artisan;

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'storeFront')->name('storeFront');
});

Route::get('/run-storage-link', function () {
    try {
        Artisan::call('storage:link');
        return response()->json(['message' => 'Storage linked successfully!'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
