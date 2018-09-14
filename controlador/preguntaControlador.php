<?php
	//session_start();
	include_once("../modelo/pregunta.php");
	$objPregunta=new Pregunta();
	//echo$_POST['pag'];
	//print_r($_POST);
	switch ($_POST['accion']) {
		case 'paginacion':
			$contador = $_POST['pag'] - 10;
			for ($i=$contador; $i <= ($contador+9); $i++) { 
				$_SESSION['infoPreguntas']['radio'][$i] = $_POST['radio'.$i];
				$_SESSION['infoPreguntas']['pregunta'][$i] = $_POST['txtPregunta'.$i];
			}
			echo $objPregunta->mostrarPreguntasCuestionario($_POST['pag']);
			break;
		default:
			# code...
			break;
		}
?>