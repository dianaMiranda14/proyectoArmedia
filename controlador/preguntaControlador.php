<?php
	include_once("../modelo/pregunta.php");

	class preguntaControlador{
		$objPregunta=new Pregunta();

		switch ($_POST['accion']) {
		case 'listar':
			print_r($objPregunta->listar());
			break;
		
		default:
			# code...
			break;
	}
	}
?>