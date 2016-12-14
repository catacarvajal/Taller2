<?php
namespace App\Http\Controllers;
use Illuminate\Support\Collection as Collection;
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
        dd($tipo, $request);
        $escenario =$request['escenario'];
        $periodo =$request['periodo'];
        $data = $request['geoj'];         
        $data0=$data['geometry'];
        $data1=$data0['type']; //tipo de geometria
        $data2=$data0['coordinates']; //coordenadas  

        if ($data1=="Point"){

            $var=implode(",", $data2);  
            $consulta = $this->consultaGrafico('11',$periodo,$escenario,$var);
            $lava= $this->DataTable($consulta,'11');
           // $lava = $this->DataTable($consultaPunto,$variableSelect);
        }
        if ($data1 == "Circle")
        {
            $radio=$data0['radius'];//radio
            $var=implode(",", $data2[0]);           
            $consulta = $this->consultaGraficoCirculo('11',$periodo,$escenario,$var,$radio);
            $lava = $this->DataTable($consulta,'11');

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
            $consulta = $this->consultaGraficoPoligono('11',$periodo,$escenario,$var2);
            $lava = $this->DataTable($consulta,'11');
        }  
        
        $datosTabla = $this->datosTabla('1',$periodo);

       return view('indexGrafico')->with('lava',$lava)->with('datosTabla',$datosTabla)->with('periodo',$periodo)->with('consulta',$consulta);
    }

    public function abrirFile(Request $request)
    {
        $file2 = $request->file('archivo');
        $path = $file2->getRealPath();

        $options = array('noparts' => false);
        $shp = new ShapeFile; 

        $shp->ShapeFile($path, $options);
        $var = $shp->getNext();
        $points = $var->getShpData()['parts'][0];

            
        $puntos = Collection::make($points);

        //dd($puntos->first());

        $json = response()->json([
                'periodo' => '1',
                'escenario' => '1',
                'geoj' => response()->json([ 
                        'type' => 'Feature', 
                        'geometry' => response()->json([
                                    'coordinates' => $puntos])->content()
                                    ])->content()
                ]);

        $json3 = response()->json([
                'type' => 'Feature'
            ]);

        //dd($json3->content());

        $json2 = response()->json([
                'geoj' => ['type' => 'Feature']
            ]);

        $request= (array)json_decode($json2->content(),true); 

        dd($json2->content(), $request);

        return view('abrir');
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
                $lava->BarChart('grafico', $grafico, [
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


define("SHOW_ERRORS", true);
define("DEBUG", false);

define("XY_POINT_RECORD_LENGTH", 16);

define("ERROR_FILE_NOT_FOUND", "SHP File not found [%s]");
define("INEXISTENT_RECORD_CLASS", "Unable to determine shape record type [%i]");
define("INEXISTENT_FUNCTION", "Unable to find reading function [%s]");
define("INEXISTENT_DBF_FILE", "Unable to open (read/write) SHP's DBF file [%s]");
define("INCORRECT_DBF_FILE", "Unable to read SHP's DBF file [%s]");
define("UNABLE_TO_WRITE_DBF_FILE", "Unable to write DBF file [%s]");

class ShapeFile{
    private $file_name;
    private $fp;
    //Used to fasten up the search between records;
    private $dbf_filename = null;
    //Starting position is 100 for the records
    private $fpos = 100;

    private $error_message = "";
    private $show_errors   = SHOW_ERRORS;

    private $shp_bounding_box = array();
    private $shp_type         = 0;

    public $records;

    function ShapeFile($file_name,$options){
        $this->options = $options;

        $this->file_name = $file_name;
        //_d("Opening [$file_name]");
        if(!is_readable($file_name)){
            return $this->setError( sprintf(ERROR_FILE_NOT_FOUND, $file_name) );
        }

        $this->fp = fopen($this->file_name, "rb");

        $this->_fetchShpBasicConfiguration();

        //Set the dbf filename
        $this->dbf_filename = processDBFFileName($this->file_name);

    }


    public function getError(){
        return $this->error_message;
    }


    function __destruct()
    {
        $this->closeFile();
    }

    // Data fetchers
    private function _fetchShpBasicConfiguration(){
        fseek($this->fp, 32, SEEK_SET);
        $this->shp_type = readAndUnpack("i", fread($this->fp, 4));
        $this->shp_bounding_box = readBoundingBox($this->fp);
    }



    public function getNext(){

        if (!feof($this->fp)) {
            fseek($this->fp, $this->fpos);
            $shp_record = new ShapeRecord;
            $shp_record->ShapeRecord($this->fp, $this->dbf_filename,$this->options);

            if($shp_record->getError() != ""){
                return false;
            }
            $this->fpos = $shp_record->getNextRecordPosition();
            return $shp_record;
        }
        return false;
    }

    // General functions
    private function setError($error){
        $this->error_message = $error;
        if($this->show_errors){
            echo $error."\n";
        }
        return false;
    }

    private function closeFile(){
        if($this->fp){
            fclose($this->fp);
        }
    }
}


/**
    * ShapeRecord
    *
    */
class ShapeRecord{
    private $fp;
    private $fpos = null;

    private $dbf = null;

    private $record_number     = null;
    private $content_length    = null;
    private $record_shape_type = null;

    private $error_message     = "";

    private $shp_data = array();
    private $dbf_data = array();

    private $file_name = "";

    private $record_class = array(  0 => "RecordNull",
        1 => "RecordPoint",
        8 => "RecordMultiPoint",
        3 => "RecordPolyLine",
        5 => "RecordPolygon",
        13 => "RecordMultiPointZ",
        11 => "RecordPointZ");

    function ShapeRecord(&$fp, $file_name,$options){
        $this->fp = $fp;
        $this->fpos = ftell($fp);
        $this->options = $options;
        if (feof($fp)) {
            echo "end ";
            exit;
        }
        $this->_readHeader();
        $this->file_name = $file_name;

    }

    public function getNextRecordPosition(){
        $nextRecordPosition = $this->fpos + ((4 + $this->content_length )* 2);
        return $nextRecordPosition;
    }

    private function _readHeader(){
        $this->record_number     = readAndUnpack("N", fread($this->fp, 4));
        $this->content_length    = readAndUnpack("N", fread($this->fp, 4));
        $this->record_shape_type = readAndUnpack("i", fread($this->fp, 4));


    }

    private function getRecordClass(){
        if(!isset($this->record_class[$this->record_shape_type])){
            return $this->setError( sprintf(INEXISTENT_RECORD_CLASS, $this->record_shape_type) );
        }
        return $this->record_class[$this->record_shape_type];
    }

    private function setError($error){
        $this->error_message = $error;
        return false;
    }

    public function getError(){
        return $this->error_message;
    }

    public function getShpData(){
//        $function_name = "read".$this->getRecordClass();
//$function_name = 
 $this->shp_data = readRecordPolygon($this->fp,$this->options);
 //       if(function_exists($function_name)){
//            $this->shp_data = $function_name($this->fp,$this->options);
//
  //      } else {
    //        $this->setError( sprintf(INEXISTENT_FUNCTION, $function_name) );
     //   }

        return $this->shp_data;
    }

    public function getDbfData(){

        $this->_fetchDBFInformation();

        return $this->dbf_data;
    }

    private function _openDBFFile($check_writeable = false){
        $check_function = $check_writeable ? "is_writable" : "is_readable";
        if($check_function($this->file_name)){
            $this->dbf = dbase_open($this->file_name, ($check_writeable ? 2 : 0));
            if(!$this->dbf){
                $this->setError( sprintf(INCORRECT_DBF_FILE, $this->file_name) );
            }
        } else {
            $this->setError( sprintf(INEXISTENT_DBF_FILE, $this->file_name) );
        }
    }

    private function _closeDBFFile(){
        if($this->dbf){
            dbase_close($this->dbf);
            $this->dbf = null;
        }
    }

    private function _fetchDBFInformation(){
        $this->_openDBFFile();
        if($this->dbf) {
            $this->dbf_data = @dbase_get_record_with_names($this->dbf, $this->record_number);
        } else {
            $this->setError( sprintf(INCORRECT_DBF_FILE, $this->file_name) );
        }
        $this->_closeDBFFile();
    }

    public function setDBFInformation($row_array){
        $this->_openDBFFile(true);
        if($this->dbf) {
            unset($row_array["deleted"]);

            if(!dbase_replace_record($this->dbf, array_values($row_array), $this->record_number)){
                $this->setError( sprintf(UNABLE_TO_WRITE_DBF_FILE, $this->file_name) );
            } else {
                $this->dbf_data = $row_array;
            }
        } else {
            $this->setError( sprintf(INCORRECT_DBF_FILE, $this->file_name) );
        }
        $this->_closeDBFFile();
    }
}


function readRecordNull(&$fp, $read_shape_type = false,$options = null){

    $data = array();

    if($read_shape_type) $data += readShapeType($fp);

    //_d("Returning Null shp_data array = ".getArray($data));

    return $data;

}

$point_count = 0;
function readRecordPoint(&$fp, $create_object = false,$options = null){
    global $point_count;
    $data = array();

    $data["x"] = readAndUnpack("d", fread($fp, 8));
    $data["y"] = readAndUnpack("d", fread($fp, 8));
    $point_count++;
    return $data;
}

function readRecordPointZ(&$fp, $create_object = false,$options = null){
    global $point_count;
    $data = array();

    $data["x"] = readAndUnpack("d", fread($fp, 8));
    $data["y"] = readAndUnpack("d", fread($fp, 8));
    $point_count++;
    return $data;
}

function readRecordPointZSP($data, &$fp){

    $data["z"] = readAndUnpack("d", fread($fp, 8));

    return $data;
}

function readRecordPointMSP($data, &$fp){

    $data["m"] = readAndUnpack("d", fread($fp, 8));

    return $data;
}

function readRecordMultiPoint(&$fp,$options = null){
    $data = readBoundingBox($fp);
    $data["numpoints"] = readAndUnpack("i", fread($fp, 4));

    for($i = 0; $i <= $data["numpoints"]; $i++){
        $data["points"][] = readRecordPoint($fp);
    }
    return $data;
}

function readRecordPolyLine(&$fp,$options = null){
    $data = readBoundingBox($fp);
    $data["numparts"]  = readAndUnpack("i", fread($fp, 4));
    $data["numpoints"] = readAndUnpack("i", fread($fp, 4));

    if (isset($options['noparts']) && $options['noparts']==true) {
        $points_initial_index = ftell($fp)+4*$data["numparts"];
        $points_read = $data["numpoints"];
    }
    else{
        for($i=0; $i<$data["numparts"]; $i++){
            $data["parts"][$i] = readAndUnpack("i", fread($fp, 4));
        }

        $points_initial_index = ftell($fp);
        $points_read = 0;
        foreach($data["parts"] as $part_index => $point_index){
            if(!isset($data["parts"][$part_index]["points"]) || !is_array($data["parts"][$part_index]["points"])){
                $data["parts"][$part_index] = array();
                $data["parts"][$part_index]["points"] = array();
            }
            while( ! in_array( $points_read, $data["parts"]) && $points_read < $data["numpoints"] && !feof($fp)){
                $data["parts"][$part_index]["points"][] = readRecordPoint($fp, true);
                $points_read++;
            }
        }
    }

    fseek($fp, $points_initial_index + ($points_read * XY_POINT_RECORD_LENGTH));
    return $data;
}

function readRecordMultiPointZ(&$fp,$options = null){
    $data = readBoundingBox($fp);
    $data["numparts"]  = readAndUnpack("i", fread($fp, 4));
    $data["numpoints"] = readAndUnpack("i", fread($fp, 4));
    $fileX = 44 + (4*$data["numparts"]);
    $fileY = $fileX + (16*$data["numpoints"]);
    $fileZ = $fileY + 16 + (8*$data["numpoints"]);

    if (isset($options['noparts']) && $options['noparts']==true) {
        $points_initial_index = ftell($fp)+4*$data["numparts"];
        $points_read = $data["numpoints"];
    }
    else{
        for($i=0; $i<$data["numparts"]; $i++){
            $data["parts"][$i] = readAndUnpack("i", fread($fp, 4));
        }
        $points_initial_index = ftell($fp);
        $points_read = 0;
        foreach($data["parts"] as $part_index => $point_index){
            if(!isset($data["parts"][$part_index]["points"]) || !is_array($data["parts"][$part_index]["points"])){
                $data["parts"][$part_index] = array();
                $data["parts"][$part_index]["points"] = array();
            }
            while( ! in_array( $points_read, $data["parts"]) && $points_read < $data["numpoints"]/* && !feof($fp)*/){
                $data["parts"][$part_index]["points"][] = readRecordPoint($fp, true);
                $points_read++;
            }
        }

        $data['Zmin'] = readAndUnpack("d", fread($fp, 8));
        $data['Zmax'] = readAndUnpack("d", fread($fp, 8));

        foreach($data["parts"] as $part_index => $point_index){
            foreach($point_index["points"] as $n => $p){
                $data["parts"][$part_index]['points'][$n] = readRecordPointZSP($p, $fp, true);
            }
        }

        $data['Mmin'] = readAndUnpack("d", fread($fp, 8));
        $data['Mmax'] = readAndUnpack("d", fread($fp, 8));

        foreach($data["parts"] as $part_index => $point_index){
            foreach($point_index["points"] as $n => $p){
                $data["parts"][$part_index]['points'][$n] = readRecordPointMSP($p, $fp, true);
            }
        }
    }

    fseek($fp, $points_initial_index + ($points_read * XY_POINT_RECORD_LENGTH));
    return $data;
}

function readRecordPolygon(&$fp,$options = null){
    return readRecordPolyLine($fp,$options);
}

/**
    * General functions
    */
function processDBFFileName($dbf_filename){
    if(!strstr($dbf_filename, ".")){
        $dbf_filename .= ".dbf";
    }

    if(substr($dbf_filename, strlen($dbf_filename)-3, 3) != "dbf"){
        $dbf_filename = substr($dbf_filename, 0, strlen($dbf_filename)-3)."dbf";
    }
    return $dbf_filename;
}

function readBoundingBox(&$fp){
    $data = array();
    $data["xmin"] = readAndUnpack("d",fread($fp, 8));
    $data["ymin"] = readAndUnpack("d",fread($fp, 8));
    $data["xmax"] = readAndUnpack("d",fread($fp, 8));
    $data["ymax"] = readAndUnpack("d",fread($fp, 8));
    return $data;
}

function readAndUnpack($type, $data){
    if(!$data) return $data;
    return current(unpack($type, $data));
}

function _d($debug_text){
    if(DEBUG){
        echo $debug_text."\n";
    }
}

function getArray($array){
    ob_start();
    print_r($array);
    $contents = ob_get_contents();
    ob_get_clean();
    return $contents;
}
