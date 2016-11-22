<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;
use App\Http\Controllers\Controller;
use App\Month;
use App\Rast;
use App\Period;
use App\Scenario;
use App\Variable;
use Barryvdh\DomPDF\Facade\PDF;

class PdfController extends Controller
{
    public function exportarPDF() 
    {
        
        $consultaPunto = $this->consultaGrafico(1,1,1);//hacemos la consulta de 1 punto
        $lava = $this->graficoPunto($consultaPunto);//hacemos el gráfico de ese punto con la consulta anterior
        $periodo = Period::all();// traemos todos los periodos que existen en la bd
        $scenario = Scenario::all();
        $variable = Variable::all();
        $datosTabla = $this->datosTabla(); //se obtienen los datos para llenar la tabla (mes, variable, promedio)
        $view =  \View::make('exportar')->with('lava',$lava)
                                        ->with('periodo',$periodo)
                                        ->with('scenario',$scenario)
                                        ->with('variable',$variable)
                                        ->with('datosTabla', $datosTabla)
                                        ->render();
        //$pdf = \PDF::loadView($view);
        //$pdf->loadHTML($view);
        //$view =  \View::make('exportar')->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //return $pdf->stream('Datos.pdf');
        return $pdf->download('Datos.pdf');
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


    public function importacion(Request $request)
    {
        $ruta = $request->input('ruta');
        $datosTabla = array();
        if ( ($handle=fopen($ruta, 'r') )!==FALSE) {
            while ( ($datos=fgetcsv($handle, 1000, ';'))!== FALSE) {

                array_push($datosTabla, $datos);
            }
            fclose($handle);
        }
        return view('importar')->with('datosTabla',$datosTabla);
        //
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
