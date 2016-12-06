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
        $consultaPunto = $this->consultaGraficoInicio(1,1,1);//hacemos la consulta de 1 punto
        $lava = $this->graficoPunto($consultaPunto,'');//hacemos el gráfico de ese punto con la consulta anterior
        $periodo = Period::all();// traemos todos los periodos que existen en la bd
        $scenario = Scenario::all();
        $variable = Variable::all();
        $datosTabla = $this->datosTabla(1,1); //se obtienen los datos para llenar la tabla (mes, variable, promedio)

        return view('indexGrafico')-> with('lava',$lava)->with('periodo',$periodo)->with('scenario',$scenario)->with('variable',$variable)->with('datosTabla', $datosTabla);
      
    }

    public function nuevaVentana($tipo)
    {
        $request= (array)json_decode($tipo,true);   

        $escenario =$request['escenario'];
        $periodo =$request['periodo'];
        $data = $request['geoj'];         
        $data0=$data['geometry'];
        $data1=$data0['type']; //tipo de geometria
        $data2=$data0['coordinates']; //coordenadas  

        if ($data1=="Point"){

            $var=implode(",", $data2);  
            $consultaPunto1 = $this->consultaGrafico('11',$periodo,$escenario,$var);
            $consultaPunto2 = $this->consultaGrafico('4',$periodo,$escenario,$var);
            $consultaPunto3= $this->consultaGrafico('3',$periodo,$escenario,$var);
            $consultaPunto4 = $this->consultaGrafico('1',$periodo,$escenario,$var);      
            $consultaPunto5 = $this->consultaGrafico('10',$periodo,$escenario,$var);  
            $consultaPunto6 = $this->consultaGrafico('2',$periodo,$escenario,$var);  
            $consultaPunto7 = $this->consultaGrafico('9',$periodo,$escenario,$var);    
            $lava1 = $this->DataTable1($consultaPunto1,'11');
            $lava2 = $this->DataTable2($consultaPunto2,'4');
            $lava3 = $this->DataTable3($consultaPunto3,'3');
            $lava4 = $this->DataTable4($consultaPunto4,'1');
            $lava5 = $this->DataTable5($consultaPunto1,'10');
            $lava6 = $this->DataTable6($consultaPunto2,'2');
            $lava7 = $this->DataTable7($consultaPunto3,'9');
           // $lava = $this->DataTable($consultaPunto,$variableSelect);
        }
        if ($data1 == "Circle")
        {
            $radio=$data0['radius'];//radio
            $var=implode(",", $data2[0]);           
            $consultaCirculo1 = $this->consultaGraficoCirculo('11',$periodo,$escenario,$var,$radio);
            $consultaCirculo2 = $this->consultaGraficoCirculo('4',$periodo,$escenario,$var,$radio);
            $consultaCirculo3 = $this->consultaGraficoCirculo('3',$periodo,$escenario,$var,$radio);
            $consultaCirculo4 = $this->consultaGraficoCirculo('1',$periodo,$escenario,$var,$radio);
            $consultaCirculo5 = $this->consultaGraficoCirculo('10',$periodo,$escenario,$var,$radio);
            $consultaCirculo6 = $this->consultaGraficoCirculo('2',$periodo,$escenario,$var,$radio);
            $consultaCirculo7 = $this->consultaGraficoCirculo('9',$periodo,$escenario,$var,$radio);
            $lava1 = $this->DataTable1($consultaCirculo1,'11');
            $lava2 = $this->DataTable2($consultaCirculo2,'4');
            $lava3 = $this->DataTable3($consultaCirculo3,'3');
            $lava4 = $this->DataTable4($consultaCirculo4,'1');
            $lava5 = $this->DataTable5($consultaCirculo4,'10');
            $lava6 = $this->DataTable6($consultaCirculo4,'2');
            $lava7 = $this->DataTable7($consultaCirculo4,'9');

        }
        if($data1=="Polygon" )
        {
            $var1=$data2[0];
            $var2="";
            foreach ($var1 as & $valor) {
           
                $var=implode(" ", $valor);
                $var2=$var.",".$var2;
            }                
            $var2 = substr($var2, 0, -1);       
            $consultaPoligono1 = $this->consultaGraficoPoligono('11',$periodo,$escenario,$var2);
            $consultaPoligono2 = $this->consultaGraficoPoligono('4',$periodo,$escenario,$var2);
            $consultaPoligono3 = $this->consultaGraficoPoligono('3',$periodo,$escenario,$var2);
            $consultaPoligono4 = $this->consultaGraficoPoligono('1',$periodo,$escenario,$var2);
            $consultaPoligono5 = $this->consultaGraficoPoligono('10',$periodo,$escenario,$var2);
            $consultaPoligono6 = $this->consultaGraficoPoligono('2',$periodo,$escenario,$var2);
            $consultaPoligono7 = $this->consultaGraficoPoligono('9',$periodo,$escenario,$var2);
            $lava1 = $this->DataTable1($consultaPoligono1,'11');
            $lava2 = $this->DataTable2($consultaPoligono2,'4');
            $lava3 = $this->DataTable3($consultaPoligono3,'3');
            $lava4 = $this->DataTable4($consultaPoligono4,'1');
            $lava5 = $this->DataTable5($consultaPoligono5,'10');
            $lava6 = $this->DataTable6($consultaPoligono6,'2');
            $lava7 = $this->DataTable7($consultaPoligono7,'9');
        }  
        
        $datosTabla1 = $this->datosTabla('1',$periodo);
        $datosTabla2 = $this->datosTabla('2',$periodo);
        $datosTabla3 = $this->datosTabla('3',$periodo);
        $datosTabla4 = $this->datosTabla('4',$periodo);
        $datosTabla5 = $this->datosTabla('5',$periodo);
        $datosTabla6 = $this->datosTabla('6',$periodo);
        $datosTabla7 = $this->datosTabla('7',$periodo);


       return view('indexGrafico')->with('lava1',$lava1)->with('lava2',$lava2)->with('lava3',$lava3)->with('lava4',$lava4)->with('lava5',$lava5)->with('lava6',$lava6)->with('lava7',$lava7)->with('datosTabla1',$datosTabla1)->with('datosTabla2',$datosTabla2)->with('datosTabla3',$datosTabla3)->with('datosTabla4',$datosTabla4)->with('datosTabla5',$datosTabla5)->with('datosTabla6',$datosTabla6)->with('datosTabla7',$datosTabla7)->with('periodo',$periodo);
    }

   public function graficoPunto($consulta,$variable)
    {
        
        $lava = new Lavacharts; // See note below for Laravel
                $grafico = $lava->DataTable();
                $grafico->addStringColumn('Months of Year')
                        ->addNumberColumn($variable);
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico1', $grafico1, [
                    'title' => $variable,
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ],'position' => 'in',
                ]);

        return $lava;
    }


   public function DataTable1($consulta, $variable)
    {
        $variableName = Variable::find($variable);

        if($consulta==0)
        {
            return 0;
        }
        else{
            $lava = new Lavacharts; // See note below for Laravel
                $grafico1 = $lava->DataTable();
                $grafico1->addStringColumn('Months of Year')
                        ->addNumberColumn($variableName->name);
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico1->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico1', $grafico1, [
                    'title' => $variableName->name,
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ],'position' => 'in',
                ]);
        }
        return $lava;
    }
    public function DataTable2($consulta, $variable)
    {
        $variableName = Variable::find($variable);

        if($consulta==0)
        {
            return 0;
        }
        else{
            $lava = new Lavacharts; // See note below for Laravel
                $grafico2 = $lava->DataTable();
                $grafico2->addStringColumn('Months of Year')
                        ->addNumberColumn($variableName->name);
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico2->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico2', $grafico2, [
                    'title' => $variableName->name,
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ],'position' => 'in',
                ]);
        }
        return $lava;
    }
    public function DataTable3($consulta, $variable)
    {
        $variableName = Variable::find($variable);

        if($consulta==0)
        {
            return 0;
        }
        else{
            $lava = new Lavacharts; // See note below for Laravel
                $grafico3 = $lava->DataTable();
                $grafico3->addStringColumn('Months of Year')
                        ->addNumberColumn($variableName->name);
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico3->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico3', $grafico3, [
                    'title' => $variableName->name,
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ],'position' => 'in',
                ]);
        }
        return $lava;
    }
    public function DataTable4($consulta, $variable)
    {
        $variableName = Variable::find($variable);

        if($consulta==0)
        {
            return 0;
        }
        else{
            $lava = new Lavacharts; // See note below for Laravel
                $grafico4 = $lava->DataTable();
                $grafico4->addStringColumn('Months of Year')
                        ->addNumberColumn($variableName->name);
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico4->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico4', $grafico4, [
                    'title' => $variableName->name,
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ],'position' => 'in',
                ]);
        }
        return $lava;
    }
    public function DataTable5($consulta, $variable)
    {
        $variableName = Variable::find($variable);

        if($consulta==0)
        {
            return 0;
        }
        else{
            $lava = new Lavacharts; // See note below for Laravel
                $grafico5 = $lava->DataTable();
                $grafico5->addStringColumn('Months of Year')
                        ->addNumberColumn($variableName->name);
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico5->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico5', $grafico5, [
                    'title' => $variableName->name,
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ],'position' => 'in',
                ]);
        }
        return $lava;
    }
    public function DataTable6($consulta, $variable)
    {
        $variableName = Variable::find($variable);

        if($consulta==0)
        {
            return 0;
        }
        else{
            $lava = new Lavacharts; // See note below for Laravel
                $grafico6 = $lava->DataTable();
                $grafico6->addStringColumn('Months of Year')
                        ->addNumberColumn($variableName->name);
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico6->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico6', $grafico6, [
                    'title' => $variableName->name,
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ],'position' => 'in',
                ]);
        }
        return $lava;
    }
    public function DataTable7($consulta, $variable)
    {
        $variableName = Variable::find($variable);

        if($consulta==0)
        {
            return 0;
        }
        else{
            $lava = new Lavacharts; // See note below for Laravel
                $grafico7 = $lava->DataTable();
                $grafico7->addStringColumn('Months of Year')
                        ->addNumberColumn($variableName->name);
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico7->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico7', $grafico7, [
                    'title' => $variableName->name,
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ],'position' => 'in',
                ]);
        }
        return $lava;
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

    public function consultaGrafico($id_variable, $id_periodo, $id_escenario,$puntos)
    {

             $consulta = DB::table('rast')
            ->select(DB::raw('month.name,month.id,avg(ST_Value(rast, ST_SetSRID(ST_Point('.$puntos.'), 4326)))'))
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

     public function consultaGraficoCirculo($id_variable, $id_periodo, $id_escenario,$punto,$radio)
    {

             $consulta = DB::table('rast')
            ->select(DB::raw('month.name,month.id,AVG((ST_SummaryStats(ST_Clip(rast,1,ST_Buffer(ST_SetSRID(ST_Point('.$punto.'),4326),'.$radio.'),-9999,TRUE))).mean)'))
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

    public function consultaGraficoPoligono($id_variable, $id_periodo, $id_escenario,$poligono)
    {
     
        $consulta = DB::table('rast')
        ->select(DB::raw('month.name,month.id,AVG((ST_summarystats(ST_CLIP(rast, ST_Polygon(ST_GeomFromText(\'LINESTRING('.$poligono.')\'), 4326)))).mean)'))
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


    public function ajaxGeoJson( $request){

        dd($Request);
        $variable =$request->input('variable');
  
        $escenario =$request->input('escenario');
        $periodo =$request->input('periodo');
        $data = $request->input('geoj');       
        
       
        $data0=$data['geometry'];
        $data1=$data0['type']; //tipo de geometria
        $data2=$data0['coordinates']; //coordenadas 
        $variableSelect = Variable::find($variable)->name;
        
       
        if ($data1=="Point"){

            $var=implode(",", $data2);  

            $consultaPunto = $this->consultaGrafico($variable,$periodo,$escenario,$var);
            $lava = $this->DataTable($consultaPunto,$variableSelect);
        }
        if ($data1 == "Circle")
        {
            $radio=$data0['radius'];//radio
            $var=implode(",", $data2[0]);           
            $consultaCirculo = $this->consultaGraficoCirculo($variable,$periodo,$escenario,$var,$radio);
            $lava = $this->DataTable($consultaCirculo,$variableSelect);
        }
        if($data1=="Polygon" )
        {
            $var1=$data2[0];
            $var2="";
            foreach ($var1 as & $valor) {
           
            $var=implode(" ", $valor);
            $var2=$var.",".$var2;
}
             
            $var2 = substr($var2, 0, -1);
            
                       
            $consultaPoligono = $this->consultaGraficoPoligono($variable,$periodo,$escenario,$var2);
            $lava = $this->DataTable($consultaPoligono,$variableSelect);
        }       
       // return $lava->tojson();
    
 /*       $data = $request->input('geoj');       
        
        $dat=json_decode($data,true);
        $data0=$dat['geometry'];
        $data1=$data0['type']; //tipo de geometria
        $data2=$data0['coordinates']; //cordenadas 

        $data = $request->input('variable');
        return response()->json(array('msg'=> $periodo), 200);*/
    }



     

    




}