<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category_Controller;


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

// Category Route
Route::get("/category",[Category_Controller::class,"get_all_categories"]);
Route::get("/category/{cat_id}",[Category_Controller::class,"get_category_detail"]);
Route::post("/category",[Category_Controller::class,"create_category"]);
Route::patch("/category/{cat_id}",[Category_Controller::class,"update_category"]);
Route::delete("/category/{cat_id}",[Category_Controller::class,"delete_category"]);

// Route::get("/product",[Product_Controller::class,"get_products"]);
// Route::get("/product/{product_id}",[Product_Controller::class,"product_details"]);
// Route::get("/product/search/{name}",[Product_Controller::class,"search"]);

// Route::post("/product",[Product_Controller::class,"create_product"]);

// Route::patch("/product/{product_id}",[Product_Controller::class,"update_product"]);

// Route::delete("product/{product_id}",[Product_Controller::class,"delete_product"]);
