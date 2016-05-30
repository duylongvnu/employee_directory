<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{

    protected $fillable = ['name', 'office_phone', 'manager'];
	public $timestamps = false;
}
