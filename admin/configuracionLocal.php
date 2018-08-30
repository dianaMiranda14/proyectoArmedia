<?php
	include_once("../modelo/empresa.php");
	$objEmpresa=new Empresa();

	session_start();
	if (!isset($_SESSION['usuarioLogin'])) {
		header('Location:');
	}
?>

<div class="col-md-5">
	<h1>Web</h1>
	<div class="col">
		<div id="mensajesDescarga"></div>
		<form id="formularioDescarga" method="post" action="../modelo/configArchivo.php">
			<input type="hidden" name="accion" value="descargarUsuarios">
			<div class="form-group">
				<label>Empresa</label>
				<select class="form-control" name="comboEmpresa" id="comboEmpresa">
					<option value="">Seleccione</option>
					<?php
						echo $objEmpresa->mostrarOption();
					?>
				</select>
			</div>
			<input type="submit" class="btn btn-primary" value="descargar">
		</form>
	</div>

	<div class="col">
		<div id="mensajesImportarInfo"></div>
		<form id="formularioImportarInfo" method="post" action="../modelo/configArchivo.php">
			<input type="hidden" name="accion" value="importarInfo">
			<div class="form-group">
				<input type="file" class="form-control" id="archivoInfo" name="archivoInfo" accept=".json">
			</div>
			<input type="submit" class="btn btn-primary" value="Subir">
		</form>
	</div>
</div>


<div class="col-md-5">
	<h1>Local</h1>
	<div id="mensajesImportar"></div>
	<form id="formularioImportar" method="post" action="../modelo/configArchivo.php">
		<input type="hidden" name="accion" value="importarUsuarios">
		<input type="file" class="form-control" name="archivoImportar" id="archivoImportar" accept=".json">
		<input type="submit" class="btn btn-primary" value="Subir" >
	</form>

	<form id="formularioDescargarInfo" method="post" action="../modelo/configArchivo.php">
		<input type="hidden" name="accion" value="descargarInfo">
		<input type="submit" class="btn btn-primary" value="descargar" >
	</form>
</div>