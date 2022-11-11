<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\AuthController;
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

Route::post('/auth', AuthController::class)->name('login');
Route::middleware(['jwt.verify'])->group(function () {
    Route::apiResource('lead', LeadController::class)
        ->parameter('', 'id')->names('lead')->only([
            'store', 'show'
        ]);
    Route::get('leads', [LeadController::class, 'index'])->name('lead.index');
});
