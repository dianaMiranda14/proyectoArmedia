<?php
	include_once("../modelo/Dimension.php");
	$objDimension=new Dimension();

	switch ($_POST['accion']) {
		case 'listar':
			print_r($objDimension->listar());
			break;

		case 'mostrarOption':
			echo $resultado=$objDimension->mostrarOption();
			break;

		case 'mostrarContenido':
			echo $resultado=$objDimension->mostrarContenido();
			break;
		
		default:
			# code...
			break;
	}
?>