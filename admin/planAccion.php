<?php
	session_start();
	if (!isset($_SESSION['usuarioLogin'])) {
		header('Location:?cargar=login');
	}
	include_once("../modelo/empresa.php");
	$objEmpresa=new Empresa();
?>

<div class="container">
	<form id="formularioPlanAccion">
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
</div>