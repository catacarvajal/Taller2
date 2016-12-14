@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box-body no-padding">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Bienvenidos</h4>

                <p>Este sitio presenta información de distintas variables ambientales, las cuales se pueden graficar y visualizar según un periodo de tiempo determinado. Los datos que encontrará a continuación han sido generados a partir de modelos atmosféricos y datos satelitales.
                    Este gran esfuerzo computacional y científico ha sido llevado a cabo por el equipo de la Universidad de Talca para el modulo de Taller 2.
                </p>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 ">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div id="fullscreen" class="fullscreen">
                            <div id="map" class="map">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <form role="form" id= "formG" ><!-- method="POST" action="{{ url('/Grafico')}}-->
                 {!! csrf_field() !!}
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                        Selección de capa</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <ul class="users-list clearfix">
                                        <li>                            
                                            <img src="http://thumbs.subefotos.com/33c9bb8d542bd1d85843f9e9147b80b7o.jpg">
                                            <a class="users-list-name" href="#">color</a>
                                        </li>
                                        <li>
                                            <img src="http://thumbs.subefotos.com/8432ce8bf350130bd1d09bedf24a8a4fo.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Imagenes</a>
                                        </li>
                                        <li>
                                            <img src="http://thumbs.subefotos.com/2b8c55deb4d54d7f37ca870c16fba621o.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Toner</a>
                                        </li>
                                        <li>
                                            <img src="http://thumbs.subefotos.com/46a1681d6309c3e11c0a5b091a9057efo.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">OSM</a>
                                        </li>
                                    </ul><!-- /.users-list -->
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                        Visualización</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Periodo</label>
                                                {!!Form::select('Periodo', array_pluck($periodo, 'year_init', 'id'), null, ['id'=>'Periodo','class' => 'form-control','onchange' => 'setgraficoValue(this.value);']) !!}
                                            </div>
                                        </div><!-- /.form-group -->  
                                    </div>
                                    <div class="row">       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Escenario</label>
                                                {!!Form::select('Escenario', array_pluck($scenario, 'name', 'id'), null, ['id'=>'Escenario','class' => 'form-control','onchange' => 'setgraficoValue(this.value);']) !!}
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mes: &nbsp;</label>
                                                <select class="form-control select2 input-sm" id="Var" onchange="cambiarRaster()">
                                                    <option value=1 >Enero</option>
                                                    <option value=2 >Febrero</option>
                                                    <option value=3 >Marzo</option>
                                                    <option value=4 >Abril</option>
                                                    <option value=5 >Mayo</option>
                                                    <option value=6 >Junio</option>
                                                    <option value=7 >Julio</option>
                                                    <option value=8 >Agosto</option>
                                                    <option value=9 >Septiembre</option>
                                                    <option value=10 >Octubre</option>
                                                    <option value=11 >Noviembre</option>
                                                    <option value=12 >Diciembre</option>
                                                </select>
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.panel info 2 -->
                        
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                        Variables
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body"> 
                                    <!-- checkbox -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >{!! Form::radio('name', 'Mes')!!} <i class="fa fa-calendar-o" ></i>   {{ $variable[0]->name }}</label>
                                            </div>
                                        </div><!-- /.form-group -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >{!! Form::radio('name', 'Mes')!!} <i class="fa fa-sun-o" ></i>   {{ $variable[1]->name }}</label>
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >{!! Form::radio('name', 'Mes')!!} <i class="fa fa-umbrella" ></i>   {{ $variable[2]->name }}</label>
                                            </div>
                                        </div><!-- /.form-group -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >{!! Form::radio('name', 'Mes')!!} <i class="fa fa-thermometer-full" ></i>   {{ $variable[3]->name }}</label>
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >{!! Form::radio('name', 'Mes')!!} <i class="fa fa-thermometer-empty" ></i>   {{ $variable[4]->name }}</label>
                                            </div>
                                        </div><!-- /.form-group -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >{!! Form::radio('name', 'Mes')!!} <i class="fa fa-thermometer-half" ></i>   {{ $variable[5]->name }}</label>
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >{!! Form::radio('name', 'Mes')!!} <i class="fa fa-cloud" ></i>   {{ $variable[6]->name }}</label>
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.panel info 4 -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                        Geometría</a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="users-list clearfix">
                                        <li>                            
                                            <img src="http://www.ifriedegg.com/Images%209/Punto.jpg">
                                            <a class="users-list-name">Punto</a>
                                        </li>
                                        <li>
                                            <img src="http://definicion.de/wp-content/uploads/2012/08/cuadrado.jpg" alt="User Image">
                                            <a class="users-list-name" >Cuadrado</a>
                                        </li>
                                        <li>
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoCep2JBhGOOFCTc52UVD2vVHr0cRc4PvoCEIvKLkS3pB3rtAqzg" alt="User Image">
                                            <a class="users-list-name" >Polígono</a>
                                        </li>
                                        <li>
                                            <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQYtHuH2Xr_LyWeq5tDAsElDIRcMUrQ5fKwt07moJ7jNddB0zLGKA" href="#" alt="User Image">
                                            <a class="users-list-name">Circulo</a>
                                        </li>

                                    </ul><!-- /.users-list -->

                                    <div class="form-group ">
                                        <label>Seleccione Geometría: &nbsp;</label>
                                        <select class="form-control select2 input-sm" id="type">
                                            <option value="None">Ninguno</option>
                                            <option value="Point">Punto</option>
                                            <option value="Polygon">Poligono</option>
                                            <option value="Circle">Circulo</option>
                                            <option value="Square">Cuadrado</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 ">                   
                                            <button class="btn btn-block btn-primary btn-xs" id="   btn-grafico" title="Visualizar" onclick="grafico()">Visualizar Graficos
                                            </button> 
                                        </div>
                                        <div class="col-md-6 ">                 
                                            <button class="btn btn-block btn-danger btn-xs" type="button" data-toggle="control-dibujo" title="Eliminar" onclick='removeDraw()'> <i class="fa fa-trash"></i> Eliminar Polígono</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.panel info 5 -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                        Datos por Región/Provincia</a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">  
                                            <div class="form-group ">
                                                <label>Tipo: &nbsp;</label>
                                                <select class="form-control select2 input-sm" id="ir_tipo">
                                                    <option value="None">Seleccione</option>
                                                    <option value="Regiones">Regiones</option>
                                                    <option value="Provincias">Provincias</option>                      
                                                    <option value="cuidades">Ciudades</option>                      
                                                </select>
                                                <label>Sub tipo: &nbsp;</label>
                                                <select class="form-control select2 input-sm" id="ir_sub_tipo">
                                                    <option value="None">Seleccione</option>
                                                    <option value="Curico">Curicó</option>
                                                    <option value="Arica">Arica</option>                        
                                                    <option value="cuidades">Ciudades</option>                      
                                                </select>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 ">                   
                                            <button class="btn btn-block btn-primary btn-xs" id="btn-grafico" title="Visulizar" onclick="window.open('Grafico')">Visualizar Graficos</button> 
                                        </div>
                                        <div class="col-md-6 ">                 
                                            <button class="btn btn-block btn-danger btn-xs" type="button" data-toggle="control-dibujo" title="Eliminar" onclick='removeDraw()'> <i class="fa fa-trash"></i> Eliminar Polígono</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                        Importación / exportación</a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
                                     <div class="row">
                                        <div class="col-md-6 ">                   
                                            <button class="btn btn-block btn-success btn-lg" id="btn-Importar" title="Importar" ><i class="fa fa-cloud-upload"></i> Importar Datos</button> 
                                        </div>
                                        <div class="col-md-6 ">                 
                                            <button class="btn btn-block btn-warning btn-lg" id="btn-Exportar" title="Exportar" > <i class="fa fa-cloud-download"></i> Exportar datos</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                        Shapefile</a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        {!! Form::open(['url' => '/cargar', 'class' => 'form-horizontal', 'files' => true]) !!}
                                        {!! Form::file('archivo', ['id' => 'file', 'type' => 'file', 'multiple class' => '', 'data-overwrite-initial' => 'false', 'data-min-file-count' => '1' , 'data-max-file-count' => '1' ]) !!}
                                        {!! Form::submit('Visualizar graficos', ['class' => 'btn btn-block btn-primary btn-xs', 'id' => 'cargar', 'style' => 'width:30%; margin-left:3%;margin-top:3%;']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div><!--content-->

<script type="text/javascript">
    
    // jQuery example
    function setgraficoValue(value)
    {
      var parametros = {
        "periodo" : $("#Periodo").val(),
        "variable" : $("#Variable").val(),
        "escenario" : $("#Escenario").val()
      };

      var form =$('#formG');
      var url = form.attr('action');
      
      $.post(url,parametros,function(result){
        lava.loadData('grafico', result);
  
      console.log(result);
         
      });

    }


</script>

@endsection
