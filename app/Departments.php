<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{

    protected $fillable = ['name', 'office_phone', 'manager_id'];
	public $timestamps = false;

	public function setManagerIdAttribute($value){
		$this->attributes['manager_id'] = $value ?: null;
	}
}
