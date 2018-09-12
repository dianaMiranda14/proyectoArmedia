<?php
	include_once("../modelo/pregunta.php");

	switch ($_POST['accion']) {
		case 'listar':
			print_r($objPregunta->listar());
			break;

		default:
			# code...
			break;
		}
?>