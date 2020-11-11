<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;
	protected $dates=['deleted_at'];
	
    protected $fillable = [
        'name', 'mobile', 'comment', 'order_number', 'org_id','room_id','pantry_id',  'deleted_at'
      ];
}
