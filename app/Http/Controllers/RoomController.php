<?php

namespace App\Http\Controllers;
use App\Model\Organisation;
use App\Model\Room;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllRoom()
    {
        //
        $room = Room::get()->where('deleted_at', NULL);
        if(count($room) > 0){
            return response([
                "status" => "success",
                 "message" => "Rooms List",
                 "Room" => $room
               ], 200);
        }
        else{
            return response([
                "status" => "failed",
                 "message" => "Rooms Not Found",
                 "Room" => $room
               ], 404);
        }
        
    }
    
    public function getAllOrganisationRoom($id)
    {
        //
        $room = Room::get()->where('org_id', $id)->whereNull('deleted_at');
        if(count($room) > 0){
            return response([
                "status" => "success",
                 "message" => "Rooms List",
                 "Room" => $room
               ], 200);
        }
        else{
            return response([
                "status" => "failed",
                 "message" => "Rooms Not Found",
                 "Room" => $room
               ], 404);
        }
        
    }

    public function getRoom(Request $request)
    {
        //
        if (Room::where('org_id', $request->id)->exists()) {
            $room = Room::where('org_id', $request->id)->get();
            return response([
                "status" => "success",
                 "message" => "Room details",
                 "Room" => $room
               ], 200);
            } else {
                return response()->json([
                "status" => "failed",
                "message" => "Room not found"
                ], 404);
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveRoom(Request $request)
    {

         //room_id, room_name, org_id, room_code, room_status, room_seat, created_at, updated_at, deleted_at
        //save Room data
            
            $request->validate([
                'room_name'=>'required',
                'room_code'=>'required',
                'room_seat'=>'required',
                'org_id'=>'required'
            ]);
            $room = new Room([
                'room_name' => $request->get('room_name'),
                'room_code' => $request->get('room_code'),
                'room_status' => $request->get('room_status'),
                'room_seat' => $request->get('room_seat'),
                'org_id' => $request->get('org_id'),
                'deleted_at' => null
            ]);
            $room->save();
            return response()->json([
                "status" => "sussess",
                "message" => "Rooms created"
            ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRoom(Request $request, $id)
    {
        //room_id, room_name, org_id, room_code, room_status, room_seat, created_at, updated_at, deleted_at
           
        if (Room::where('room_id', $id)->exists()) {
            $room = Room::where('room_id', $id)->first();
            $room->room_name = is_null($request->room_name) ? $room->room_name : $room->room_name;
            $room->room_code = is_null($request->room_code) ? $room->room_code : $room->room_code;
            $room->room_seat = is_null($request->room_seat) ? $room->room_seat : $room->room_seat;
            $room->room_status = is_null($request->room_status) ? $room->room_status : $room->room_status;
            $room->org_id = is_null($request->org_id) ? $room->org_id : $room->org_id;
            $room->save();
            return response()->json([
              "status" => "sussess",
              "message" => "Room updated successfully"
            ], 200);
          } else {
            return response()->json([
              "status" => "failed",  
              "message" => "Room not found"
            ], 404);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRoom($id)
    {
        //
    }
}
