<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PaymentController;

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

Route::prefix("conta")->group(function() {
    Route::post("/", [AccountController::class, "store"]);
    Route::get("/", [AccountController::class, "show"]);
});

Route::prefix("transacao")->group(function() {
    Route::post("/", [PaymentController::class, "store"]);
});

