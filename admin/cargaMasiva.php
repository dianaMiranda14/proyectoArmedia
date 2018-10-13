<div class="container">
	<div class="row" >
		<h1 style="text-align: center !important">Carga masiva de usuarios</h1>
	</div>
	
	<div class="row">
		<form method="post" action="../controlador/cargaMasivaControlador.php">
			<input type="hidden" name="accion" value="descargar">
			<input type="submit" id="btnDescargar" class="btn btn-lg btn-primary" value="Descargar">
		</form>
	</div>

	<div class="row">
		<form enctype="multipart/form-data" method="post" action="../controlador/cargaMasivaControlador.php">
			<input type="hidden" name="accion" value="subir">
			<div class="form-group">
				<label>Formato de carga masiva de empleados</label>
				<input type="file" name="fileCarga" required="true"   accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="form-control">
			</div>
			
			<input type="submit" id="btnSubir" class="btn btn-lg btn-primary" value="Subir">
		</form>
	</div>
	
</div>