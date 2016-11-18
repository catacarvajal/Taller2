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
                <p> Haga click en la herramienta para ver las distintas opciones implementadas en el sitio</p><p>
            </p>
        </div>
    </div>
</section>

<!-- Main content -->
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

            <form role="form" id= "formG" method="POST" action="{{ url('/Grafico')}}">
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
                                                    <label >Mes</label>
                                                    {!!Form::select('Variable', array_pluck($variable, 'name', 'id'), null, ['id'=>'Variable','class' => 'form-control','onchange' => 'setgraficoValue(this.value);']) !!}
                                                </div>
                                            </div><!-- /.form-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                            Selección de Variable</a>
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
                                </div>

                                <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                            Selección de polígonos</a>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="users-list clearfix">
                                                <li>                            
                                                    <img src="http://thumbs.subefotos.com/33c9bb8d542bd1d85843f9e9147b80b7o.jpg">
                                                    <a class="users-list-name" href="#">Punto</a>
                                                </li>
                                                <li>
                                                    <img src="http://thumbs.subefotos.com/8432ce8bf350130bd1d09bedf24a8a4fo.jpg" alt="User Image">
                                                    <a class="users-list-name" href="#">Cuadrado</a>
                                                </li>
                                                <li>
                                                    <img src="http://thumbs.subefotos.com/2b8c55deb4d54d7f37ca870c16fba621o.jpg" alt="User Image">
                                                    <a class="users-list-name" href="#">Polígono</a>
                                                </li>
                                                
                                            </ul><!-- /.users-list -->
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                            Importación / exportación</a>
                                        </h4>
                                    </div>
                                    <div id="collapse5" class="panel-collapse collapse">
                                        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.
                                        </div>
                                    </div>
                                </div>
                           

                            </div>

                        </form>
                    </div><!-- /.box-body -->


                </div>

                <!-- =========================================================== -->





            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->

        @endsection


