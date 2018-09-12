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
?>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Número</th>
				<th>Pregunta</th>
				<th>Siempre</th>
				<th>Casi siempre</th>
				<th>Algunas veces</th>
				<th>Casi nunca</th>
				<th>Nunca</th>
			</tr>
		</thead>
		<tbody id="cuerpoTablaCuestionario">				
			<?php
				$objPregunta->listarPreguntasCuestionario($objCuestionario->mostrarCuestionario($_SESSION['usuarioCuestionario'], 0),"registrar");
			?>
		</tbody>
	</table>

	<input type="button" class="btn" value="Registrar" onclick="preguntas()">
</div>