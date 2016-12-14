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
                  <li><a href="#tab_5-5" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="T° promedio" onclick='setgraficoValue(10);'><i class="fa fa-thermometer-half" ></i></a></li>
                  <li><a href="#tab_6-6" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="T° Máxima" onclick='setgraficoValue(2);'><i class="fa fa-thermometer-full" ></i></a></li>
                  <li><a href="#tab_7-7" data-toggle="tab" data-toggle="tooltip" data-placement="left" title="Evapotranspiración" onclick='setgraficoValue(9);'><i class="fa fa-cloud" ></i></a></li>
                  <li class="pull-left header"><i class="fa fa-bar-chart-o "></i> Estadísticas</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    <h2>Número de días mayor a 10 grados C°</h2>

                  <div class="row">
                    <div class="col-md-12 " > 
                      <div id="grafico1" align="center" style=" width:100.5% " ></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTablaV1[1]->variable}}</h3>
                        </div> 
                        <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th>Mes</th>
                              <th style="width: 600px">Variable</th>
                              <th style="width: 20px">Promedio</th>
                            </tr>
                            @foreach ($datosTablaV1 as $datos)     
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
                      <div id="grafico2" align="center" style=" width:90% "  ></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTablaV2[1]->variable}}</h3>
                        </div> 
                        <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th>Mes</th>
                              <th style="width: 600px">Variable</th>
                              <th style="width: 20px">Promedio</th>
                            </tr>
                            @foreach ($datosTablaV2 as $datos)     
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
                     <div id="grafico3" align="center" style=" width:90% "></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTablaV3[1]->variable}}</h3>
                        </div> 
                        <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th>Mes</th>
                              <th style="width: 600px">Variable</th>
                              <th style="width: 20px">Promedio</th>
                            </tr>
                            @foreach ($datosTablaV3 as $datos)     
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
                     <div id="grafico4" align="center" style=" width:90% "></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTablaV4[1]->variable}}</h3>
                        </div> 
                        <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th>Mes</th>
                              <th style="width: 600px">Variable</th>
                              <th style="width: 20px">Promedio</th>
                            </tr>
                            @foreach ($datosTablaV4 as $datos)     
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
                     <div id="grafico5" align="center" style=" width:90% " ></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTablaV5[1]->variable}}</h3>
                        </div> 
                        <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th>Mes</th>
                              <th style="width: 600px">Variable</th>
                              <th style="width: 20px">Promedio</th>
                            </tr>
                            @foreach ($datosTablaV5 as $datos)     
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
                     <div id="grafico6" align="center" style=" width:90% "></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTablaV6[1]->variable}}</h3>
                        </div> 
                        <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th>Mes</th>
                              <th style="width: 600px">Variable</th>
                              <th style="width: 20px">Promedio</th>
                            </tr>
                            @foreach ($datosTablaV6 as $datos)     
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
                     <div id="grafico7" align="center" style=" width:90% " ></div><!-- div donde se dibuja el grafico -->
                    </div>
                    <div class="col-md-12 ">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: {{$datosTablaV7[1]->variable}}</h3>
                        </div> 
                        <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th>Mes</th>
                              <th style="width: 600px">Variable</th>
                              <th style="width: 20px">Promedio</th>
                            </tr>
                            @foreach ($datosTablaV7 as $datos)     
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
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<!-- optional -->
<script src="http://code.highcharts.com/modules/offline-exporting.js"></script>
<script type="text/javascript">
 $(function () { 
        var data_variable1 = <?php echo $variable1; ?>;
        var data_variable2 = <?php echo $variable2; ?>;
        var data_variable3 = <?php echo $variable3; ?>;
        var data_variable4 = <?php echo $variable4; ?>;
        var data_variable5 = <?php echo $variable5; ?>;
        var data_variable6 = <?php echo $variable6; ?>;
        var data_variable7 = <?php echo $variable7; ?>;  
        var meses=['Enero','Febrero','Marzo', 'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Novienbre','Dieciembre'];   
   
    var myChart = Highcharts.chart('grafico1', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: meses
        },
        yAxis: {
            title: {
                text: 'valor'
            }
        },        
        series: [{
            name: 'Número de días mayor a 10 grados C°',
            data: data_variable1            
        }]
    });
    var myChart2 = Highcharts.chart('grafico2', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: meses
        },
        yAxis: {
            title: {
                text: 'Valor'
            }
        },        
        series: [{
            name: 'Radiación solar',
            data: data_variable2,
            color: '#f7a35c'
        }]
    });
     var myChart2 = Highcharts.chart('grafico3', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: meses
        },
        yAxis: {
            title: {
                text: 'Valor'
            }
        },        
        series: [{
            name: 'Precipitación',
            data: data_variable3,
            color: '#8f2896'
        }]
    });
      var myChart2 = Highcharts.chart('grafico4', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafico'
        },
        xAxis: {
            categories: meses
        },
        yAxis: {
            title: {
                text: 'Valor'
            }
        },        
        series: [{
            name: 'Temperatura mínima',
            data: data_variable4,
            color:  '#f70909'
        }]
    });
       var myChart2 = Highcharts.chart('grafico5', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: meses
        },
        yAxis: {
            title: {
                text: 'Valor'
            }
        },        
        series: [{
            name: 'Temperatura promedio',
            data: data_variable5,
            color: '#06d865'
        }]
    });
        var myChart2 = Highcharts.chart('grafico6', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: meses
        },
        yAxis: {
            title: {
                text: 'Valor'
            }
        },        
        series: [{
            name: 'Temperatura máxima',
            data: data_variable6,
            color: '#d8d806'
        }]
    });
         var myChart2 = Highcharts.chart('grafico7', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: meses
        },
        yAxis: {
            title: {
                text: 'Valor'
            }
        },        
        series: [{
            name: 'Evapotranspiración',
            data: data_variable7,
            color: '#ff7200'
        }]
    });

});
   
</script>


@endsection

