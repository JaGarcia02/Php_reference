<?php

namespace App\Http\Controllers;

use App\Models\Product_Model;
use Illuminate\Http\Request;
use App\Services\PayUService\Exception;

class Product_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return Product_Model::all();
        }  catch (\Throwable $error) {
            throw $error;
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "slug" => "required",
                "price" => "required",
            ]);
            return Product_Model::create($request->all());
        } catch (\Throwable $error) {
             throw $error;
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return Product_Model::find($id);
        } catch (\Exception $error) {
            throw $error;
        }  
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $product = Product_Model::find($id);

            if(!$product){
    
                return response()->json(['message' => 'Record not found'], 404);
    
            }else {
    
                $request->validate([
                    "name" => "required",
                    "slug" => "required",
                    "description" => "required",
                    "price" => "required",
                ]);
    
                $product->update([
                    "name" => $request->input('name'),
                    "slug" => $request->input('slug'),
                    "description" => $request->input('description'),
                    "price" => $request->input('price'),
                ]);
    
                $updated_product =  Product_Model::find($id);
    
                return response()->json(["message"=>"Product Updated","payload"=>$updated_product],200);
    
            }
        } catch (\Exception $error) {
            throw $error;
        }  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product_Model::find($id);

            if(!$product) {
    
                return response()->json(['message' => 'Record not found'], 404);
    
            }else {
    
                $product->delete($id);
                return response()->json(["message"=>"Product Deleted"],200);
                
            }
        }  catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * Search the specified resource from storage.
     */
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
