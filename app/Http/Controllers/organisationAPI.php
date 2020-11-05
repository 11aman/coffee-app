<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Organisations;

class organisationAPI extends Controller
{
   public function add_oragnisation(Request $request)
    {
        $reqdata = $request->all();
        
    	$validator=Validator::make($request->all(),[
    		'org_name'=>'required',
    		'org_description'=>'required',
    		'org_email'=>'required',
    		'org_contact'=>'required',
    		'org_status'=>'required',
    	]);

        if($validator->fails())
    	{
    		return response()->json(['error'=>$validator->errors()->all()], 409);
    	}
        else
        {
        $p = new Organisations();
        $p->org_name = $request->org_name;	
        $p->org_description = $request->org_description;
        $p->org_email = $request->org_email;
        $p->org_contact = $request->org_contact;
        $p->org_status = $request->org_status;
        $p->save();


        if($p){
                return response()->json($data=[
                'status'=>200,
                'msg'=>'Organisation added Successfully',
                'Org_id'=>$p->id,

                
            ]);
        }
        else{
                return response()->json($data=[
                'status'=>203,
                'msg'=>'something went wrong'
               ]);
            } 
        }           
    }
   



public function Organisation_view(Request $req)
    {
         $user=Organisations::get();
        
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
