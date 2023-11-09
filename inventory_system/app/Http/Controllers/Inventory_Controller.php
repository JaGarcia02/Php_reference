<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory_Model;
use App\Models\Category_Model;
use App\Models\Product_Model;
use App\Models\Supplier_Model;

class Inventory_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_all_inventory()
    {
        try {

            $inventory = Inventory_Model::all();
            $products = Product_Model::with(["suppliers","categories"])->get();
            
            $mappedProducts = $products->map(function ($data) use ($inventory) {
                $stock = $inventory->where('product_id', $data->id)->first();
        
                return [
                    'id' => $data->id,
                    'product_name' => $data->product_name,
                    'price' => $data->price,
                    "stock" => $stock ? $stock->stock : 0 ,
                    'supplier' => $data->suppliers->supplier_name,
                    'category' => $data->categories->category_name,
                ];
            });

            return response()->json($mappedProducts,200);

        } catch (\Exception $error) {

            throw $error;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_inventory(Request $request)
    {
        $fields = $request->validate([
            "product_id" => "required",
            "stock" => "required"
        ]);

        Inventory_Model::create([
            'product_id' => $fields['product_id'],
            'stock' => $fields['stock']
        ]);

        $inventory_list = Inventory_Model::all();

        return response()->json([
            "system_message"=>"Category Created",
            "payload"=>$inventory_list
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function invenory_details(string $id)
    {
        try {
            $inventory = Inventory_Model::find($id);
            if(!$inventory)
            {
                return response()->json([
                    "system_message"=>"Inventory Not Found!"
                ],404);
            }
            else
            {
                return response()->json(
                    $inventory
                ,200);
            }
        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_inventory(Request $request, string $id)
    {
        $fields = $request->validate([
            "product_id" => "required",
            "stock" => "required"
        ]);

        try {
            $inventory = Inventory_Model::find($id);
            if(!$inventory)
            {
                return response()->json([
                    "system_message"=>"Inventory Not Found!"
                ],404);
            }
            else
            {
                $inventory->update([
                    'product_id' => $fields['product_id'],
                    'stock' => $fields['stock'],
                ]);

                $updated_inventory = Inventory_Model::find($id);
    
                return response()->json([
                    "system_message"=>"Inventory Updated",
                    "payload"=>$updated_inventory
                ],200);
            }
        } catch (\Exception $error) {
            throw $error;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_inventory(string $id)
    {
        try {
            $inventory = Inventory_Model::find($id);
            if(!$inventory)
            {
                return response()->json([
                    "system_message"=>"Inventory Not Found!"
                ],404);
            }
            else
            {
                $inventory->delete($id);
                $updated_inventory = Inventory_Model::find($id);

                $inventory_list = Inventory_Model::all();
                
                return response()->json(
                   $inventory_list
                ,200);
            }
        } catch (\Exception $error) {
            throw $error;
        }
    }
}
