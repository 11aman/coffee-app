<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	protected $fillable = [
         'product_name', 'product_img', 'org_id', 'product_status', 'product_qty', 'product_description','deleted_at'
    ];

     use SoftDeletes;
}
