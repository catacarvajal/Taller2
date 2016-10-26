<?php 

namespace App\Http\Controllers;
use App\Month;
use App\Rast;
use App\Period;
use App\Scenario;
use App\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller {

	public function index()
	{
		$consultaPunto = $this->consultaGrafico(1,1,1);
		$lava = $this->graficoPunto($consultaPunto);
		$periodo = Period::all();// traemos todos los periodos que existen en la bd
        $scenario = Scenario::all();
        $variable = Variable::all();
        $datosTabla = $this->datosTabla(); 
		return view('index')->with('periodo',$periodo)->with('scenario',$scenario)->with('variable',$variable)->with('datosTabla', $datosTabla)-> with('lava',$lava);
	}

	public function indexAmbos()
	{
		return view('indexAmbos');
	}

	public function datosTabla()
    {
        $tabla = DB::table('rast')
        ->select(DB::raw('month.name as mes, variable.name as variable, avg(ST_Value(rast, ST_SetSRID(ST_Point(-71.233333,-34.983333), 4326))) as promedio'))
        ->join('register', 'register.id', '=', 'rast.id_register')
        ->join('month', 'month.id', '=', 'register.id_month')
        ->where('register.id_period', '=', '1')
        ->join('variable', 'variable.id', '=', 'register.id_variable')
        ->groupBy('month.id', 'variable.name')
        ->orderBy('month.id')
        ->get();
        return ($tabla);
    } 

    public function graficoPunto($consulta)
    {
        $lava = new Lavacharts; // See note below for Laravel
        $grafico = $lava->DataTable();
        $grafico->addStringColumn('Months of Year')
                ->addNumberColumn('T° mínima');
                for($i=0; $i<count($consulta); $i++)
                {
                    $grafico->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                }
        $lava->BarChart('grafico', $grafico, [
            'title' => 'Temperatura Mínima',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 30
            ]
        ]);
        return $lava;
    }

    public function consultaGrafico($id_variable, $id_periodo, $id_escenario)
    {
       $consulta = DB::table('rast')
        ->select(DB::raw('month.name,month.id,avg(ST_Value(ST_SetSRID(rast,4326), ST_SetSRID(ST_Point(-71.233333,-34.983333), 4326)))'))
        ->join('register', 'register.id', '=', 'rast.id_register')
        ->join('month', 'month.id', '=', 'register.id_month')
        ->join('variable', 'variable.id', '=', 'register.id_variable')
        ->where('register.id_period','=',$id_periodo)
        ->orwhere('variable.id','=', $id_variable)
        ->groupBy('month.id')
        ->get();
        return $consulta;
    }
}