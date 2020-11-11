<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Organisation;
use Illuminate\Support\Facades\Validator;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllOrganisation()
    {
        //
        $organisation = Organisation::get()->where('deleted_at', NULL);
        if(count($organisation) > 0){
            return response([
                "status" => "success",
                 "message" => "Organisations List",
                 "organisation" => $organisation,
                 "code" => 200
               ], 200);
        }
        else{
            return response([
                "status" => "failed",
                 "message" => "Organisations Not Found",
                 "organisation" => $organisation,
                 "code" => 400
               ], 404);
        }
        
    }

    public function getOrganisation(Request $request)
    {
        //
        if (Organisation::where('org_id', $request->id)->exists()) {
            $organisation = Organisation::where('org_id', $request->id)->get();
            return response([
                "status" => "success",
                 "message" => "Organisation details",
                 "organisation" => $organisation,
                 "code" => 200
               ], 200);
            } else {
                return response()->json([
                "status" => "failed",
                "message" => "Organisation not found",
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
    public function saveOrganisation(Request $request)
    {

         //org_id, org_name, org_description, org_email, org_contact, org_status, created_at, updated_at, deleted_at
        //save organisation data

            $reqdata = $request->all();
        
            $validator=Validator::make($request->all(),[
               'org_name'=>'required',
               'org_description'=>'required',
               'org_email'=>'required',
               'org_contact'=>'required',
               
            ]);

            if($validator->fails())
            {
                return response()->json(['error'=>$validator->errors()->all()], 409);
            }
            else
            {
            $organisation = new Organisation();
            $organisation->org_name = $request->org_name;  
            $organisation->org_description = $request->org_description;
            $organisation->org_email = $request->org_email;
            $organisation->org_contact = $request->org_contact;
 
            $organisation->org_status = 1;
            $organisation->deleted_at = Null;
            $organisation->save();

            if($organisation){
                   return response()->json([
                         "status" => "sussess",
                         "message" => "Organisations created",
                         "code" => 200
                     ], 201);
            }
            else{
                    return response()->json([
                         "status" => "failed",
                         "message" => "Organisations not created",
                         "code" => 203
                     ], 404);
                } 
            }           



        }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrganisation(Request $request, $id)
    {
        //org_id, org_name, org_description, org_email, org_contact, org_status, created_at, updated_at, deleted_at
           
          if (Organisation::where('org_id', $id)->exists()) {
            $organisation = Organisation::where('org_id', $id)->first();

            $Organisation = Organisation::where('org_id', $id)->update([
                'org_name' => is_null($request->org_name) ? $organisation->org_name : $request->org_name,
                'org_description' => is_null($request->org_description) ? $organisation->org_description : $request->org_description,
                'org_email' => is_null($request->org_email) ? $organisation->org_email : $request->org_email,
                'org_contact' => is_null($request->org_contact) ? $organisation->org_contact : $request->org_contact,
                'org_status' => is_null($request->org_status) ? $organisation->org_status : $request->org_status,
                ]);
            }
    
         if ($Organisation) {
            return response()->json([
              "status" => "sussess",
              "message" => "Organisation updated successfully",
              "code" => 200
            ], 200);
          } else {
            return response()->json([
              "status" => "failed",  
              "message" => "Organisation not found",
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
    public function deleteOrganisation($id)
    {

        $organisation = Organisation::where('org_id','=', $id)->delete();
        if ($organisation) {
             return response()->json([
              "status" => "sussess",
              "message" => "Organisation deleted successfully",
              "code" => 200
            ], 200);

        } else {

            return response()->json([
              "status" => "failed",  
              "message" => "Organisation not found",
              "code" => 404
            ], 404);

        }
    }
    
}
