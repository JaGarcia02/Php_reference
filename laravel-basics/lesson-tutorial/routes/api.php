<?php

use App\Http\Controllers\API\StudentController;
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


// Students API (this is only in youtube tutorail where this is the structure of Laravel routes)
Route::get("students",[StudentController::class,"index"]);
Route::post("students",[StudentController::class,"store"]);
Route::get("students/{id}",[StudentController::class,"show"]);
Route::get("students/{id}/edit",[StudentController::class,"edit"]);
Route::put("students/{id}/update",[StudentController::class,"update"]);
Route::delete("students/{id}/delete",[StudentController::class,"destroy"]);