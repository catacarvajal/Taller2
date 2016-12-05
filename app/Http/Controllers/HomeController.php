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
use App\ChileComuna;


class HomeController extends Controller {

    public function index()
    {
        //$consultaPunto = $this->consultaGraficoInicio(0,0,0);//hacemos la consulta de 1 punto
        //$lava = $this->graficoPunto($consultaPunto,'');//hacemos el gráfico de ese punto con la consulta anterior
        $periodo = Period::all();// traemos todos los periodos que existen en la bd
        $scenario = Scenario::all();
        $variable = Variable::all();
        $regiones = $this->regiones();
        return view('index')->with('periodo',$periodo)->with('scenario',$scenario)->with('variable',$variable)->with('regiones',$regiones);
    }


     

        public function graficoPuntoPeriod($consulta)
    {
        
        $lava = new Lavacharts; // See note below for Laravel
                $grafico = $lava->DataTable();
                $grafico->addStringColumn('Months of Year')
                        ->addNumberColumn('T° mínima');
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico->addRow([$consulta[$i]->year_init, $consulta[$i]->avg]);
                        }
                $lava->LineChart('grafico', $grafico, [
                    'title' => 'Temperatura Mínima',
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ]
                ]);

        return $lava;
    }


    public function consultaGraficoPeriod($id_variable, $id_escenario,$puntos)
    {

             $consulta = DB::table('rast')
            ->select(DB::raw('month.name,month.id,avg(ST_Value(rast, ST_SetSRID(ST_Point('.$puntos.'), 4326)))'))
            ->join('register', 'register.id', '=', 'rast.id_register')
            ->join('period', 'period.id', '=', 'register.id_period')
            ->join('variable', 'variable.id', '=', 'register.id_variable')
            ->join('scenario', 'scenario.id', '=', 'register.id_scenario')
            ->where('variable.id','=', $id_variable)
            ->orwhere('scenario.id','=', $id_escenario)
            ->groupBy('period.year_init')
            ->get();
            return $consulta;       
    }

    public function regiones()
    {
        $regiones = DB::table('chilecomuna')
        ->distinct()
        ->select(DB::raw('region'))
        ->get();
        return $regiones;
    }

    public function provincias($region)
    {
        $provincias = DB::table('chilecomuna')
        ->distinct()
        ->select(DB::raw('name2'))
        ->where('region', '=', $region)
        ->get();
        return $provincias;

    }

    public function postRegiones(Request $request)
    {
        if ( $request->ajax() )
        {
            $region = $request->input('region');
            $provincias = $this->provincias($region);
            return $provincias->toJson();
        }
    }

    

    
   

    


    
}