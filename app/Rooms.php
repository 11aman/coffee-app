<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
     protected $fillable = ['room_name','room_code','room_status','room_seat','org_id'];
}
