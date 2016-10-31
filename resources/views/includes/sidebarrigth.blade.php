<aside class="control-sidebar control-sidebar-light">
	<!-- Create the tabs -->
	<div id="side_visualizar" style="display:none;" >
		<div class="modal-header">
			<button  onclick="" type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title">Graficar</h4>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">					
				<form >
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
				</form>				
			</div>
		</div>
		<div class="modal-header">			
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
				<button type="button" data-toggle="control-dibujo" class="btn btn-default btn-xs" title="Eliminar" onclick='removeDraw()'>Eliminar <i class="fa fa-trash"></i></button>
			</div>
		</div>	
		<div class="modal-header">
			<h4 class="modal-title">Visualizar</h4>
		</div>
		<div class="row">

			<div class="col-md-8 col-md-offset-2">					
				<button class="btn btn-block btn-primary btn-xs" id="btn-grafico" data-toggle="control-sidebar" title="Visulizar" onclick='ajaxButton()'>Visualizar Graficos</button>			
			</div>
		</div>

		<div class="modal-header">
			<div class="callout callout-info">
				<p>Para visualizar un grafico debe selecionar un periodo , escenario y variable. Luego  con un tipo de geometria y realizar una selecion en el mapa</p>
			</div>
		</div>
	</div>
	<div id="side_ir_a" style="display:none;">


		<div class="modal-header">
			<button onclick="" type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
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
	</div>		
	<div id="side_descargar" style="display:none;">
		<div class="modal-header">
			<button onclick="" type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title">Exportar</h4>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">	
				<div class="form-group ">
					<label>Formato: &nbsp;</label>
					<select class="form-control select2 input-sm" id="ir_tipo">
						<option value="CSV">CSV</option>
						<option value="XML">XML</option>						
						<option value="Json">Json</option>						
					</select>
				</div>
			</div>		
		</div>	
		<div class="row">
			<div class="col-md-8 col-md-offset-2">					
				<button class="btn btn-block btn-primary btn-xs" id="btn-exportar" data-toggle="control-sidebar" title="Exportar" onclick='ajaxButton()'>Exportar datos</button>		
			</div>
		</div>
	</div>
	<div id="side_capa" style="display:none;">
		<div class="modal-header">
			<button onclick="" type="button" class="close" data-toggle="control-sidebar"aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title">Capa</h4>
			<p></p>

			<div class="box-body no-padding">
				<ul class="users-list clearfix">
					<li>                        	
						<img src="http://thumbs.subefotos.com/33c9bb8d542bd1d85843f9e9147b80b7o.jpg">
						<a class="users-list-name" href="#">color</a>
					</li>
					<li>
						<img src="http://thumbs.subefotos.com/8432ce8bf350130bd1d09bedf24a8a4fo.jpg" alt="User Image">
						<a class="users-list-name" href="#">Imagenes</a>
					</li>
					<li>
						<img src="http://thumbs.subefotos.com/2b8c55deb4d54d7f37ca870c16fba621o.jpg" alt="User Image">
						<a class="users-list-name" href="#">Toner</a>
					</li>
					<li>
						<img src="http://thumbs.subefotos.com/46a1681d6309c3e11c0a5b091a9057efo.jpg" alt="User Image">
						<a class="users-list-name" href="#">OSM</a>

					</li>
				</ul><!-- /.users-list -->
			</div>
			<div class="modal-header">
			<div class="callout callout-info">
				<p>Permite seleccionar una capa la cual modificara el mapa.</p>
			</div>
		</div>
		</div>
	</div>
</aside><!-- /.control-sidebar -->


