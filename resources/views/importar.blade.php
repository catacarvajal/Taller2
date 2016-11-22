@extends('layouts.app')

@section('content')
<div class="content" >
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="box-body no-padding">
      <div class="box box-info color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title">
          <i class="fa fa-bar-chart" aria-hidden="true"></i> Estadísticas
          </h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12 ">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box box-success">   
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos de: </h3>
                        </div> 
                        <div class="box-body">
                          <table class="table table-bordered" id="tabla">
                            <tr>
                              <th>Longitud</th>
                              <th style="width: 600px">Latitud</th>
                              <th style="width: 20px">Opción</th>
                            </tr>
                            @foreach ($datosTabla as $datos)     
                            <tr>
                              <td>{{$datos->mes}}</td>
                              <td><span class="badge bg-blue">{{$datos->variable}}</td>
                              <td align="center">
                                    <a href="" class="btn btn-info btn-xs btn-flat" data-toggle="tooltip" title="Detalle"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                          </table>
                        </div><!-- /.box-body -->
                      </div>
                    </div>
                  </div>
            </div>
          <div class="row">
            <div class="col-md-12 ">
              <div id="perf_div" class="chart" ></div><!-- div donde se dibuja el grafico -->
            </div>
          </div>

        </div>
      </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </section>
</div>

<?= $lava->render('BarChart', 'grafico', 'perf_div')?>
@endsection


