<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ListItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/items/list', [ListItemController::class, 'list']);

Route::middleware('auth:api')
    ->prefix('/item')
    ->group(function () {
        Route::get('/add', [ListItemController::class, 'add']);
        Route::get('/delete', [ListItemController::class, 'delete']);
        Route::get('/mark-complete', [
            ListItemController::class,
            'markAsComplete',
        ]);
    });

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name(
    'google-auth'
);

Route::get('auth/google/call-back', [GoogleAuthController::class, 'callback']);
