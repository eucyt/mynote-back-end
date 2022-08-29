<?php

use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/notes/{published_id}', [NoteController::class, 'showPublished'])->name('notes.published')
    // uuid validation
    ->where('published_id', '([0-9a-f]{8})-([0-9a-f]{4})-([0-9a-f]{4})-([0-9a-f]{4})-([0-9a-f]{12})');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('notes')->group(function () {
        Route::put('/{id}/publish', [NoteController::class, 'publish'])->name('notes.publish')
            ->where('id', '[0-9]*');
        Route::put('/{id}/unpublish', [NoteController::class, 'unpublish'])->name('notes.unpublish')
            ->where('id', '[0-9]*');
    });
    Route::apiResource('notes', NoteController::class);
});
