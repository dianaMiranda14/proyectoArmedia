<?php
	include_once("../modelo/pregunta.php");
	$objPregunta=new Pregunta();
	//print_r($_POST);
	switch ($_POST['accion']) {
		case 'paginacion':
			echo $objPregunta->mostrarPreguntasCuestionario($_POST['pag']);
			break;

		default:
			# code...
			break;
		}
?>