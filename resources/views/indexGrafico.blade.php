@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">    
      <div class="box-header with-border">

        <h3 class="box-title">Estadísticas</h3>
        <a href="Grafico" class="pull-right glyphicon glyphicon-stats" data-toggle="tooltip" title="Solo graficos"></a>
        <a href="/" class="pull-right glyphicon glyphicon-map-marker" data-toggle="tooltip" title="Solo Mapa"></a>
        <a href="MapaYGrafico" class="pull-right glyphicon glyphicon-retweet" data-toggle="tooltip" title="Mapa y graficos"></a>
      </div>
      <div class="box-body">
       <form role="form">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Periodo</label>
                {!!Form::select('Periodo', array_pluck($periodo, 'year_init', 'id', 'year_end'), null, ['class' => 'form-control']) !!}
              </div>
          </div><!-- /.form-group -->         
          <div class="col-md-4">
              <div class="form-group">
                <label>Escenario</label>
                {!!Form::select('Escenario', array_pluck($scenario, 'name', 'id'), null, ['class' => 'form-control']) !!}
              </div>
          </div><!-- /.form-group -->
          <div class="col-md-4">
              <div class="form-group">
                <label>Variable</label>
                {!!Form::select('Variable', array_pluck($variable, 'name', 'id'), null, ['class' => 'form-control']) !!}
              </div>
          </div><!-- /.form-group -->
          </div>
       </form>
       <div id="perf_div" class="chart"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">   
          <div class="box-header with-border">
            <h3 class="box-title">Datos: </h3>
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
                  <td>{{$datos->variable}}</td>
                  <td><span class="badge bg-red">{{$datos->promedio}}</span></td>
                </tr>
              @endforeach
            
              
            </table>
          </div><!-- /.box-body -->


        </div>
      </div>
    </div>

  </div>
</div>

<?= $lava->render('BarChart', 'variable', 'perf_div')
?>

@endsection