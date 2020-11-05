<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Validator;

class productAPI extends Controller
{
    public function addproduct(Request $request){
     $add =new Products();
     $add->product_name = $request->product_name;
     $add->product_description = $request->product_description ;
     $add->product_qty = $request->product_qty;
     $add->org_id = $request->org_id;

     $url="http://127.0.0.1:8000/storage/";
     $file=$request->file('product_img');
     $extension=$file->getClientOriginalExtension();
     // dd($extension);
      // exit;
      $path=$request->file('product_img')->storeAs('productimages', $add->id.'.'.$extension);
           // dd($extension);
           // exit;  
       $add->product_img=$path;
       $add->imgpath=$url.$path;
       $add->save();


    if($add){
    	return response()->json($product=[
    		'status' => 200,
    		'msg' => 'product Added Sucessfully...!!',
    	]);
    }else{

    	  return response()->json($product=[
                'status'=>203,
                'msg'=>'something went wrong'
               ]);
    }
  }

   public function viewproduct(Request $req)
    {
         $user=Products::get();
        
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
