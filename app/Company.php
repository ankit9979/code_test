<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\User;
class Company extends Model
{
	protected $fillable = [
		'name', 'country_id '
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function users()
    {
        return $this->belongsToMany(User::class,'user_company')->withPivot('date_of_join');
    }


}
