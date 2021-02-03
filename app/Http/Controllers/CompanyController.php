<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Country;
use DB;

class CompanyController extends Controller
{
	// Task A
	public function index(){ 

		$country = 'India';
		return $result = User::with('companies')->where(function ($query) use ($country) {
			$query->whereHas('companies.country', function($q) use ($country){
				$q->where('name', $country);			
			});			 
		})->get();
		
	}


}
