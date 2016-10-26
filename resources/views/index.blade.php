@extends('layouts.app')

@section('content')
<div>
    <div class="box-body no-padding">
        <div class="row">
            <div class="col-md-12 ">
                <div class="pad">
                    <div class="col-md-12">                        
                        <div id="fullscreen" class="fullscreen">
                            <div id="map" class="map"></div>
                            <div class="sidepanel">
                                <span class="sidepanel-title">Gráfico</span>
                                <div id="perf_div" class="chart"></div><!-- div donde se dibuja el grafico -->
                                    <div class="col-md-12">
                                        <div> 
                                            <div class="box-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Mes</th>
                                                        <th style="width: 600px">Variable</th>
                                                        <th style="width: 20px">Promedio</th>
                                                    </tr>
                                                    @foreach ($datosTabla as $datos)     
                                                    <tr>
                                                        <td>{{$datos->mes}}</td>
                                                        <td><span class="badge bg-blue">{{$datos->variable}}</td>
                                                        <td><span class="badge bg-red">{{$datos->promedio}}</span></td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div><!-- /.box-body -->
                                        </div>
                                    </div>

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
    </div>
</div>
<?= $lava->render('BarChart', 'grafico', 'perf_div')
?>
@endsection