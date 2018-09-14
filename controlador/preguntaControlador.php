<?php
	//session_start();
	include_once("../modelo/pregunta.php");
	$objPregunta=new Pregunta();
	//echo$_POST['pag'];
	//print_r($_POST);
	switch ($_POST['accion']) {
		case 'paginacion':
			echo $objPregunta->mostrarPreguntasCuestionario($_POST['pag']);
			$contador = $_POST['pag'] - 10;
						
			for ($i=$contador; $i < ($contador+9); $i++) { 
				$_SESSION['radio'][$i] = $_POST['radio'.$i];
				$_SESSION['pregunta'][$i] = $_POST['txtPregunta'.$i];
				
		
			}

			break;
		default:
			# code...
			break;
		}
?>