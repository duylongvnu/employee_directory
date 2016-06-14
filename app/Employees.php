<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = ['department_id', 'name', 'photo', 'job_title', 'cellphone', 'email'];
	public $timestamps = false;

	public function setDepartmentIdAttribute($value){
		$this->attributes['department_id'] = $value ?: null;
	}
}
