<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisations extends Model
{
     protected $fillable = ['org_status','org_name','org_description','org_email','org_contact'];
}
