<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DragonController;
use App\Http\Controllers\ColorController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/register", [AuthController::class, "signUp"]);
Route::post("/login", [AuthController::class, "signIn"]);
//tokent küldünk,azért post
Route::post("/logout", [AuthController::class, "logOut"]);
Route::post("/DargonStore",[DragonController::class,"store"]);
Route::get("/indexDragon",[DragonController::class,"index"]);
Route::get("/indexColor",[ColorController::class,"index"]);
Route::put("/color/{id}",[ColorController::class,"update"]);
Route::put("/dragon/{id}",[DragonController::class,"update"]);
Route::post("/colorStore",[ColorController::class,"store"]);