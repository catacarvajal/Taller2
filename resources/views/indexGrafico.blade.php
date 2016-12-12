@extends('layouts.app')

@section('content')
<div class="content">

    <section class="content-header">
    <section class="content">
                    <div class="col-md-12">
              <!-- Custom Tabs (Pulled to the right) -->
              <div class="nav-tabs-custom" >
                <ul class="nav nav-tabs pull-right" id="tabs">
                  <li class="active"><a href="#tab_1-1" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="N° de dias con t° mayor a 10 grados" onclick='setgraficoValue(11);' ><i class="fa fa-calendar-o" ></i></a></li>
                  <li><a href="#tab_2-2" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="Radiación Solar" onclick='setgraficoValue(4);' ><i class="fa fa-sun-o" ></i></a></li>
                  <li><a href="#tab_3-3" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="Precipitación" onclick='setgraficoValue(3);' ><i class="fa fa-umbrella" ></i></a></li>                  
                  <li><a href="#tab_4-4" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="T° Minima" onclick='setgraficoValue(1);' ><i class="fa fa-thermometer-empty" ></i></a></li>                  
                  <li><a href="#tab_5-5" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="T° Promedio" onclick='setgraficoValue(10);'><i class="fa fa-thermometer-half" ></i></a></li>
                  <li><a href="#tab_6-6" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="T° Máxima" onclick='setgraficoValue(2);'><i class="fa fa-thermometer-full" ></i></a></li>
                  <li><a href="#tab_7-7" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="Evapotranspiración" onclick='setgraficoValue(9);'><i class="fa fa-cloud" ></i></a></li>
                  <li class="pull-left header"><i class="fa fa-bar-chart-o "></i> Estadísticas</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    <h2>Número de días mayor a 10 grados C°</h2>

                  <div class="row">
                    <div class="col-md-12 " > 
                      <div id="perf_div" align="center" class="chart"></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTabla[1]->variable}}</h3>
                        </div> 
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
                  </div>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                  <h2>Radiación solar</h2>
                  <div class="row">
                    <div class="col-md-12 " > 
                      <div id="perf_div" align="center" class="chart"></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTabla[1]->variable}}</h3>
                        </div> 
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
                  </div>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3-3">
                  <h2>Precipitación</h2>
                  <div class="row">
                    <div class="col-md-12 " > 
                     <div id="perf_div" align="center" class="chart"></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTabla[1]->variable}}</h3>
                        </div> 
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
                  </div>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_4-4">
                    <h2>Temperatura mínima</h2>
                  <div class="row">
                    <div class="col-md-12 " > 
                     <div id="perf_div" align="center" class="chart"></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTabla[1]->variable}}</h3>
                        </div> 
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
                  </div>
                  </div><!-- /.tab-pane -->
                   <div class="tab-pane" id="tab_5-5">
                   <h2>Temperatura promedio</h2>
                                     <div class="row">
                    <div class="col-md-12 " > 
                     <div id="perf_div" align="center" class="chart"></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTabla[1]->variable}}</h3>
                        </div> 
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
                  </div>
                  </div><!-- /.tab-pane -->
                   <div class="tab-pane" id="tab_6-6">
                   <h2>Temperatura máxima </h2>
                                     <div class="row">
                    <div class="col-md-12 " > 
                     <div id="perf_div" align="center" class="chart"></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTabla[1]->variable}}</h3>
                        </div> 
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
                  </div>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_7-7">
                   <h2>Evapotranspiración</h2>
                    <div class="row">
                    <div class="col-md-12 " > 
                     <div id="perf_div" align="center" class="chart"></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTabla[1]->variable}}</h3>
                        </div> 
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
                  </div>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div> <!-- /.row -->
          <!-- END CUSTOM TABS -->
    </section>
  </section>
</div>
<?= $lava->render('BarChart', 'grafico', 'perf_div')?>

<script type="text/javascript">
    
    // jQuery example
    function setgraficoValue(value)
    {
      $variable = value;
       var geofinal=JSON.stringify({'variable': $variable, 'geoj': JSON.parse(geojson)})
      //console.log($variable);
       $.getJSON('/Grafico/get', function (dataTableJson) {
        lava.loadData('BarChart', dataTableJson, function (chart) {
          console.log(chart);
        });
      });
    }


</script>


@endsection

