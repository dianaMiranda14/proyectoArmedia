<?php
	session_start();
	if (!isset($_SESSION['usuarioLogin'])) {
		header('Location:?cargar=login');
	}
	include_once("../modelo/empresa.php");
	$objEmpresa=new Empresa();
?>

<div class="container">
	<div id="mensajesPlanAccion"></div>
	<form id="formularioPlanAccion">
		<input type="hidden" name="accion" id="accion" value="porcentaje">
		<div class="form-group">
			<label>Empresa</label>
			<select class="form-control" id="comboEmpresa" name="comboEmpresa" onchange="mostrarYear(this.value)">
				<option value="">Seleccione</option>
				<?php
					$objEmpresa->mostrarOption($objEmpresa->listar());
				?>
			</select>
		</div>

		<div class="form-group">
			<label>Año</label>
			<select class="form-control" id="comboYear" name="comboYear">
				<option value="">Seleccione</option>
			</select>
		</div>
	</form>
	<input type="button" class="btn" value="Aceptar" onclick="validarPlanAccion()">

	<div id="tablaPlanAccion"></div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalPlanAccion" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModalPlanAccion">
        	
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<div id="mensajesModalPlanAccion"></div>
      		<table>
      			<tr id="descipcionDimesion"></tr>
      			<tr id="definicionDimension"></tr>
      			<tr id="nivelRiesgoDimension"></tr>
      			<tr id="indicadorDimension"></tr>
      		</table>
	      	<form id="formularioModalPlanAccion">
	      		<input type="hidden" id="idEmpresa" name="idEmpresa">
	      		<input type="hidden" id="idDimension" name="idDimension">
	      		<input type="hidden" id="valorDimension" name="valorDimension">
	      		<input type="hidden" id="year" name="year">
	      		<input type="hidden" name="accion" id="accionModal">
	      		<input type="hidden" name="id" id="id">
	      		<div class="row">
	      			<div class="col">
	      				<div class="form-group">
			      			<label>Area</label>
			      			<select class="form-control" id="comboArea" name="comboArea">
			      				<option value="">Seleccione</option>
			      				<option>Administrativa</option>
			      				<option>Operativa</option>
			      			</select>
			    		</div>
	      			</div>

	      			<div class="col">
	      				<div class="form-group">
			      			<label>Responsable</label>
			      			<select class="form-control" id="comboResponsable" name="comboResponsable" >
			      				<option value="">Seleccione</option>
			      				<option>Empresa</option>
			      				<option>A.R.L</option>
			      				<option>Empresa y A.R.L</option>
			      			</select>
			      		</div>
	      			</div>
	      		</div>
	      		
	      		<div class="form-group">
	      			<label>Planes de acción</label>
	      			<div class="list-group" id="listaPlan">
	      				
	      			</div>
	      		</div>

	      		<div class="form-group">
	      			<label>Acciones recomendadas</label>
	      			<div class="list-group" id="listaAccion">
	      				
	      			</div>
	      		</div>
	      		<input type="hidden" id="idPlan" name="idPlan" value="">
	      		<input type="hidden" id="idAccion" name="idAccion" value="">
	      	</form>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="validarModalPlanAccion()">Aceptar</button>
      </div>
    </div>
  </div>
</div>