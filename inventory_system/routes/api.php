<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category_Controller;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\Supplier_Controller;
use App\Http\Controllers\Inventory_Controller;


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

// Category Routes
Route::get("/category",[Category_Controller::class,"get_all_categories"]);
Route::get("/category/{cat_id}",[Category_Controller::class,"get_category_detail"]);
Route::post("/category",[Category_Controller::class,"create_category"]);
Route::patch("/category/{cat_id}",[Category_Controller::class,"update_category"]);
Route::delete("/category/{cat_id}",[Category_Controller::class,"delete_category"]);

// Product Routes
Route::get("/product",[Product_Controller::class,"get_products"]);
Route::get("/product/{product_id}",[Product_Controller::class,"product_details"]);
Route::get("/product/search/{product_name}",[Product_Controller::class,"search"]);
Route::post("/product",[Product_Controller::class,"create_product"]);
Route::patch("/product/{product_id}",[Product_Controller::class,"update_product"]);
Route::delete("product/{product_id}",[Product_Controller::class,"delete_product"]);

// Supplier Routes
Route::get("/supplier",[Supplier_Controller::class,"get_all_suppliers"]);
Route::get("/supplier/{supplier_id}",[Supplier_Controller::class,"supplier_details"]);
Route::post("/supplier",[Supplier_Controller::class,"create_supplier"]);
Route::patch("/supplier/{supplier_id}",[Supplier_Controller::class,"update_supplier"]);
Route::delete("/supplier/{supplier_id}",[Supplier_Controller::class,"delete_supplier"]);

// Inventory Routes
Route::get("/inventory",[Inventory_Controller::class,"get_all_inventory"]);
Route::get("/inventory/{inventory_id}",[Inventory_Controller::class,"invenory_details"]);
Route::post("/inventory",[Inventory_Controller::class,"create_inventory"]);
Route::patch("/inventory/{inventory_id}",[Inventory_Controller::class,"update_inventory"]);
Route::delete("/inventory/{inventory_id}",[Inventory_Controller::class,"delete_inventory"]);