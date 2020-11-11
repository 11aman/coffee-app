<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    //room_id, room_name, org_id, room_code, room_status, room_seat, created_at, updated_at, deleted_at

    protected $fillable = [
         'room_name', 'room_code', 'org_id', 'room_status', 'room_seat', 'deleted_at'
    ];
    
     use SoftDeletes;
}
