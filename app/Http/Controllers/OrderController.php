<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;

class OrderController extends Controller
{
    
    public function getAllOrders()
    {
        $order = Order::get()->where('deleted_at',NULL);
        if(count($order)>0){
            return response([
                "status" => "success",
                "message" => "Orders List",
                "Order" => $order
            ], 200);
        }
        else{
            return response([
                "status" => "failed",
                 "message" => "Orders Not Found",
                 "Order" => $order
               ], 404);
        }
    }

    public function getOrder(Request $request)
    {

        if (Order::where('order_id', $request->id)->exists()) {
            $order = Order::where('order_id', $request->id)->get();
            return response([
                "status" => "success",
                 "message" => "order list",
                 "Order" => $order,
                 "code" => 200
               ], 200);
            } else {
                return response()->json([
                "status" => "failed",
                "message" => "order not found",
                "code" => 404
                ], 404);
            }
    }

    
    public function saveOrder(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'mobile'=>'required',
            'comment'=>'required',
            'order_number'=>'required',
            'org_id'=>'required',
            'room_id'=>'required',
            'pantry_id'=>'required'
        ]);

        $order = new Order([
            'name'=>$request->get('name'),
            'mobile'=>$request->get('mobile'),
            'comment'=>$request->get('comment'),
            'order_number'=>$request->get('order_number'),
            'org_id'=>$request->get('org_id'),
            'room_id'=>$request->get('room_id'),
            'pantry_id'=>$request->get('pantry_id'),
            'deleted_at' => null
        ]);
        $order->save();
        return response()->json([
            "status" => "success",
            "message" => "order created"],201);
    }

    public function updateOrder(Request $request, $id)
    {
        //org_id, org_name, org_description, org_email, org_contact, org_status, created_at, updated_at, deleted_at
           
        if (Order::where('order_id', $id)->exists()) {
            $order = Order::where('order_id', $id)->first();

            $order = Order::where('order_id', $id)->update([
                    'name' => is_null($request->name) ? $order->name : $request->name,
                    'mobile' => is_null($request->mobile) ? $order->mobile : $request->mobile,
                    'comment' => is_null($request->comment) ? $order->comment : $request->comment,
                    'order_number' => is_null($request->order_number) ? $order->order_number : $request->order_number,
                    'org_id' => is_null($request->org_id) ? $order->org_id : $request->org_id,
                    'room_id' => is_null($request->room_id) ? $order->room_id : $request->room_id,
                    'pantry_id' => is_null($request->pantry_id) ? $order->pantry_id : $request->pantry_id,
                    'order_status' => is_null($request->order_status) ? $order->order_status : $request->order_status,
                ]);
        }
    
         if ($order) {
            return response()->json([
              "status" => "sussess",
              "message" => "order updated successfully",
              "code" => 200
            ], 200);
          } else {
            return response()->json([
              "status" => "failed",  
              "message" => "order not found",
              "code" => 404
            ], 404);
          }
    }

    public function deleteOrder($id)
    {
        $order = Order::where('order_id','=',$id)->delete();
        if($order){
            return response()->json([
                "status"=>"success",
                "message"=>"Order deleted",
                "code"=>200
            ],200);
        }else{
            return response()->json([
                "status"=>"failed",
                "message"=>"Order not found",
                "code"=>404
            ],404);
        }
    }
}
