<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier_Model;
use App\Services\PayUService\Exception;

class Supplier_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_all_suppliers()
    {
        try {

            $suppliers = Supplier_Model::all();
            return response()->json($suppliers,200);

        } catch (\Exception $error) {

            throw $error;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_supplier(Request $request)
    {
        $fields = $request->validate([
            "supplier_name" => "required|string",
            "contact_num" => "required|digits:11",
            "address" => "required|string"
        ]);

        try {
            $new_supplier = Supplier_Model::create([
                'supplier_name'=>$fields['supplier_name'],
                'contact_num' => $fields['contact_num'],
                'address' => $fields['address']
            ]);

            return response()->json(["message"=>"Supplier Created","payload"=>$new_supplier],201);

        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function supplier_details(string $id)
    {
        try {

            $suppliers_details = Supplier_Model::find($id);
            return response()->json($suppliers_details,200);
            
        } catch (\Exception $error) {
         
         throw $error;
 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_supplier(Request $request, string $id)
    {
        $fields = $request->validate([
            "supplier_name" => "required|string",
            "contact_num" => "required|digits:11",
            "address" => "required|string"
        ]);

        try {

            $suppliers = Supplier_Model::find($id);

            if(!$suppliers){
    
                return response()->json(['message' => 'Record not found'], 404);
            }

            $suppliers->update([
                "supplier_name" => $fields['supplier_name'],
                "contact_num" => $fields['contact_num'],
                "address" => $fields['address']
            ]);

            $updated_suppliers =  Supplier_Model::find($id);

            return response()->json(["message"=>"Product Updated","payload"=>$updated_suppliers],200);

        } catch (\Exception $error) {

            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_supplier(string $id)
    {
        try {

            $supplier = Supplier_Model::find($id);

            if(!$supplier) {
    
                return response()->json(['message' => 'Record not found'], 404);
            }

            $supplier->delete($id);

            $suppliers_list = Supplier_Model::all();
            return response()->json($suppliers_list,200);
            
        } catch (\Exception $error) {

            throw $error;
        }
    }
}
