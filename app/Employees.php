<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = ['department', 'name', 'photo', 'job_title', 'cellphone', 'email'];
	public $timestamps = false;
}
