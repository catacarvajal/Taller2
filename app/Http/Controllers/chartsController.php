<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Month;
use App\Rast;
use App\Period;
use App\Scenario;
use App\Variable;
class chartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultaPunto = $this->consultaGrafico(1,1,1);//hacemos la consulta de 1 punto
        $lava = $this->graficoPunto($consultaPunto);//hacemos el gráfico de ese punto con la consulta anterior
        $periodo = Period::all();// traemos todos los periodos que existen en la bd
        $scenario = Scenario::all();
        $variable = Variable::all();
        $datosTabla = $this->datosTabla(); //se obtienen los datos para llenar la tabla (mes, variable, promedio)

        return view('indexGrafico')-> with('lava',$lava)->with('periodo',$periodo)->with('scenario',$scenario)->with('variable',$variable)->with('datosTabla', $datosTabla);
      
    }

    public function graficoPunto($consulta)
    {
        $lava = new Lavacharts; // See note below for Laravel
                $grafico = $lava->DataTable();
                $grafico->addStringColumn('Months of Year')
                        ->addNumberColumn('');
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico', $grafico, [
                    'title' => 'Gráfico',
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ]
                ]);

        return $lava;
    }



        public function DataTable($consulta)
    {
        
       $lava = new Lavacharts; // See note below for Laravel
                $grafico = $lava->DataTable();
                $grafico->addStringColumn('Months of Year')
                        ->addNumberColumn('');
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico', $grafico, [
                    'title' => 'Gráfico',
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
        ->select(DB::raw('month.name,avg(ST_Value(ST_SetSRID(rast,4326), ST_SetSRID(ST_Point(-71.233333,-34.983333), 4326)))'))
        ->join('register', 'register.id', '=', 'rast.id_register')
            ->join('month', 'month.id', '=', 'register.id_month')
            ->join('variable', 'variable.id', '=', 'register.id_variable')
            ->join('scenario', 'scenario.id', '=', 'register.id_scenario')

        ->where('variable.id','=', $id_variable)
        ->orwhere('scenario.id','=', $id_escenario)
        ->groupBy('month.name')
        ->get();
        return $consulta;
    }

    //recibo lo que tiene los lavels //esto hay que hacerlo con ajax
    public function postGrafico(Request $request)
    {
        if ( $request->ajax())
        {
            $variable =$request->input('variable');
            $escenario =$request->input('escenario');
            $periodo =$request->input('periodo');
            $consultaPunto = $this->consultaGrafico($variable,$periodo,$escenario);
            $lava = $this->DataTable($consultaPunto);
            return $lava->toJson();
            //return $periodo;
        }
        
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
        ->get();
        return ($tabla);
    }  
}