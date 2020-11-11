<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    //
    protected $fillable = [
        'org_id', 'org_name', 'org_description', 'org_email', 'org_contact', 'org_status', 'deleted_at'
      ];

       use SoftDeletes;
}
