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

            return Product_Model::all();

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

        return Product_Model::find($id);
        
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
                "product_name" => $request->input('product_name'),
                "price" => $request->input('price'),
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
            return response()->json(["message"=>"Product Deleted"],200);
            
        } catch (\Exception $error) {

            throw $error;
        }
    }


    public function search(string $name)
    {
        $product = Product_Model::where("name","like", "%".$name."%")->get();

        if(!$product) {

            return response()->json(['message' => 'Record not found'], 404);

        }else {

            return response()->json($product,200);

        }
    }
}
