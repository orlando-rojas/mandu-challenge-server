<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionsController;

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

Route::group(['middleware' => ['cors']], function () {

    Route::get("divisions", [DivisionsController::class, "index"]);
    Route::post("divisions", [DivisionsController::class, "store"]);

    Route::get("divisions/{id}", [DivisionsController::class, "show"]);
    Route::put("divisions/{id}", [DivisionsController::class, "update"]);
    Route::delete("divisions/{id}", [DivisionsController::class, "destroy"]);

    Route::get("divisions/{id}/subdivisions", [DivisionsController::class, "get_subdivisions"]);
    Route::get("divisions/{id}/subdivisionsCount", [DivisionsController::class, "get_subdivisions_count"]);
});
