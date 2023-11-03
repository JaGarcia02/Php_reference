<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\User_Controller;

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

/*
|--------------------------------------------------------------------------
| Product Route
|--------------------------------------------------------------------------
*/
Route::get("/product",[Product_Controller::class,"index"]);
Route::get("/product/search/{name}",[Product_Controller::class,"search"]);


/*
|--------------------------------------------------------------------------
| User Route
|--------------------------------------------------------------------------
*/
Route::post("/register",[User_Controller::class,"register"]);
Route::post("/login",[User_Controller::class,"login"]);


/*
|--------------------------------------------------------------------------
| Protected Product Routes 
|--------------------------------------------------------------------------
*/
Route::group(["middleware"=>["auth:sanctum"]],function(){
    
    Route::post("/product",[Product_Controller::class,"store"]);
    Route::get("/product/{id}",[Product_Controller::class,"show"]);
    Route::patch("/product/{id}",[Product_Controller::class,"update"]);
    Route::delete("/product/{id}",[Product_Controller::class,"destroy"]);

});


/*
|--------------------------------------------------------------------------
| Protected User Routes 
|--------------------------------------------------------------------------
// */
Route::group(["middleware"=>["auth:sanctum"]],function(){

    Route::post("/logout",[User_Controller::class,"logout"]);
  

});

