 <?php
	session_start();
	//print_r($_SESSION['usuarioCuestionario']);
	if (!isset($_SESSION['usuarioCuestionario'])) {
		header('Location:http://localhost/proyectoPsicosocial1/');
	}
	include_once("modelo/cuestionario.php");
	include_once("modelo/pregunta.php");
	$objCuestionario=new Cuestionario();
	$objPregunta=new Pregunta();	
	if (!isset($_SESSION['posCuestionario'])) {
		$_SESSION['posCuestionario']=0;
	}else{
		if ($_SESSION['posCuestionario']===false) {
			unset($_SESSION['posCuestionario']);
			unset($_SESSION['usuarioCuestionario']);
			header('Location:http://localhost/proyectoPsicosocial1/');
			header ("Pragma: no-cache");
		}
	}
	//print_r($_SESSION['posCuestionario']);
	//consulta el cuestionario que debe de mostrar
	$idCuestionario=$objCuestionario->consultarId($objCuestionario->mostrarCuestionario($_SESSION['usuarioCuestionario'], $_SESSION['posCuestionario']));
	
	if (mysqli_num_rows($idCuestionario)>0) {
		$obj=mysqli_fetch_assoc($idCuestionario);
		//muestra el nombre del cuestionario
		echo "<h1 class='titulo'>".utf8_encode($obj['nombre_cuestionario'])."</h1>";
	}
	

?>

<!-- Modal -->
<div class="container fondoCuestionario">
	
	<div class="modal fade" id="modalMensjesPreguntas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="tituloModalPreguntas"></h5>
	      </div>
	      <div class="modal-body" id="cuerpoModalPregunta">
	        ...
	      </div>
	      <div id="botones">
	      	<div class="row" style="text-align: center">
	      		<div class="col-md-6">
	      			<input type="button" class="btn btn-primary" id="btnSi" value="Si">
	      		</div>
	      		<div class="col-md-6">
	      			<input type="button" class="btn btn-primary" id="btnNo" value="No">
	      		</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="table-responsive">
		<form id="formularioCuestionario">
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

					if ($_SESSION['posCuestionario']==2) {
						$objPregunta->mostrarInicioCuestionario($obj['id_cuestionario'],"registrarEstres", 0);
					}else{
						$objPregunta->mostrarInicioCuestionario($obj['id_cuestionario'],"registrar", 0);
					}
				?>
			</tbody>
			
		</table>
		</form>
	</div>
	<div class="row" style="text-align: center;">
		<div class="col-md-6" style="margin: 15px auto">
			<input type="button" class="btn btn-primary" id="pagAnterior" value="Anterior">
		</div>
		<div class="col-md-6" style="margin: 15px auto">
			<input type="button" class="btn btn-primary" id="pagSiguiente" value="Siguiente">
			<input type="button" class="btn btn-success" value="Registrar" id="btnRegistrar" onclick="preguntas()" >
		</div>
	</div>


	<script type="text/javascript">
		$(document).ready(function(){
			validarMostrarBotones();
		});
	</script>


</div>
