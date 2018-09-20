<?php
	include_once("../modelo/Cuestionario.php");
	$objCuestionario=new Cuestionario();
	switch ($_POST['accion']) {
		case 'listar':
			print_r($objCuestionario->listar());
			break;

		case 'listarOption':
			print_r($objCuestionario->mostrarOption($objCuestionario->listar()));
			break;

		case 'listarSinEstres':
			print_r($objCuestionario->mostrarOption($objCuestionario->listarSinEstres()));
			break;
		
		default:
			# code...
			break;
	}
?>