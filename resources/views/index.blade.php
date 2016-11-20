@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box-body no-padding">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Bienvenidos</h4>
                <p>Este sitio presenta información de distintas variables ambientales, las cuales se pueden graficar y visualizar según un periodo de tiempo determinado. Los datos que encontrará a continuación han sido generados a partir de modelos atmosféricos y datos satelitales.
                    Este gran esfuerzo computacional y científico ha sido llevado a cabo por el equipo de la Universidad de Talca para el modulo de Taller 2.
                </p>
                <p> Haga click en la herramienta para ver las distintas opciones implementadas en el sitio
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
                <form role="form" id= "formG"  ><!-- method="POST" action="{{ url('/Grafico')}}-->
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
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                        Geometría</a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="users-list clearfix">
                                        <li>                            
                                            <img src="http://www.ifriedegg.com/Images%209/Punto.jpg">
                                            <a class="users-list-name" href="#">Punto</a>
                                        </li>
                                        <li>
                                            <img src="http://definicion.de/wp-content/uploads/2012/08/cuadrado.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">Cuadrado</a>
                                        </li>
                                        <li>
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoCep2JBhGOOFCTc52UVD2vVHr0cRc4PvoCEIvKLkS3pB3rtAqzg" alt="User Image">
                                            <a class="users-list-name" href="#">Polígono</a>
                                        </li>
                                        <li>
                                            <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQYtHuH2Xr_LyWeq5tDAsElDIRcMUrQ5fKwt07moJ7jNddB0zLGKA" href="#" alt="User Image">
                                            <a class="users-list-name" href="#">Circulo</a>
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
                                            <button class="btn btn-block btn-primary btn-xs" id="btn-grafico" title="Visulizar" onclick="window.open('Grafico')">Visualizar Graficos</button> 
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
                                            <button class="btn btn-block btn-success btn-lg" id="btn-Importar" title="Importar" onclick="exportarPdf()"><i class="fa fa-cloud-upload"></i> Importar Datos</button> 
                                        </div>
                                        <div class="col-md-6 ">                 
                                            <button class="btn btn-block btn-warning btn-lg" id="btn-Exportar" title="Exportar" > <i class="fa fa-cloud-download"></i> Exportar datos</button>
                                        </div>
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

@endsection
