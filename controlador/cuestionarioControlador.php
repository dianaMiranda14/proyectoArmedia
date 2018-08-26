<?php
	include_once("../modelo/Cuestionario.php");
	$objCuestionario=new Cuestionario();
	switch ($_POST['accion']) {
		case 'listar':
			print_r($objCuestionario->listar());
			break;
		
		default:
			# code...
			break;
	}
?>