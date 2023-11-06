<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product_Model;
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

Route::get("/product",[Product_Controller::class,"get_products"]);
Route::get("/product/{product_id}",[Product_Controller::class,"product_details"]);
Route::get("/product/search/{name}",[Product_Controller::class,"search"]);

Route::post("/product",[Product_Controller::class,"create_product"]);

Route::patch("/product/{product_id}",[Product_Controller::class,"update_product"]);

Route::delete("product/{product_id}",[Product_Controller::class,"delete_product"]);
