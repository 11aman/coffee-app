<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pantry extends Model
{
	use SoftDeletes;
	protected $dates=['deleted_at'];
	
    protected $table = 'pantries';
    //pantry_id, pantry_name, pantry_description, pantry_status, room_id, org_id, created_at, updated_at, deleted_at
    protected $fillable = [
        'pantry_name', 'pantry_description', 'pantry_status', 'room_id', 'org_id', 'deleted_at'
      ];
}
