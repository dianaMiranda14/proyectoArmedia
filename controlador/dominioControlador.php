<?php
	include_once("../modelo/dominio.php");
	$objDominio=new Dominio();

	switch ($_POST['accion']) {
		case 'listar':
			print_r($objDominio->listar());
			break;
		
		default:
			# code...
			break;
	}
?>