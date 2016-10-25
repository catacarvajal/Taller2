<aside class="control-sidebar control-sidebar-light">
	<!-- Create the tabs -->
	<div id="side_visualizar" style="display:none;" >
		<div class="modal-header">
			<button  onclick="ocultar()"type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title">Fecha</h4>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">					
				<div class="form-group">
					<label>Año:</label>
					<div class="input-group ">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control pull-right input-sm" id="datepicker" placeholder="Año">
					</div><!-- /.input group -->

					<label>Mes:</label>
					<select class="form-control select2 input-sm" id="month">
						<option value="1">Enero</option>
						<option value="2">Febrero</option> 
						<option value="3">Marzo</option>             
					</select>
				</div>
				<button class="btn btn-block btn-primary btn-xs" onclick="#">Generar Mapa</button>
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
