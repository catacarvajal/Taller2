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
        $periodo = Period::all();//traemos todos los periodos que existen en la bd
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
            $consulta1 = $this->consultaGrafico('11',$periodo,$escenario,$var);             
            $variable1 = array_column($this->recorer($consulta1), 'avg');
            $consulta2 = $this->consultaGrafico('4',$periodo,$escenario,$var);        
            $variable2 = array_column($this->recorer($consulta2), 'avg');
            $consulta3 = $this->consultaGrafico('3',$periodo,$escenario,$var); 
            $variable3 = array_column($this->recorer($consulta3), 'avg');
            $consulta4 = $this->consultaGrafico('1',$periodo,$escenario,$var);        
            $variable4 = array_column($this->recorer($consulta4), 'avg');
            $consulta5 = $this->consultaGrafico('10',$periodo,$escenario,$var); 
            $variable5 = array_column($this->recorer($consulta5), 'avg');
            $consulta6 = $this->consultaGrafico('2',$periodo,$escenario,$var);        
            $variable6 = array_column($this->recorer($consulta6), 'avg');
            $consulta7 = $this->consultaGrafico('9',$periodo,$escenario,$var); 
            $variable7 = array_column($this->recorer($consulta7), 'avg');
           
            $datosTablaV1 = $this->datosTabla('11',$periodo,$escenario,$var);//numero de dias mayor a 10 grados}
            $datosTablaV2 = $this->datosTabla(4,$periodo,$escenario,$var);//radiacion solar
            $datosTablaV3 = $this->datosTabla(3,$periodo,$escenario,$var);//precipitaciones
            $datosTablaV4 = $this->datosTabla(1,$periodo,$escenario,$var);// t minima
            $datosTablaV5 = $this->datosTabla(10,$periodo,$escenario,$var);//t promedio
            $datosTablaV6 = $this->datosTabla(2,$periodo,$escenario,$var);//t maxima
            $datosTablaV7 = $this->datosTabla(9,$periodo,$escenario,$var);//evotranspiracion
          }           
           
        if ($data1 == "Circle")
        {
            $radio=$data0['radius'];//radio
            $var=implode(",", $data2[0]);  

            $consulta1 = $this->consultaGraficoCirculo('11',$periodo,$escenario,$var,$radio);
            $variable1 = array_column($this->recorer($consulta1), 'avg');
            $consulta2 = $this->consultaGraficoCirculo('4',$periodo,$escenario,$var,$radio);
            $variable2 = array_column($this->recorer($consulta2), 'avg');
            $consulta3 = $this->consultaGraficoCirculo('3',$periodo,$escenario,$var,$radio);
            $variable3 = array_column($this->recorer($consulta3), 'avg');
            $consulta4 = $this->consultaGraficoCirculo('1',$periodo,$escenario,$var,$radio);
            $variable4 = array_column($this->recorer($consulta4), 'avg');
            $consulta5 = $this->consultaGraficoCirculo('10',$periodo,$escenario,$var,$radio);
            $variable5 = array_column($this->recorer($consulta5), 'avg');
            $consulta6 = $this->consultaGraficoCirculo('2',$periodo,$escenario,$var,$radio);
            $variable6 = array_column($this->recorer($consulta6), 'avg');
            $consulta7 = $this->consultaGraficoCirculo('9',$periodo,$escenario,$var,$radio);
            $variable7 = array_column($this->recorer($consulta7), 'avg');
           
            $datosTablaV1 = $this->datosTablaCirculo('11',$periodo,$escenario,$var,$radio);//numero de dias mayor a 10 grados
            $datosTablaV2 = $this->datosTablaCirculo('4',$periodo,$escenario,$var,$radio);//radiacion solar
            $datosTablaV3 = $this->datosTablaCirculo('3',$periodo,$escenario,$var,$radio);//precipitaciones
            $datosTablaV4 = $this->datosTablaCirculo('1',$periodo,$escenario,$var,$radio);// t minima
            $datosTablaV5 = $this->datosTablaCirculo('10',$periodo,$escenario,$var,$radio);//t promedio
            $datosTablaV6 = $this->datosTablaCirculo('2',$periodo,$escenario,$var,$radio);//t maxima
            $datosTablaV7 = $this->datosTablaCirculo('9',$periodo,$escenario,$var,$radio);//evotranspiracion

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
            $consulta1 = $this->consultaGraficoPoligono('11',$periodo,$escenario,$var2);
            $variable1 = array_column($this->recorer($consulta1), 'avg');
            $consulta2 = $this->consultaGraficoPoligono('4',$periodo,$escenario,$var2);
            $variable2 = array_column($this->recorer($consulta2), 'avg');
            $consulta3 = $this->consultaGraficoPoligono('3',$periodo,$escenario,$var2);
            $variable3 = array_column($this->recorer($consulta3), 'avg');
            $consulta4 = $this->consultaGraficoPoligono('1',$periodo,$escenario,$var2);
            $variable4 = array_column($this->recorer($consulta4), 'avg');
            $consulta5 = $this->consultaGraficoPoligono('10',$periodo,$escenario,$var2);
            $variable5 = array_column($this->recorer($consulta5), 'avg');
            $consulta6 = $this->consultaGraficoPoligono('2',$periodo,$escenario,$var2);
            $variable6 = array_column($this->recorer($consulta6), 'avg');
            $consulta7 = $this->consultaGraficoPoligono('9',$periodo,$escenario,$var2);
            $variable7 = array_column($this->recorer($consulta7), 'avg');        
           
            $datosTablaV1 = $this->datosTablaPoligono('11',$periodo,$escenario,$var2);//numero de dias mayor a 10 grados
            $datosTablaV2 = $this->datosTablaPoligono('4',$periodo,$escenario,$var2);//radiacion solar
            $datosTablaV3 = $this->datosTablaPoligono('3',$periodo,$escenario,$var2);//precipitaciones
            $datosTablaV4 = $this->datosTablaPoligono('1',$periodo,$escenario,$var2);// t minima
            $datosTablaV5 = $this->datosTablaPoligono('10',$periodo,$escenario,$var2);//t promedio
            $datosTablaV6 = $this->datosTablaPoligono('2',$periodo,$escenario,$var2);//t maxima
            $datosTablaV7 = $this->datosTablaPoligono('9',$periodo,$escenario,$var2);//evotranspiracion

        }      
        return view('indexGrafico')
            ->with('variable1',json_encode($variable1,JSON_NUMERIC_CHECK))
            ->with('variable2',json_encode($variable2,JSON_NUMERIC_CHECK))
            ->with('variable3',json_encode($variable3,JSON_NUMERIC_CHECK))
            ->with('variable4',json_encode($variable4,JSON_NUMERIC_CHECK))
            ->with('variable5',json_encode($variable5,JSON_NUMERIC_CHECK))
            ->with('variable6',json_encode($variable6,JSON_NUMERIC_CHECK))
            ->with('variable7',json_encode($variable7,JSON_NUMERIC_CHECK))
            ->with('datosTablaV1',$datosTablaV1)->with('datosTablaV2',$datosTablaV2)->with('datosTablaV3',$datosTablaV3)->with('datosTablaV4',$datosTablaV4)->with('datosTablaV5',$datosTablaV5)->with('datosTablaV6',$datosTablaV6)->with('datosTablaV7',$datosTablaV7)->with('periodo',$periodo);;
           

}


public function recorer($variable){
        foreach($variable as $object)
        {
             $arrays[] =  (array) $object;
          }
          return $arrays;

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
                $lava->BarChart('grafico', $grafico, [
                    'title' => $variable,
                    'titleTextStyle' => [
                        'color'    => '#eb6b2c',
                        'fontSize' => 30
                    ],'position' => 'in',
                ]);

        return $lava;
    }


   public function DataTable($consulta, $variable)
    {
        $variableName = Variable::find($variable);

        if($consulta==0)
        {
            return 0;
        }
        else{
            $lava = new Lavacharts; // See note below for Laravel
                $grafico = $lava->DataTable();
                $grafico->addStringColumn('Months of Year')
                        ->addNumberColumn($variableName->name);
                        for($i=0; $i<count($consulta); $i++)
                        {
                            $grafico->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
                        }
                $lava->BarChart('grafico'.$variable, $grafico, [
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
    public function getGrafico($variable)
    {
        $request= (array)json_decode($variable,true);   

        $variable =$request['variable'];
        $data = $request['geoj'];         
        $data0=$data['geometry'];
        $data1=$data0['type']; //tipo de geometria
        $data2=$data0['coordinates']; //coordenadas


        $grafico = $lava->DataTable();
        $grafico->addStringColumn('Months of Year')
                ->addNumberColumn($variable);
        for($i=0; $i<count($consulta); $i++)
        {
            $grafico->addRow([$consulta[$i]->name, $consulta[$i]->avg]);
        }
        return $grafico->toJson();
    }


public function datosTabla($id_variable, $id_periodo, $id_escenario,$puntos)
    {
       // dd($id_variable);

         $consulta = DB::table('rast')
            ->select(DB::raw('month.name as mes, variable.name as variable,avg(ST_Value(rast, ST_SetSRID(ST_Point('.$puntos.'), 4326)))as promedio'))
            ->join('register', 'register.id', '=', 'rast.id_register')
            ->join('month', 'month.id', '=', 'register.id_month')
            ->join('variable', 'variable.id', '=', 'register.id_variable')
            ->join('scenario', 'scenario.id', '=', 'register.id_scenario')
            ->where('register.id_period', '=', $id_periodo)
            ->where('variable.id','=', $id_variable)
            ->where('scenario.id','=', $id_escenario)
            ->groupBy('month.id', 'variable.name')
            ->orderBy('month.id')
            ->get();
            
            return $consulta;       
    
    }
    

public function datosTablaCirculo($id_variable, $id_periodo, $id_escenario,$punto,$radio)
    {
         $consulta = DB::table('rast')
            ->select(DB::raw('month.name as mes, variable.name as variable ,AVG((ST_SummaryStats(ST_Clip(rast,1,ST_Buffer(ST_SetSRID(ST_Point('.$punto.'),4326),'.$radio.'),-9999,TRUE))).mean) as promedio'))
            ->join('register', 'register.id', '=', 'rast.id_register')
            ->join('month', 'month.id', '=', 'register.id_month')
            ->join('variable', 'variable.id', '=', 'register.id_variable')
            ->join('scenario', 'scenario.id', '=', 'register.id_scenario')
            ->where('register.id_period', '=', $id_periodo)
            ->where('variable.id','=', $id_variable)
            ->where('scenario.id','=', $id_escenario)
            ->groupBy('month.id', 'variable.name')
            ->orderBy('month.id')
            ->get();
            return $consulta;
    }
    public function datosTablaPoligono($id_variable, $id_periodo, $id_escenario,$poligono)
    {
         $consulta = DB::table('rast')
        ->select(DB::raw('month.name as mes, variable.name as variable,AVG((ST_summarystats(ST_CLIP(rast, ST_Polygon(ST_GeomFromText(\'LINESTRING('.$poligono.')\'), 4326)))).mean)as promedio'))
        ->join('register', 'register.id', '=', 'rast.id_register')
        ->join('month', 'month.id', '=', 'register.id_month')
        ->join('variable', 'variable.id', '=', 'register.id_variable')
        ->join('scenario', 'scenario.id', '=', 'register.id_scenario')
        ->where('register.id_period', '=', $id_periodo)
        ->where('variable.id','=', $id_variable)
        ->where('scenario.id','=', $id_escenario)
         ->groupBy('month.id', 'variable.name')
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
            ->where('variable.id','=', $id_variable)
            ->where('scenario.id','=', $id_escenario)
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
            ->where('variable.id','=', $id_variable)
            ->where('scenario.id','=', $id_escenario)
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
        ->where('variable.id','=', $id_variable)
        ->where('scenario.id','=', $id_escenario)
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