@extends('layouts.app')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><strong>Mapa</strong></h3>
        <a href="Grafico" class="pull-right glyphicon glyphicon-stats" data-toggle="tooltip" title="Solo graficos"></a>
        <a href="/" class="pull-right glyphicon glyphicon-map-marker" data-toggle="tooltip" title="Solo Mapa"></a>
        <a href="MapaYGrafico" class="pull-right glyphicon glyphicon-retweet" data-toggle="tooltip" title="Mapa y graficos"></a>
    </div>
    <div class="box-body no-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="pad">
                    <div id="toolbar" style="display: none;">
                    </div>
                    <div class="col-md-12">                        
                        <div id="map" class="map"></div>                        

                        <div class="btn-group dropup" style="position: absolute; bottom: 50px; right: 15px; padding: 3px; ">
                            <button type="button" class="btn btn-primary btn-circle btn-lg" data-toggle="dropdown" title="Herramientas" >
                                <i class="fa fa-wrench"></i>              
                            </button>
                            <ul class="dropdown-menu">
                                <li><a onclick="mostrar('side_ir_a')"class="btn btn-primary btn-circle  btn-lg"data-toggle="control-sidebar" title="Ir a"><i class="fa  fa-paper-plane-o"></i> </a></li>
                                <li><a onclick="mostrar('side_visualizar')" class="btn btn-primary btn-circle  btn-lg"data-toggle="control-sidebar" title="visualizar"><i class="fa fa-bar-chart"></i> </a></li>
                                <li><a onclick="mostrar('side_descargar')" class="btn btn-primary btn-circle  btn-lg"data-toggle="control-sidebar" title="Descargar"><i class="fa fa-download"></i> </a></li>                                
                            </ul>
                        </div>                                   
                    </div>
                </div>
            </div>
        </div>                            
    </div>
</div>
@endsection