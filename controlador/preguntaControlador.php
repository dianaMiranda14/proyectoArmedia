<?php
	//session_start();
	include_once("../modelo/pregunta.php");
	$objPregunta=new Pregunta();
	//echo$_POST['pag'];
	//print_r($_POST);
	switch ($_POST['accion']) {
		case 'paginacion':
			for ($i=$_POST['txtInicio']; $i < $_POST['pag']; $i++) { 
				$_SESSION['infoPreguntas']['radio'][$i] = $_POST['radio'.$i];
				$_SESSION['infoPreguntas']['pregunta'][$i] = $_POST['txtPregunta'.$i];
			}
			echo $objPregunta->mostrarPreguntasCuestionario($_POST['pag'],0);
			break;

		case 'paginacionAnterior':
			echo $objPregunta->mostrarPreguntasCuestionario($_POST['pag'],0);
			break;

		case 'mostrar':
			$i=$_POST['pag'];
			if ($_POST["descripcion"]=='no') {
				$resultado=$objPregunta->preguntasDimension($_SESSION["infoPreguntas"]["idCuestionario"],$_POST['idDimension']);
				if (mysqli_num_rows($resultado)>0) {
					$_POST["idDimension"]=0;
					while ($objP=(mysqli_fetch_assoc($resultado))) {
						$_SESSION['infoPreguntas']['radio'][$i] = 0;
						$_SESSION['infoPreguntas']['pregunta'][$i] = $objP["id_pregunta"];
						$i++;
					}
				}
			}
			echo $objPregunta->mostrarPreguntasCuestionario($i,$_POST['idDimension']);
			break;
		default:
			# code...
			break;
		}
?>