<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Pantries;

class pantryAPI extends Controller
{
    public function addpantry(Request $request){
     $validator = Validator::make($request->all(), [
      'pantry_name' =>'required',
      'pantry_description' => 'required',
      'pantry_status' => 'required',
      
    ]);

     if($validator->fails()){
     	return response()->json(['error' => $validator->errors()->all()], 409);
     }
     else{
     $api = new Pantries();
     $api->pantry_name = $request->pantry_name;
     $api->pantry_description = $request->pantry_description;
     $api->pantry_status = $request->pantry_status;
     $api->room_id = $request->room_id;
     $api->org_id = $request->org_id;
     $api->save();

     if($api){
     	return response()->json($data = [
     		'status' => 200,
     	    'msg' => 'pantry Added Sucessfully...!!',
     	]);
     }else{
     	 return response()->json($data = [
     	     'status' => 203,
     	      'msg' => 'something went wrong',
     	  ]);
        }
     }
   }

   public function viewpantry(Request $req)
    {
         $user=Pantries::get();
        
        if($user->count()){
            return response()->json($data = [
            'status' => 200,
            'msg'=>'Success',
            'user' => $user
            ]);
        }
        else{
            return response()->json($data = [
            'status' => 201,
            'msg' => 'Data Not Found'
            ]);
        }
    }
}
