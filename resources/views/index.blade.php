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
                            <div class="sidepanel" style="overflow: auto">
                                
                            <div class="modal-header" id="inicio" align="justify">
                                <div class="callout callout-info">
                
                                        <h2 style="font-size: 36px;"> Bienvenidos </h2>
                                        <p>Este sitio presenta información de distintas variables ambientales, las cuales se pueden graficar y visualizar según un periodo de tiempo determinado. 
                                        </p>

                                        <p>Los datos que encontrará a continuación han sido
                                            generados a partir de modelos atmosféricos y datos
                                            satelitales.
                                        </p>

                                        <p>Este gran esfuerzo computacional y científico ha sido
                                            llevado a cabo por el equipo de la Universidad de Talca para el modulo de Taller 2.
                                        </p>
                                        <p> Haga click en la herramienta para ver las distintas opciones implementadas en el sitio</p><p>
                                    </p>
                                 </div>
                            </div>
                 

                                <div class="col-md-12" id="grafico_tabla" style="display:none;">
                                    <div id="perf_div" class="chart" style="height: 300px"></div><!-- div donde se dibuja el grafico -->
                                    <div class="col-md-12">
                                        <!-- Creación de tabla -->
                                        <div> 
                                            <table class="table table-bordered">
                                                <thead>
                                                  <th>Mes</th>
                                                  <th>Promedio</th>
                                                </thead>     
                                                <tr>
                                                </tr>
                                                <tbody id="datos"></tbody>
                                            </table>
                                        </div>
                                        <!-- Fin creación de tabla -->
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <label>Formato: &nbsp;</label>
                                                <select class="form-control select2 input-sm" id="formato">
                                                    <option value="CSV">CSV</option>
                                                    <option value="XML">XML</option>                        
                                                    <option value="Json">Json</option>                      
                                                </select>
                                            </div>
                                            <button class="btn btn-block btn-primary btn-xs" id="btn-exportar" title="Exportar" onclick='exportar()'>Exportar datos</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group dropup" style="position: absolute; bottom: 50px; right: 15px; padding: 3px; ">
                                    <button type="button" class="btn btn-primary btn-circle btn-lg" data-toggle="dropdown" title="Herramientas" >
                                        <i class="fa fa-wrench"></i>              
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a onclick="mostrar('side_ir_a')"class="btn btn-primary btn-circle  btn-lg"data-toggle="control-sidebar" title="Ir a"><i class="fa  fa-paper-plane-o"></i> </a></li>
                                        <li><a onclick="mostrar('side_visualizar')" class="btn btn-primary btn-circle  btn-lg"data-toggle="control-sidebar" title="visualizar"><i class="fa fa-bar-chart"></i> </a></li>
                                        <li><a onclick="mostrar('side_capa')"class="btn btn-primary btn-circle  btn-lg"data-toggle="control-sidebar" title="Capa"><i class="fa fa-globe"></i> </a></li>
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

<div class="modal fade modal-danger" id="modal-error">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Error de ingreso.</h4>
      </div>
      <div class="modal-body">
        <p>No existen datos para la ubicación seleccionada.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection