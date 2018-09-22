<?php
	include_once("../modelo/Dimension.php");
	$objDimension=new Dimension();

	switch ($_POST['accion']) {
		case 'listar':
			print_r($objDimension->listar());
			break;

		case 'mostrarOption':
			echo $objDimension->mostrarOption();
			break;

		case 'mostrarContenido':
			echo $objDimension->mostrarContenido($_POST['idCuestionario']);
			break;
		
		default:
			# code...
			break;
	}
?>