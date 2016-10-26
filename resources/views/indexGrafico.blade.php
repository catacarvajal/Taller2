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
       <form role="form" id= "formG" method="POST" action="{{ url('/Grafico')}}">
       {!! csrf_field() !!}
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Periodo</label>
                {!!Form::select('Periodo', array_pluck($periodo, 'year_init', 'id'), null, ['id'=>'Periodo','class' => 'form-control','onchange' => 'setgraficoValue(this.value);']) !!}
              </div>
          </div><!-- /.form-group -->         
          <div class="col-md-4">
              <div class="form-group">
                <label>Escenario</label>
                {!!Form::select('Escenario', array_pluck($scenario, 'name', 'id'), null, ['id'=>'Escenario','class' => 'form-control','onchange' => 'setgraficoValue(this.value);']) !!}
              </div>
          </div><!-- /.form-group -->
          <div class="col-md-4">
              <div class="form-group">
                <label>Variable</label>
                {!!Form::select('Variable', array_pluck($variable, 'name', 'id'), null, ['id'=>'Variable','class' => 'form-control','onchange' => 'setgraficoValue(this.value);']) !!}
              </div>
          </div><!-- /.form-group -->
          </div>
       </form>
       <div id="perf_div" class="chart"></div><!-- div donde se dibuja el grafico -->
      </div>
    </div>

    <!-- Tabla -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">   
          <div class="box-header with-border">
            <h3 class="box-title">Datos: {{$datosTabla[1]->variable}}</h3>
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

<?= $lava->render('BarChart', 'grafico', 'perf_div')
?>

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
        
      alert(result);
      console.log(result);
         
      });

    }

</script>
@endsection