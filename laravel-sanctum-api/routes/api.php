<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product_Controller;

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

Route::get("/product",[Product_Controller::class,"index"]);

Route::post("/product",[Product_Controller::class,"store"]);

Route::get("/product/{id}",[Product_Controller::class,"show"]);

Route::patch("/product/{id}",[Product_Controller::class,"update"]);

Route::delete("/product/{id}",[Product_Controller::class,"destroy"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
