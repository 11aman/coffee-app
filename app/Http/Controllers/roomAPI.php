<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Rooms;

class roomAPI extends Controller
{
    public function add_room(Request $request)
    {
        $reqdata = $request->all();
        
    	$validator=Validator::make($request->all(),[
    		'room_name'=>'required',
    		'room_code'=>'required',
    		'room_status'=>'required',
    		'room_seat'=>'required',
    		
    	]);

        if($validator->fails())
    	{
    		return response()->json(['error'=>$validator->errors()->all()], 409);
    	}
        else
        {
        $p = new Rooms();
        $p->room_name = $request->room_name;	
        $p->room_code = $request->room_code;
        $p->room_status = $request->room_status;
        $p->room_seat = $request->room_seat;
        $p->org_id = $request->org_id;
     
        $p->save();


        if($p){
                return response()->json($data=[
                'status'=>200,
                'msg'=>'Organisation added Successfully',
                'Room_id'=>$p->id,

                
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


    public function Rooms_view(Request $req)
    {
         $user=Rooms::get();
        
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
