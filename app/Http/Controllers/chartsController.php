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
        $lava = new Lavacharts; // See note below for Laravel
        $enero = DB::table('rast')
        ->select(DB::raw('month.name,month.id,avg(ST_Value(rast, ST_SetSRID(ST_Point(-71.233333,-34.983333), 4326)))'))
        ->join('register', 'register.id', '=', 'rast.id_register')
        ->join('month', 'month.id', '=', 'register.id_month')
        ->join('variable', 'variable.id', '=', 'register.id_variable')
        ->where('register.id_period','=','1' )
        ->orwhere('variable.id','=','1')
        ->groupBy('month.id')
        ->get();
        $grafico = $lava->DataTable();
        $grafico->addStringColumn('Months of Year')
                ->addNumberColumn('T° mínima');
                for($i=0; $i<count($enero); $i++)
                {
                    $grafico->addRow([$enero[$i]->name, $enero[$i]->avg]);
                }
        $lava->BarChart('variable', $grafico, [
            'title' => 'Temperatura Mínima',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 30
            ]
        ]);
         
         $periodo = Period::all();
         $scenario = Scenario::all();
         $variable = Variable::all();
         $datosTabla = $this->datosTabla();
         //dd($datosTabla);


        return view('indexGrafico')-> with('lava',$lava)->with('periodo',$periodo)->with('scenario',$scenario)->with('variable',$variable)->with('datosTabla', $datosTabla);
      
    }

    public function grafico(Lavacharts $lava)
    {

    }

    public function consultaGrafico(int $id_periodo, int $id_scenario, int $id_variable)
    {
        $enero = DB::table('rast')
        ->select(DB::raw('month.name,avg(ST_Value(rast, ST_SetSRID(ST_Point(-71.233333,-34.983333), 4326)))'))
        ->join('register', 'register.id', '=', 'rast.id_register')
        ->join('month', 'month.id', '=', 'register.id_month')
        ->join('variable', 'variable.id', '=', 'register.id_variable')
        ->where('register.id_period','=','1' )
        ->orwhere('variable.id','=','1')
        ->groupBy('month.name')
        ->get();
    }

    //funci
    public function postGrafico(Request $request)
    {
        if($request->input('Variable') == 1)//temperatura minima
        {
            
        }
        else if ($variable == 2)// temperatura maxima
        {

        }
        else if ($variable == 3)//variable
        {

        }
        else// radiacion uv
        {

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