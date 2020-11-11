<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Orderproduct;

class OrderProductController extends Controller
{
	public function getAllOrderProducts()
	{
		$orderproduct = Orderproduct::get()->where('deleted_at',NULL);
		if(count($orderproduct)>0){
			return response([
				"status" => "success",
				"message" => "Orderproduct List",
				"Orderproduct" => $orderproduct
			], 200);
		}
		else{
			return response([
                "status" => "failed",
                 "message" => "Orderproduct Not Found",
                 "Orderproduct" => $orderproduct
               ], 404);
		}
	}

	public function getOrderProduct(Request $request)
    {

        if (Orderproduct::where('order_product_id', $request->id)->exists()) {
            $orderproduct = Orderproduct::where('order_product_id', $request->id)->get();
            return response([
                "status" => "success",
                 "message" => "Orderproduct list",
                 "Orderproduct" => $orderproduct,
                 "code" => 200
               ], 200);
            } else {
                return response()->json([
                "status" => "failed",
                "message" => "Orderproduct not found",
                "code" => 404
                ], 404);
            }
    }

    public function saveOrderProduct(Request $request)
    {
    	$request->validate([
    		'product_name'=>'required',
    		'product_qty'=>'required',
    		'product_comment'=>'required',
    		'order_id'=>'required',
    		'product_id'=>'required'
    	]);

    	$orderproduct = new Orderproduct([
    		'product_name'=>$request->get('product_name'),
    		'product_qty'=>$request->get('product_qty'),
    		'product_comment'=>$request->get('product_comment'),
    		'order_id'=>$request->get('order_id'),
    		'product_id'=>$request->get('product_id'),
    	    'deleted_at' => null
    	]);
    	$orderproduct->save();
    	return response()->json([
    		"status" => "success",
    		"message" => "Orderproduct created"],201);
    }

    public function updateOrderProduct(Request $request, $id)
    {
        //org_id, org_name, org_description, org_email, org_contact, org_status, created_at, updated_at, deleted_at
           
        if (Orderproduct::where('order_product_id', $id)->exists()) {
            $orderproduct = Orderproduct::where('order_product_id', $id)->first();

            $orderproduct = Orderproduct::where('order_product_id', $id)->update([
                    'product_name' => is_null($request->product_name) ? $orderproduct->product_name : $request->product_name,
                    'product_qty' => is_null($request->product_qty) ? $orderproduct->product_qty : $request->product_qty,
                    'product_comment' => is_null($request->product_comment) ? $orderproduct->product_comment : $request->product_comment,
                    'order_id' => is_null($request->order_id) ? $orderproduct->order_id : $request->order_id,
                    'product_id' => is_null($request->product_id) ? $orderproduct->product_id : $request->product_id,
                ]);
        }
    
         if ($orderproduct) {
            return response()->json([
              "status" => "success",
              "message" => "Orderproduct updated successfully",
              "code" => 200
            ], 200);
          } else {
            return response()->json([
              "status" => "failed",  
              "message" => "Orderproduct not found",
              "code" => 404
            ], 404);
         }
    }

    public function deleteOrderProduct($id)
    {
        $orderproduct = Orderproduct::where('order_product_id','=',$id)->delete();
        if($orderproduct){
            return response()->json([
                "status"=>"success",
                "message"=>"Orderproduct deleted",
                "code"=>200
            ],200);
        }else{
            return response()->json([
                "status"=>"failed",
                "message"=>"Orderproduct not found",
                "code"=>404
            ],404);
        }
    }
}
