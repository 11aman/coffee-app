<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pantrydevice;

class PantryDeviceController extends Controller
{
	

	public function getAllDevices()
	{
		$device = Pantrydevice::get()->where('deleted_at',NULL);
		if(count($device)>0){
			return response([
				"status" => "success",
				"message" => "Devices List",
				"Device" => $device
			], 200);
		}
		else{
			return response([
                "status" => "failed",
                 "message" => "Devices Not Found",
                 "Device" => $device
               ], 404);
		}
	}

	public function getAllPantryDevices(Request $request)
    {

        if (Pantrydevice::where('device_id', $request->id)->exists()) {
            $device = Pantrydevice::where('device_id', $request->id)->get();
            return response([
                "status" => "success",
                 "message" => "device list",
                 "device" => $device,
                 "code" => 200
               ], 200);
            } else {
                return response()->json([
                "status" => "failed",
                "message" => "device not found",
                "code" => 404
                ], 404);
            }
    }

    public function getDevice(Request $request)
    {
        //
        if (Pantrydevice::where('device_id', $request->id)->exists()) {
            $device = Pantrydevice::where('device_id', $request->id)->get();
            return response([
                "status" => "success",
                 "message" => "device details",
                 "Device" => $device
               ], 200);
            } else {
                return response()->json([
                "status" => "failed",
                "message" => "Device not found"
                ], 404);
            }
    }

    
    public function savePantryDevice(Request $request)
    {
    	$request->validate([
    		'device_name'=>'required',
    		'device_ip'=>'required',
    		'device_email'=>'required',
    		'pantry_id'=>'required'
    	]);

    	$device = new Pantrydevice([
    		'device_name'=>$request->get('device_name'),
    		'device_ip'=>$request->get('device_ip'),
    		'device_email'=>$request->get('device_email'),
    		'pantry_id'=>$request->get('pantry_id'),
    	    'deleted_at' => null
    	]);
    	$device->save();
    	return response()->json([
    		"status" => "success",
    		"message" => "device created"],201);
    }

    public function updateDevice(Request $request, $id)
    {
        //org_id, org_name, org_description, org_email, org_contact, org_status, created_at, updated_at, deleted_at
           
        if (Pantrydevice::where('device_id', $id)->exists()) {
            $device = Pantrydevice::where('device_id', $id)->first();

            $device = Pantrydevice::where('device_id', $id)->update([
                    'device_name' => is_null($request->device_name) ? $device->device_name : $request->device_name,
                    'device_ip' => is_null($request->device_ip) ? $device->device_ip : $request->device_ip,
                    'device_email' => is_null($request->device_email) ? $device->device_email : $request->device_email,
                    'pantry_id' => is_null($request->pantry_id) ? $device->pantry_id : $request->pantry_id,
                    'status' => is_null($request->status) ? $device->status : $request->status,
                ]);
        }
    
         if ($device) {
            return response()->json([
              "status" => "success",
              "message" => "device updated successfully",
              "code" => 200
            ], 200);
          } else {
            return response()->json([
              "status" => "failed",  
              "message" => "device not found",
              "code" => 404
            ], 404);
          }
    }

    public function deleteDevice($id)
    {
        $device = Pantrydevice::where('device_id','=',$id)->delete();
        if($device){
            return response()->json([
                "status"=>"success",
                "message"=>"Device deleted",
                "code"=>200
            ],200);
        }else{
            return response()->json([
                "status"=>"failed",
                "message"=>"Device not found",
                "code"=>404
            ],404);
        }
    }
}
