<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Http\Controllers\UserController; 
use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;


class UserController extends Controller
{

    public function AddUser(Request $request) 
    { 
        $request->validate([ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
        ]);

        $user= User::create([
            'mobile' => $request->mobile,
            'org_id' => $request->org_id,
            'username' => $request->username,
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => $request->password,
            'token' => "1" 
        ]);

        // return ($user);


        $accessToken = $user->createToken('Token Name')->accessToken;
            return response(['user'=>$user, 'accessToken'=>$accessToken]);
      }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers()
    {
      //Get Data Of Product

        $user = User::get()->where('deleted_at', NULL);
        if(count($user) > 0){
            return response([
                "status" => "success",
                 "message" => "users List",
                 "user" => $user,
                 "code" => 200
               ], 200);
        }
        else{
            return response([
                "status" => "failed",
                 "message" => "users Not Found",
                 "user" => $user,
                 "code" => 400
               ], 404);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
