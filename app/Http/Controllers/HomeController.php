<?php 

namespace App\Http\Controllers;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Month;
use App\Rast;
use App\Period;
use App\Scenario;
use App\Variable;


class HomeController extends Controller {

	public function index()
	{
		$consultaPunto = $this->consultaGraficoInicio(0,0,0);//hacemos la consulta de 1 punto
        $lava = $this->graficoPunto($consultaPunto);//hacemos el gráfico de ese punto con la consulta anterior
		$periodo = Period::all();// traemos todos los periodos que existen en la bd
        $scenario = Scenario::all();
        $variable = Variable::all();
        $datosTabla = $this->datosTabla(1,1); //se obtienen los datos para llenar la tabla (mes, variable, promedio)
		return view('index')->with('periodo',$periodo)->with('scenario',$scenario)->with('variable',$variable)->with('lava',$lava)->with('datosTabla',$datosTabla);
	}

	 public function consultaGraficoInicio($id_variable, $id_periodo, $id_escenario)
    {
        
             $consulta = DB::table('rast')
            ->select(DB::raw('month.name,month.id,avg(ST_Value(rast, ST_SetSRID(ST_Point(-71.233333,-34.983333), 4326)))'))
            ->join('register', 'register.id', '=', 'rast.id_register')
            ->join('month', 'month.id', '=', 'register.id_month')
            ->join('variable', 'variable.id', '=', 'register.id_variable')
            ->join('scenario', 'scenario.id', '=', 'register.id_scenario')
            ->where('register.id_period', '=', $id_periodo)
            ->orwhere('variable.id','=', $id_variable)
            ->orwhere('scenario.id','=', $id_escenario)
            ->groupBy('month.id')
            ->orderBy('month.id')
            ->get();
            return $consulta;
        
      

        
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
                    'title' => '',
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ]
                ]);

        return $lava;
    }
    public function consultaGrafico($id_variable, $id_periodo, $id_escenario,$punto)
    {
     
             $consulta = DB::table('rast')
            ->select(DB::raw('month.name,month.id,avg(ST_Value(rast, ST_SetSRID(ST_Point(-71.233333,-34.983333), 4326)))'))
            ->join('register', 'register.id', '=', 'rast.id_register')
            ->join('month', 'month.id', '=', 'register.id_month')
            ->join('variable', 'variable.id', '=', 'register.id_variable')
            ->join('scenario', 'scenario.id', '=', 'register.id_scenario')
            ->where('register.id_period', '=', $id_periodo)
            ->orwhere('variable.id','=', $id_variable)
            ->orwhere('scenario.id','=', $id_escenario)
            ->groupBy('month.id')
            ->orderBy('month.id')
            ->get();
            return $consulta;
        

        
    }
    public function datosTabla($id_variable, $id_periodo)
    {
        $tabla = DB::table('rast')
        ->select(DB::raw('month.name as mes, variable.name as variable, avg(ST_Value(rast, ST_SetSRID(ST_Point(-71.233333,-34.983333), 4326))) as promedio'))
        ->join('register', 'register.id', '=', 'rast.id_register')
        ->join('month', 'month.id', '=', 'register.id_month')
        ->join('variable', 'variable.id', '=', 'register.id_variable')
        ->where('register.id_period', '=', $id_periodo)
        ->orwhere('variable.id','=', $id_variable)
        ->groupBy('month.id', 'variable.name')
        ->orderBy('month.id')
        ->get();
        return ($tabla);
    }  


    public function DataTable($consulta)
    {
        if($consulta==0)
        {
            return 0;
        }
        else{
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
        }
        

        return $grafico;
    }

    public function ajaxGeoJson(Request $request){

        $variable =$request->input('variable');
  
        $escenario =$request->input('escenario');
        $periodo =$request->input('periodo');
        $data = $request->input('geoj');       
        
       
        $data0=$data['geometry'];
        $data1=$data0['type']; //tipo de geometria
        $data2=$data0['coordinates']; //cordenadas 

       
        $consultaPunto = $this->consultaGrafico($variable,$periodo,$escenario,$data2);
        $lava = $this->DataTable($consultaPunto);
          
        return $lava->toJson();


 /*       $data = $request->input('geoj');       
        
        $dat=json_decode($data,true);
        $data0=$dat['geometry'];
        $data1=$data0['type']; //tipo de geometria
        $data2=$data0['coordinates']; //cordenadas 

        $data = $request->input('variable');
        return response()->json(array('msg'=> $periodo), 200);*/
    }
}