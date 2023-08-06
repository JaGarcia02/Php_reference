<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // This is the controller of the Php Laravel
    // This is only for educational purposes!

   public function index(){
    $students = Student::all();
    if($students->count() > 0){
        return response()->json([
            "status"=>200,
            "students"=> $students
        ],200);
    }else{
        return response()->json([
            "status"=>404,
            "students"=> "No records found!"
        ],404);
    }
   }

   public function store(Request $request) {
    $validator = Validator::make($request->all(),[
        "name"=>"required|string|max:191",
        "course"=>"required|string|max:191",
        "email"=>"required|email|max:191",
        "phone"=>"required|digits:11",
    ]);

    if($validator->fails()){
        return response()->json([
            "status"=>200,
            "errors"=> $validator->messages()
        ],422);
    }else{
        $student = Student::create([
            "name" => $request->name,
            "course" => $request->course,
            "email" => $request->email,
            "phone" => $request->phone,
        ]);

        if($student){
            return response()->json([
                "status"=>200,
                "message"=> "Student Created Successfully!"
            ],200);
        }else{
            return response()->json([
                "status" =>500,
                "message" => "Something went wrong!"
            ],500);
        }
     
    }
   }

   public function show($id){
    $student = Student::find($id);
    if($student){
            return response()->json([
            "status"=>200,
            "student"=>$student
        ],200);
    }else{
        return response()->json([
            "status"=>404,
            "message"=>"Student not found!"
        ],404);
    }
   }

   public function edit($id){
        $student = Student::find($id);
        if($student){
                return response()->json([
                "status"=>200,
                "student"=>$student
            ],200);
        }else{
            return response()->json([
                "status"=>404,
                "message"=>"Student not found!"
            ],404);
        }
   }

   public function update(Request $request, int $id){
     $validator = Validator::make($request->all(),[
        "name"=>"required|string|max:191",
        "course"=>"required|string|max:191",
        "email"=>"required|string|max:191",
        "phone"=>"required|digits:11",
     ]);

     if($validator->fails()){
        return response()->json([
            "status" => 422,
            "error" => $validator->messages()
        ],422);
     }else{
       $student = Student::find($id);
      if($student){

        // Querry
        $student->update([
            "name" => $request->name,
            "course" => $request->course,
            "email" => $request->email,
            "phone" => $request->phone
        ]);

        // Success Response
        return response()->json([
            "status" => 200,
            "message" => "Student data updated!"
        ],200);
      }else{
        return response()->json([
            "status" => 404,
            "error" => "Student not found!"
        ],404);
      }

     }
   }

   public function destroy($id){
    $student = Student::find($id);
    if($student){
        $student->delete();
        return response()->json([
            "status" => 404,
            "messages" => "Student data has been deleted!"
        ],200);
    }else{
        return response()->json([
            "status" => 404,
            "messages" => "Student not found!"
        ],404);
;    }
   }
}
