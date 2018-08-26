<?php
	include_once("../modelo/Dimension.php");
	$objDimension=new Dimension();

	switch ($_POST['accion']) {
		case 'listar':
			print_r($objDimension->listar());
			break;
		
		default:
			# code...
			break;
	}
?>