<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller {
	public function index(Request $request){

		$data = $request->input('geoj');
		$periodo=$request->input('periodo');
		$dat=json_decode($data,true);
		$data0=$dat['geometry'];
		$data1=$data0['type']; //tipo de geometria
		$data2=$data0['coordinates']; //cordenadas 

		$data = $request->input('variable');

		vgrafico();
		return response()->json(array('msg'=> $periodo), 200);
	}
	
	public function vgrafico(){

		return view('indexGrafico');
		
	}
}