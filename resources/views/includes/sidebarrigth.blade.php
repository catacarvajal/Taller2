	<aside class="control-sidebar control-sidebar-light">
		<!-- Create the tabs -->
		<div id="side_visualizar" style="display:none;" >
			<div class="modal-header">
				<button  onclick="ocultar()"type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Fecha</h4>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">					
					<form role="form" id= "formG" method="POST" action="{{ url('/Grafico')}}">
						{!! csrf_field() !!}
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Periodo</label>
									{!!Form::select('Periodo', array_pluck($periodo, 'year_init', 'id'), null, ['id'=>'Periodo','class' => 'form-control']) !!}
								</div>
							</div><!-- /.form-group -->         
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Escenario</label>
									{!!Form::select('Escenario', array_pluck($scenario, 'name', 'id'), null, ['id'=>'Escenario','class' => 'form-control']) !!}
								</div>
							</div><!-- /.form-group -->
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Variable</label>
									{!!Form::select('Variable', array_pluck($variable, 'name', 'id'), null, ['id'=>'Variable','class' => 'form-control']) !!}
								</div>
							</div><!-- /.form-group -->
						</div>
					

					
                        <div >
                            <a href="" class="btn btn-block btn-primary btn-xs">Generar Mapa</a>
                        </div>
                        
                   
				
				</form>				
			</div>
		</div>
		<div class="modal-header">
			<button onclick="ocultar()"type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title">Seleccionar</h4>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">	
				<div class="form-group ">
					<label>Tipo Geometria: &nbsp;</label>
					<select class="form-control select2 input-sm" id="type">
						<option value="None">Ninguno</option>
						<option value="Point">Punto</option>						
						<option value="Polygon">Poligono</option>
						<option value="Circle">Circulo</option>
						<option value="Square">Cuadrado</option>
					</select>
				</div>
			</div>		
			<div class="col-md-12 col-md-offset-4">					
				<button type="button" data-toggle="control-dibujo" class="btn btn-default btn-xs" title="Eliminar">Eliminar <i class="fa fa-trash"></i></button>
			</div>
		</div>	
		<div class="modal-header">
			<button onclick="ocultar()"type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title">Visualizar</h4>
		</div>
		<div class="row">

			<div class="col-md-8 col-md-offset-2">					
				<button class="btn btn-block btn-primary btn-xs" data-toggle="control-dibujo" title="Eliminar" onclick="#">Visualizar Graficos</button>			
			</div>
		</div>


		<div class="modal-header">
			<div class="callout callout-info">
				<p>Para visualizar un grafico debe selecionar una fecha ,  selecionar una tipo de geometria y realizar una selecion en el mapa</p>
			</div>
		</div>
	</div>
	<div id="side_ir_a" style="display:none;">


		<div class="modal-header">
			<button onclick="ocultar()" type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title">Ir a</h4>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">	
				<div class="form-group ">
					<label>Tipo: &nbsp;</label>
					<select class="form-control select2 input-sm" id="ir_tipo">
						<option value="None">Seleccione</option>
						<option value="Regiones">Regiones</option>
						<option value="Provincias">Provincias</option>						
						<option value="cuidades">Ciudades</option>						
					</select>
					<label>Sub tipo: &nbsp;</label>
					<select class="form-control select2 input-sm" id="ir_sub_tipo">
						<option value="None">Seleccione</option>
						<option value="Curico">Curicó</option>
						<option value="Arica">Arica</option>						
						<option value="cuidades">Ciudades</option>						
					</select>
				</div>
			</div>		
		</div>	

		<div class="modal-header">
			<div class="callout callout-info">
				<p>Permite seleccionar una región, comuna, provincia y navegar hasta su localización.</p>
			</div>
		</div>		
		<div id="side_descargar" style="display:none;">

			<div class="modal-header">
				<button onclick="ocultar()" type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Descargar</h4>
			</div>
		</div>
	</div>

</aside><!-- /.control-sidebar -->