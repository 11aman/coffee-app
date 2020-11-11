<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use Validator;

class ProductController extends Controller
{
     public function getAllProducts()
    {
      //Get Data Of Product

        $product = Product::get()->where('deleted_at', NULL);
        if(count($product) > 0){
            return response([
                "status" => "success",
                 "message" => "Products List",
                 "product" => $product_name,
                 "code" => 200
               ], 200);
        }
        else{
            return response([
                "status" => "failed",
                 "message" => "Products Not Found",
                 "product" => $product,
                 "code" => 400
               ], 404);
        }
        
    }


    public function getProduct(Request $request)
    {
        //Get Single Product All Data

        if (Product::where('product_id', $request->id)->exists()) {
            $product = Product::where('product_id', $request->id)->get();
            return response([
                "status" => "success",
                 "message" => "Product details",
                 "product" => $product_name,
                 "code" => 200
               ], 200);
            } else {
                return response()->json([
                "status" => "failed",
                "message" => "Product not found",
                "code" => 404
                ], 404);
            }
    }



     public function saveProduct(Request $request)
    {
      
      //Save Product Data

         $reqdata = $request->all();
        
            $validator=Validator::make($request->all(),[
               'product_name'=>'required',
               'product_description'=>'required',
               'product_qty'=>'required',
               'product_status'=>'required',
               'org_id' => 'required'
            ]);

            if($validator->fails())
            {
                return response()->json(['error'=>$validator->errors()->all()], 409);
            }
            else
            {
            $product = new Product();
            $product->product_name = $request->product_name;  
            $product->product_description = $request->product_description;
            $product->product_qty = $request->product_qty;
            $product->org_id = $request->org_id;
            $product->product_status = 1;
            $product->deleted_at = Null;
            $product->save();


            $url="http://127.0.0.1:8000/storage/";
            $file=$request->file('product_img');
            $extension=$file->extension();
            
            $path=$request->file('product_img')->storeAs('Product', $product->id.'.'.$extension);
            
            Product::where('product_id','=',$product->id)->update([
                'product_img' => $url.$path
            ]);
          
            if($product){
                    return response()->json($data=[
                    'status'=>200,
                    'msg'=>'User Registration Successfull',
                    
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



      public function updateProduct(Request $request, $id)
    {
        //org_id, org_name, org_description, org_email, org_contact, org_status, created_at, updated_at, deleted_at
           
        // Update Product
        //return(Product::where('product_id','=',$id)->first());

        $Product =Product::where('product_id','=',$id)->first();
        $Product->product_name = $request->product_name;  
        $Product->product_description = $request->product_description;
        $Product->product_qty = $request->product_qty;
        $Product->product_status = $request->product_status;
        $Product->save();

        $url="http://127.0.0.1:8000/storage/";
        $file=$request->file('product_img');
        $extension=$file->extension();
        $path=$request->file('product_img')->storeAs('Product', $Product->product_id.'.'.$extension);
            
        Product::where('product_id','=',$Product->product_id)->update([
                'product_img' => $url.$path
        ]);
        
       // return($Product);
       
       if($Product){
                return response()->json($data=[
                'status'=>'success',
                'message'=>'Upadte product Successfull',
                'product' => $Product
                
            ], 200);
        }
        else{
                return response()->json($data=[
                'status'=>'failed',
                'message'=>'something went wrong'
               ],203);
            } 
    } 


     public function deleteProduct($id)
    {
        $product = Product::where('product_id','=', $id)->delete();
        if ($product) {
             return response()->json([
              "status" => "sussess",
              "message" => "product deleted successfully",
              "code" => 200
            ], 200);

        } else {

            return response()->json([
              "status" => "failed",  
              "message" => "product not found",
              "code" => 404
            ], 404);
    }    
   }

}  
