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
              <div id="perf_div" class="chart" ></div><!-- div donde se dibuja el grafico -->
            </div>
          </div>
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
                <th>Mes</th>
                <th style="width: 600px">Variable</th>
                <th style="width: 20px">Promedio</th>
              </tr>
             
            
              
            </table>
          </div><!-- /.box-body -->


        </div>
      </div>
    </div>
                                 <!-- Fin creación de tabla -->
            </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </section>
</div>

<?= $lava->render('BarChart', 'grafico', 'perf_div')?>
@endsection


