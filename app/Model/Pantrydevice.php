<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pantrydevice extends Model
{
	use SoftDeletes;
	protected $dates=['deleted_at'];
	
    protected $fillable = [
        'device_name', 'device_ip', 'device_email', 'pantry_id',  'deleted_at'
      ];
}
