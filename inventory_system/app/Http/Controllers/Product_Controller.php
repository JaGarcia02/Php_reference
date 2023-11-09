<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_Model;
use App\Services\PayUService\Exception;

class Product_Controller extends Controller
{
   
    public function get_products()
    {
        try {

            $products = Product_Model::with(["suppliers","categories"])->get();
            $mappedProducts = $products->map(function ($data) {
                return [
                    'id' => $data->id,
                    'product_name' => $data->product_name,
                    'price' => $data->price,
                    'supplier' => $data->suppliers->supplier_name,
                    'category' => $data->categories->category_name,
                ];
            });
       
            return response()->json($mappedProducts,200);

        } catch (\Exception $error) {

            throw $error;
        }
        
    }

   
    public function create_product(Request $request)
    {
        $fields = $request->validate([
            "product_name" => "required|string",
            "price" => "required",
            "cat_id" => "required|string",
            "sup_id" => "required|string",
        ]);

        try {
            $new_product = Product_Model::create([
                'product_name'=>$fields['product_name'],
                'price' => $fields['price'],
                'cat_id' => $fields['cat_id'],
                'sup_id' => $fields['sup_id']
            ]);

            return response()->json(["message"=>"Product Created","payload"=>$new_product],201);

        } catch (\Exception $error) {
            throw $error;
        }
    }

   
    public function product_details(string $id)
    {
       try {

        //    $product_details = Product_Model::find($id);
           $product_details = Product_Model::with(["suppliers","categories"])->find($id);
           
           $product_data = [
            "id"=> $product_details->id,
            "product_name"=> $product_details->product_name,
            "price"=> $product_details->price,
            "category"=> $product_details->categories->category_name,
            "supplier"=> $product_details->suppliers->supplier_name,
           ];

           return response()->json($product_data,200);
           
       } catch (\Exception $error) {
        
        throw $error;

       }
    }

  
    public function update_product(Request $request, string $id)
    {
        try {

            $product = Product_Model::find($id);

            if(!$product){
    
                return response()->json(['message' => 'Record not found'], 404);
            }

            $fields = $request->validate([
                "product_name" => "required|string",
                "price" => "required",
            ]);

            $product->update([
                "product_name" => $fields['product_name'],
                "price" => $fields['price']
            ]);

            $updated_product =  Product_Model::find($id);

            return response()->json(["message"=>"Product Updated","payload"=>$updated_product],200);

        } catch (\Exception $error) {

            throw $error;
        }
    }

   
    public function delete_product(string $id)
    {
        try {

            $product = Product_Model::find($id);

            if(!$product) {
    
                return response()->json(['message' => 'Record not found'], 404);
            }

            $product->delete($id);

            $product_list = Product_Model::all();
            return response()->json($product_list,200);
            
        } catch (\Exception $error) {

            throw $error;
        }
    }


    public function search(string $product_name)
    {
        $product = Product_Model::where("product_name","like", "%".$product_name."%")->get();

        if(!$product) {

            return response()->json(['message' => 'Record not found'], 404);

        }else {

            return response()->json($product,200);

        }
    }
}


/* Do not touch this is the time conversion from excel to JS

// var excelDate = 43348.50278
// ;

// // Convert the number of days to a timestamp (number of seconds since January 1, 1970)
// var timestamp = (excelDate - 25569) * 86400;

// // Convert the timestamp to milliseconds
// var milliseconds = timestamp * 1000;

// // Create a new JavaScript Date object for the given timestamp
// var date = new Date(milliseconds);

// console.log(date);


function excelToJsDate(excelDate) {
 return new Date((excelDate - (25567 + 1)) * 86400000);
}

var excelDate = 43348.50278;
var jsDate = excelToJsDate(excelDate);
console.log(jsDate); // logs the JavaScript date 

 */