<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayUService\Exception;
use App\Models\Category_Model;

class Category_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_all_categories()
    {
        try {

            $categories = Category_Model::all();
            return response()->json($categories,200);
           
        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_category(Request $request)
    {
        try {

            $fields = $request->validate([
                "category_name" => "required|string",
            ]);

            Category_Model::create([
                'category_name' => $fields['category_name'],
            ]);

            $category_list = Category_Model::all();

            return response()->json([
                "system_message"=>"Category Created",
                "payload"=>$category_list
            ],200);

           
        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function get_category_detail(string $id)
    {
        try {
            $category = Category_Model::find($id);
            if(!$category)
            {
                return response()->json([
                    "system_message"=>"Category Not Found!"
                ],404);
            }
            else
            {
                return response()->json(
                    $category
                ,200);
            }
        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_category(Request $request, string $id)
    {
        try {
            $fields = $request->validate([
                "category_name" => "required|string",
            ]);

            $category = Category_Model::find($id);
            if(!$category)
            {
                return response()->json([
                    "system_message"=>"Category Not Found!"
                ],404);
            }
            else
            {
                $category->update([
                    'category_name' => $fields['category_name'],
                ]);

                $updated_category = Category_Model::find($id);
    
                return response()->json([
                    "system_message"=>"Category Updated",
                    "payload"=>$updated_category
                ],200);
            }
        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_category(string $id)
    {
        try {
            $category = Category_Model::find($id);
            if(!$category)
            {
                return response()->json([
                    "system_message"=>"Category Not Found!"
                ],404);
            }
            else
            {
                $category->delete($id);
                $updated_category = Category_Model::find($id);
                return response()->json(
                   $updated_category
                ,200);
            }
        } catch (\Exception $error) {
            throw $error;
        }
    }
}
