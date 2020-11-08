<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Organisation;
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
            $request->validate([
                'org_name'=>'required',
                'org_description'=>'required',
                'org_email'=>'required',
                'org_contact'=>'required'
            ]);
            $organisation = new Organisation([
                'org_name' => $request->get('org_name'),
                'org_description' => $request->get('org_description'),
                'org_email' => $request->get('org_email'),
                'org_contact' => $request->get('org_contact'),
                'org_status' => 1,
                'deleted_at' => Null
            ]);
            $organisation->save();
            return response()->json([
                "status" => "sussess",
                "message" => "Organisations created",
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
    public function updateOrganisation(Request $request, $id)
    {
        //org_id, org_name, org_description, org_email, org_contact, org_status, created_at, updated_at, deleted_at
           
        if (Organisation::where('org_id', $id)->exists()) {
            $organisation = Organisation::where('org_id', $id)->first();
            $organisation->org_name = is_null($request->org_name) ? $organisation->org_name : $organisation->org_name;
            $organisation->org_description = is_null($request->org_description) ? $organisation->org_description : $organisation->org_description;
            $organisation->org_email = is_null($request->org_email) ? $organisation->org_email : $organisation->org_email;
            $organisation->org_contact = is_null($request->org_contact) ? $organisation->org_contact : $organisation->org_contact;
            $organisation->org_status = is_null($request->org_status) ? $organisation->org_status : $organisation->org_status;
            $organisation->save();
    
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
        //
    }
}
