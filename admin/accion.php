<?php
	include_once("../modelo/dimension.php");
	$objDimension=new Dimension();
	//session_start();
	if (!isset($_SESSION['usuarioLogin'])) {
		header('Location:?cargar=login');
	}
?>
<div class="row">
	<div class="col-sm-10">
		<h1 class="text-center">Acciones Recomendadas</h1>
	</div>
	<div class="col-sm-2">
		<input type="button" class="btn btn-primary float-right m-2 mb-4" value="Registrar" onclick="modalAccion('registrar',null)">
	</div>
	
	<div class="dropdown-divider " style="color: #839af8;"></div>


<div class="table-responsive">
		<table class="table table-sm">
		<thead class="thead">
			<tr>
				<th scope="col" class="table-primary">
					<select class="form-control filtro " onchange="filtrarAccion('consultarDimension',this.value)">
						<option>Dimensión</option>
						<?php
							echo $objDimension->mostrarOption();
						?>
					</select>
				</th>
				<th scope="col" class="table-primary">
					<input type="text" class="form-control filtro " placeholder="Descripción" onkeyup="filtrarAccion('consultarDescripcion',this.value)">
				</th>
				<th scope="col" class="table-primary">
					<select class="form-control filtro" onchange="filtrarAccion('consultarEstado',this.value)">
						<option>Estado</option>
						<option>Activo</option>
						<option>Inactivo</option>
					</select>
				</th>
			</tr>
		</thead>
		<tbody id="cuerpoTablaAccion">
			<?php
				include_once("../modelo/accion_recomendada.php");
				$objAccion=new AccionRecomendada();
				echo $objAccion->mostrar($objAccion->listar());
			?>
		</tbody>
	</table>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalAccion" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModalAccion">
        	
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<div id="mensajesAccion"></div>
	      	<form id="formularioAccion">
	      		<input type="hidden" name="accion" id="accionRecomendada">
	      		<input type="hidden" name="txtId" id="txtId">
	      		
	      		<div class="form-group">
	      			<label>Dimensión</label>
	      			<select class="form-control" name="comboDimension" id="comboDimension">
	      				<option value="">Seleccione</option>
	      				<?php echo $objDimension->mostrarOption(); ?>
	      			</select>
	      		</div>
	      		
	      		<div class="form-group">
	      			<label>Descripción</label>
	      			<textarea name="txtDescripcion" id="txtDescripcion" class="form-control" rows="5"></textarea>
	      		</div>

	      		<div id="adicionalAccion">
		      		<div class="form-group">
		      			<label>Estado</label>
		      			<select id="comboEstado" name="comboEstado" class="form-control">
		      				<option>Activo</option>
		      				<option>Inactivo</option>
		      			</select>
		      		</div>
	      		</div>
	      	</form>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="validarModalAccion()">Aceptar</button>
      </div>
    </div>
  </div>
</div>