<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;
class Country extends Model
{
	protected $fillable = [
		'name'
	];


	public function company()
	{
		return $this->hasOne(Company::class);
	}

}
