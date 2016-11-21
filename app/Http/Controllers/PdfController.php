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

class PdfController extends Controller
{
    public function grafico() 
    {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
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
        $pdf = \App::make('dompdf.wrapper');
        //$pdf->loadHTML($view);
        $pdf->loadHTML('<div>
                <section id="content_id">
                    <div class="content" >
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="box-body no-padding">
      <div class="box box-info color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title">
          <i class="fa fa-bar-chart" aria-hidden="true"></i> Estadísticas
          </h3>
          <a id="xml" class="btn btn-primary btn-flat pull-right">Json</a>
          <a id="xml" class="btn btn-primary btn-flat pull-right">XML</a>
          <a id="csv" class="btn btn-primary btn-flat pull-right">CSV</a>
          <a href="/pdf" class="btn btn-primary btn-flat pull-right">PDF</a>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12 ">
              <div id="perf_div" class="chart" ></div><!-- div donde se dibuja el grafico -->
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 ">
                  <div class="row">
      <div class="col-md-12">
        <div class="box box-success">   
          <div class="box-header with-border">
            <h3 class="box-title">Datos de: minimum temperature</h3>
          </div> 
          <div class="box-body">
            <table class="table table-bordered" id="tabla">
              <tr>
                <th>Mes</th>
                <th style="width: 600px">Variable</th>
                <th style="width: 20px">Promedio</th>
              </tr>
                   
                <tr>
                  <td>february</td>
                  <td><span class="badge bg-blue">minimum temperature</td>
                  <td><span class="badge bg-red">103</span></td>
                </tr>
                   
                <tr>
                  <td>january</td>
                  <td><span class="badge bg-blue">minimum temperature</td>
                  <td><span class="badge bg-red">114</span></td>
                </tr>
                   
                <tr>
                  <td>march</td>
                  <td><span class="badge bg-blue">minimum temperature</td>
                  <td><span class="badge bg-red">82</span></td>
                </tr>
                          
              
            </table>
          </div><!-- /.box-body -->


        </div>
      </div>
    </div>
                                 <!-- Fin creación de tabla -->
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </section>
</div>');
        return $pdf->stream('Datos.pdf');
    }
 
    public function getData() 
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
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
