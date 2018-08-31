<?php
	include_once("../modelo/dimension.php");
	$objDimension=new Dimension();
	session_start();
	if (!isset($_SESSION['usuarioLogin'])) {
		header('Location:?cargar=login');
	}
?>

<input type="button" class="btn btn-primary" value="Registrar" onclick="modalAccion('registrar',null)">

<div class="table-responsive">
	<table class="table table-hover">
		<thead class="thead">
			<tr>
				<th scope="col" class="table-primary">
					<select class="form-control filtro" onchange="filtrarAccion('consultarDimension',this.value)">
						<option>Dimensión</option>
						<?php
							echo $objDimension->mostrarOption();
						?>
					</select>
				</th>
				<th scope="col" class="table-primary">
					<input type="text" class="form-control filtro" placeholder="Descripción" onkeyup="filtrarAccion('consultarDescripcion',this.value)">
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