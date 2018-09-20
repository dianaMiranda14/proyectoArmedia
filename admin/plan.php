<?php
	include_once("../modelo/dimension.php");
	$objDimension=new Dimension();
	session_start();
	if (!isset($_SESSION['usuarioLogin'])) {
		header('Location:?cargar=login');
	}
?>
<div class="container mt-5 pt-2 pb-4" style="background: #fff;">
	<h1 class="text-center">Planes de Accion</h1>
	<!--ya se que falta la tilde......-->
	<div class="dropdown-divider " style="color: #839af8;"></div>
<input type="button" class="btn btn-primary float-right m-2 mb-4" value="Registrar" onclick="modalPlan('registrar',null)">

<div class="table-responsive">
	<table class="table table-hover">
		<thead class="thead">
			<tr>
				<th scope="col" class="table-primary">
					<select class="form-control filtro" onchange="filtrarPlan('consultarDimension',this.value)">
						<option>Dimensión</option>
						<?php
							echo $objDimension->mostraroption();
						?>
					</select>
				</th>

				<th scope="col" class="table-primary">
					<input type="text" class="form-control filtro" onkeyup="filtrarPlan('consultarDescripcion',this.value)" placeholder="Descripción">
				</th>

				<th scope="col" class="table-primary">
					<select class="form-control filtro" onchange="filtrarPlan('consultarEstado',this.value)">
						<option>Estado</option>
						<option>Activo</option>
						<option>Inactivo</option>
					</select>
				</th>
			</tr>
		</thead>

		<tbody id="cuerpoTablaPlan">
			<?php
				include_once("../modelo/plan_accion.php");
				$objPlan=new PlanAccion();
				echo $objPlan->mostrar($objPlan->listar());
			?>
		</tbody>
	</table>
</div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalPlan" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModalPlan">
        	
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<div id="mensajesPlan"></div>
	      	<form id="formularioPlan">
	      		<input type="hidden" name="accion" id="accionPlan">
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

	      		<div id="adicionalPlan">
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
        <button type="button" class="btn btn-primary" onclick="validarModalPlan()">Aceptar</button>
      </div>
    </div>
  </div>
</div>