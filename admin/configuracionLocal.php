<?php
	include_once("../modelo/empresa.php");
	$objEmpresa=new Empresa();

	session_start();
	if (!isset($_SESSION['usuarioLogin'])) {
		header('Location:?cargar=login');
	}
?>
<div class="row" >
<div class="container">
	<div class="col">
		<h1 class="text-center">Web</h1>
		<div class="dropdown-divider " style="color: #839af8;"></div>
		<div class="col">
			<div id="mensajesDescarga"></div>
			<form id="formularioDescarga" class="mx-auto" method="post" action="../modelo/configArchivo.php" enctype="multipart/form-data">
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
				<div class="col-md">
					<input type="submit" class="btn btn-primary col-md-2 mx-auto m-2" value="Descargar">
				</div>
			</form>
		</div>

		<div class="col">
			<div id="mensajesImportarInfo"></div>
			<form id="formularioImportarInfo" method="post" action="../modelo/configArchivo.php" enctype="multipart/form-data">
				<input type="hidden" name="accion" value="importarInfo">
				<div class="form-group">
					<input type="file" class="form-control" id="archivoInfo" name="archivoInfo" accept=".json">
				</div>

				<div class="col-md">
					<input type="submit" class="btn btn-primary col-md-2 mx-auto m-2" value="Subir">
				</div>
			</form>
		</div>
	
			
			<h1 class="text-center">Local</h1>
			<div class="dropdown-divider " style="color: #839af8;"></div>
		<div class="col">
			<div id="mensajesImportar"></div>
			<form id="formularioImportar" method="post" action="../modelo/configArchivo.php" enctype="multipart/form-data">
				<input type="hidden" name="accion" value="importarUsuarios">
				
					<input type="file" class="form-control" name="archivoImportar" id="archivoImportar" accept=".json">
				
				<div class="col-md">	
					<input type="submit" class="btn btn-primary col-md-2 mx-auto m-2" value="Subir" >
				</div>
			</form>
		
			<form id="formularioDescargarInfo" method="post" action="../modelo/configArchivo.php" enctype="multipart/form-data">
				<input type="hidden" name="accion" value="descargarInfo">
				<div class="col-md">
					<input type="submit" class="btn btn-primary col-md-2 mx-auto m-2" value="descargar" >
				</div>
		
			</form>
			</div>
		</div>
	</div>
	</div>