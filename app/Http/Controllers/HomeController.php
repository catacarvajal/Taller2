<?php 

namespace App\Http\Controllers;
use App\Month;
use App\Rast;
use App\Period;
use App\Scenario;
use App\Variable;

class HomeController extends Controller {

	public function index()
	{
		$periodo = Period::all();// traemos todos los periodos que existen en la bd
        $scenario = Scenario::all();
        $variable = Variable::all();
		return view('index')->with('periodo',$periodo)->with('scenario',$scenario)->with('variable',$variable);
	}

	public function indexAmbos()
	{
		return view('indexAmbos');
	}
}