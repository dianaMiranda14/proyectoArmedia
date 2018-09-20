<?php
	include_once("../modelo/cuestionario.php");
	$objCuestionario=new Cuestionario();
	session_start();
	if (!isset($_SESSION['usuarioLogin'])) {
		header('Location:?cargar=login');
	}
?>
<div class="container mt-5 pt-2 pb-4" style="background: #fff;">
	<h1 class="text-center">Observaciones</h1>
	<div class="dropdown-divider " style="color: #839af8;"></div>
<input type="button" class="btn btn-primary  float-right m-2 mb-4" value="Registrar" onclick="modalObservacion('registrar',null)">

<div class="table-responsive">
	<table class="table table-hover">
		<thead class="thead">
			<tr>
				<th scope="col" class="table-primary">
					<select class="form-control filtro" onchange="filtrarObservacion('consultarCuestionario',this.value)">
						<option>Cuestionario</option>
						<?php echo $objCuestionario->mostrarOption()?>
					</select>
				</th>

				<th scope="col" class="table-primary">
					<select class="form-control filtro" onchange="filtrarObservacion('consultarTipo',this.value)">
						<option>Tipo</option>
						<option>Dimension</option>
						<option>Riesgo</option>
					</select>
				</th>

				<th scope="col" class="table-primary">
					<input type="text" class="form-control readOnly" placeholder="Contenido" disabled="true" >
				</th>

				<th scope="col" class="table-primary">
					<input type="text" class="form-control filtro" placeholder="Descripción" onkeyup="filtrarObservacion('consultarDescripcion',this.value)">
				</th>

				<th scope="col" class="table-primary">
					<select class="form-control filtro" onchange="filtrarObservacion('consultarEstado',this.value)">
						<option>Estado</option>
						<option>Activo</option>
						<option>Inactivo</option>
					</select>
				</th>
			</tr>
		</thead>

		<tbody id="cuerpoTablaObservacion">
			<?php
				include_once("../modelo/observacion.php");
				$objObs=new Observacion();
				echo $objObs->mostrar($objObs->listar());
			?>
		</tbody>
	</table>
</div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalObservacion" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModalObservacion">
        	
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<div id="mensajesObservacion"></div>
	      	<form id="formularioObservacion">
	      		<input type="hidden" name="accion" id="accionObservacion">
	      		<input type="hidden" name="txtId" id="txtId">
	      		<div class="row">
	      			<div class="col">
	      				<div class="form-group">
			      			<label>Cuestionario</label>
			      			<select class="form-control" name="comboCuestionario" id="comboCuestionario">
			      				<option value="">Seleccione</option>
			      				<?php echo $objCuestionario->mostrarOption(); ?>
			      			</select>
			      		</div>
	      			</div>

	      			<div class="col">
	      				<div class="form-group">
			      			<label>Tipo observación</label>
			      			<select class="form-control" name="comboTipo" id="comboTipo" onchange="actualizarContenido(this.value)">
			      				<option value="">Seleccione</option> 
			      				<option>Dimension</option>
			      				<option>Riesgo</option>
			      			</select>
			      		</div>
	      			</div>
	      		</div>

	      		<div class="form-group">
	      			<label>Contenido</label>
	      			<select class="form-control" name="comboContenido" id="comboContenido">
	      				<option value="">Seleccione</option>
	      			</select>
	      		</div>
	      		
	      		<div class="form-group">
	      			<label>Descripción</label>
	      			<textarea name="txtDescripcion" id="txtDescripcion" class="form-control" rows="5"></textarea>
	      		</div>

	      		<div id="adicionalObservacion">
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
        <button type="button" class="btn btn-primary" onclick="validarModalObservacion()">Aceptar</button>
      </div>
    </div>
  </div>
</div>