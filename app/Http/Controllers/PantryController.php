<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pantry;

class PantryController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPantries()
    {
        //
        $pantries = Pantry::get()->where('deleted_at', NULL);
        if(count($pantries) > 0){
            return response([
                "status" => "success",
                 "message" => "Pantries List",
                 "code" => "200",
                 "pantry" => $pantries
               ], 200);
        }
        else{
            return response([
                "status" => "failed",
                 "message" => "Pantry Not Found",
                 "pantry" => $pantries
               ], 404);
        }
        
    }

    public function getOrganisationPantries(Request $request)
    {
        //
        if (Pantry::where('org_id', $request->id)->exists()) {
            $pantries = Pantry::where('org_id', $request->id)->get();
            return response([
                "status" => "success",
                 "message" => "Pantries details",
                 "pantry" => $pantries,
                 "code" => 200
               ], 200);
            } else {
                return response()->json([
                "status" => "failed",
                "message" => "Pantry not found",
                "code" => 404
                ], 404);
            }
    }

    public function getPantry(Request $request)
    {
        //
        if (Pantry::where('pantry_id', $request->id)->exists()) {
            $pantries = Pantry::where('pantry_id', $request->id)->get();
            return response([
                "status" => "success",
                 "message" => "Pantry details",
                 "pantry" => $pantries,
                 "code" => 200
               ], 200);
            } else {
                return response()->json([
                "status" => "failed",
                "message" => "Pantry not found",
                "code" => 404
                ], 404);
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePantry(Request $request)
    {

        //pantry_id, pantry_name, pantry_description, pantry_status, room_id, org_id, created_at, updated_at, deleted_at
        //save pantry  data
            $request->validate([
                'pantry_name'=>'required',
                'pantry_description'=>'required',
                'pantry_status'=>'required',
                'room_id'=>'required',
                'org_id'=>'required'
            ]);

            $pantries = new Pantry([
                'pantry_name' => $request->get('pantry_name'),
                'pantry_description' => $request->get('pantry_description'),
                'pantry_status' => $request->get('pantry_status'),
                'room_id' => $request->get('room_id'),
                'org_id' => $request->get('org_id'),
                'deleted_at' => Null
            ]);
            $pantries->save();

            return response()->json([
                "status" => "sussess",
                "message" => "Pantry created",
                "code" => 200
            ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePantry(Request $request, $id)
    {
       //pantry_id, pantry_name, pantry_description, pantry_status, room_id, org_id, created_at, updated_at, deleted_at
           
        if (Pantry::where('pantry_id', $id)->exists()) {
            $pantries = Pantry::where('pantry_id', $id)->first();

             $pantries = Pantry::where('pantry_id', $id)->update([
            'pantry_name' => is_null($request->pantry_name) ? $pantries->pantry_name : $request->pantry_name;
            'pantry_description' => is_null($request->pantry_description) ? $pantries->pantry_description : $request->pantry_description;
            'pantry_status' => is_null($request->pantry_status) ? $pantries->pantry_status : $request->pantry_status;
            'room_id' => is_null($request->room_id) ? $pantries->room_id : $request->room_id;
            'org_id' => is_null($request->org_id) ? $pantries->org_id : $request->org_id;
             ]);
    
            return response()->json([
              "status" => "sussess",
              "message" => "Pantry updated successfully",
              "code" => 200
            ], 200);
          } else {
            return response()->json([
              "status" => "failed",  
              "message" => "Pantry not found",
              "code" => 404
            ], 404);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePantry($id)
    {
<<<<<<< HEAD
        $pantry = Pantry::where('pantry_id','=',$id)->delete();
        if($pantry){
            return response()->json([
                "status"=>"success",
                "message"=>"Pantry deleted",
                "code"=>200
            ],200);
        }else{
            return response()->json([
                "status"=>"failed",
                "message"=>"Pantry not found",
                "code"=>404
            ],404);
=======
         $room = Room::where('room_id','=', $id)->delete();
        if ($room) {
             return response()->json([
              "status" => "sussess",
              "message" => "room deleted successfully",
              "code" => 200
            ], 200);

        } else {

            return response()->json([
              "status" => "failed",  
              "message" => "room not found",
              "code" => 404
            ], 404);

>>>>>>> ce782fe335ac299d7c6f2da54f44790543496fbd
        }
    }
}
