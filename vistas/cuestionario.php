<?php
	session_start();
	//print_r($_SESSION['usuarioCuestionario']);
	if (!isset($_SESSION['usuarioCuestionario'])) {
		header('Location:?cargar=error');
	}
	include_once("modelo/cuestionario.php");
	include_once("modelo/pregunta.php");
	$objCuestionario=new Cuestionario();
	$objPregunta=new Pregunta();
	$_SESSION['posCuestionario']=0;

?>

<!-- Modal -->
<div class="modal fade" id="modalMensjesPreguntas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModalPreguntas"></h5>
      </div>
      <div class="modal-body" id="cuerpoModalPregunta">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Número</th>
				<th>Pregunta</th>
				<th>Siempre</th>
				<th>Casi siempre</th>
				
				<?php
					if ($_SESSION['posCuestionario']!==2) {
						echo '<th>Algunas veces</th> 
						<th>Casi nunca</th>';
					}else{
						echo "<th>A veces</th>";
					}
				?>
				
				<th>Nunca</th>
			</tr>
		</thead>
		<tbody id="cuerpoTablaCuestionario">				
			<?php
				/*if ($_SESSION['posCuestionario']==2) {
					$objPregunta->mostrarInicioCuestionario($objCuestionario->mostrarCuestionario($_SESSION['usuarioCuestionario'], $_SESSION['posCuestionario']),"registrarEstres", 0);
				}else{
					$objPregunta->mostrarInicioCuestionario($objCuestionario->mostrarCuestionario($_SESSION['usuarioCuestionario'], $_SESSION['posCuestionario']),"registrar", 0);
				}*/
			?>
		</tbody>
	</table>
</div>
<div class="col-sm-12 mx-auto">
	<div class="col-sm-12 mx-auto ">
		<input type="button" class="btn " id="pagAnterior" value="Anterior" onclick='consultarIncio("Anterior")' >
		<input type="button" class="btn " id="pagSiguiente" value="Siguiente" onclick='consultarIncio("Siguiente")' >
		<input type="button" class="btn" value="Registrar" id="btnRegistar" onclick="preguntas()" >
	</div>
	
</div>
<script >
	$(document).ready(function() {
		paginacion(0);
	 });


	function consultarIncio(txt){
		if(txt == "Anterior"){
			var dato = document.getElementById('txtPregunta').value;
			var pagina = parseInt(dato) -11;	
			paginacion(pagina);			
		}else{
			var dato = document.getElementById('txtPregunta').value;
			var pagina = parseInt(dato) +9;	
			paginacion(pagina);
		}
	}

</script>