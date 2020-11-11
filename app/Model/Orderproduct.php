<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Orderproduct extends Model
{
	use SoftDeletes;
	protected $dates=['deleted_at'];
	
    protected $fillable = [
        'product_name', 'product_qty', 'product_comment', 'order_id', 'product_id', 'deleted_at'
      ];
}
