<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File,Validator,Response;

class PDFController extends Controller
{
	public function index(){ 

		return view('pdf');
		
	}

	function action(Request $request)
	{
		$validation = Validator::make($request->all(), [
			'select_file' => "required|mimes:pdf|max:20000"
		]);

		$image = $request->file('select_file');
		$file_name = $image->getClientOriginalName();
		$file_size = $image->getSize();

		if($validation->passes())
		{
			if (strchr($file_name, "Proposal") == false) {
				return response()->json(array(
					'success' => false,
					'message' => 'Does not contain any word like : Proposal',
					'class_name'  => 'alert-danger'
				), 422);
			}

			$image->move(public_path('files'), $file_name);

			$checkfile = File::where('file_name',$file_name)
			->where('file_size',$file_size)
			->first();
			if(!empty($checkfile)){
				File::where('id',$checkfile->id)
				->update(['file_name'=>$file_name,'file_size'=>$file_size]);
			}else{
				File::create(['file_name'=>$file_name,'file_size'=>$file_size]);
			}
			
			return response()->json([
				'message'   => 'PDF Upload Successfully',				
				'class_name'  => 'alert-success'
			],200);

		}
		else
		{
			if($request->ajax())
			{
				return response()->json(array(
					'success' => false,
					'message' => $validation->errors()->all(),
					'class_name'  => 'alert-danger'
				), 422);
			}

			$this->throwValidationException(
				$request, $validation
			);
			
		}
	}
}
