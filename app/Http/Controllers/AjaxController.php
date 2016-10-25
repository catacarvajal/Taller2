<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller {
	public function index(Request $request){

		$data = $request->type; // This will get all the request data.       

		
		return response()->json(array('msg'=> $data ), 200);
	}
}