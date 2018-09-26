<?php 
	//print_r($_POST);
	include_once("../modelo/usuario.php");
	include_once("../modelo/plan_accion_empresa.php");
	$objUsuario = new Usuario();
	$objPlan=new PlanAccionEmpresa();

	switch ($_POST["cmbnombreGrafico"]) {
		case '1':
			$usuario = $objUsuario->consultarDistribucionPorGenero($_POST['cbmidEmpresa']);
			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				$datos[] = [(string)$mostrarUsuario['sexo_usuario'],(double)$mostrarUsuario['porcentaje']];
			}
			echo json_encode($datos);
			break;
		case '2':
			# code...
			break;

		case '3':
			$usuario = $objUsuario->consultarDistribucionPorEstadoCivil($_POST['cbmidEmpresa']);
			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				$datos[] = [(string)$mostrarUsuario['estado_civil_usuario'],(double)$mostrarUsuario['porcentaje']];
			}
			echo json_encode($datos);
			break;

		case '4':
			$usuario = $objUsuario->consultarDistribucionPorGradoEscolaridad($_POST['cbmidEmpresa']);
			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				$datos[] = [(string)$mostrarUsuario['nivel_estudio_usuario'],(double)$mostrarUsuario['porcentaje']];
			}
			echo json_encode($datos);
			break;
		
		case '5':
			$usuario = $objUsuario->consultarDistribucionPorEstrato($_POST['cbmidEmpresa']);
			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				$datos[] = [(string)$mostrarUsuario['estrato_usuario'],(double)$mostrarUsuario['porcentaje']];
			}
			echo json_encode($datos);
			break;

		case '6':
			$usuario = $objUsuario->consultarDistribucionVivienda($_POST['cbmidEmpresa']);
			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				$datos[] = [(string)$mostrarUsuario['tipo_vivienda_usuario'],(double)$mostrarUsuario['porcentaje']];
			}
			echo json_encode($datos);
			break;

		case '9':
			$usuario = $objUsuario->consultarDistribucionPorCargo($_POST['cbmidEmpresa']);
			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				$datos[] = [(string)$mostrarUsuario['tipo_cargo_usuario'],(double)$mostrarUsuario['porcentaje']];
			}
			echo json_encode($datos);
			break;

		case 'Capacitacion':
			$objMuyAlto = mysqli_fetch_assoc($objPlan->consultarPorcentajeDimension($_POST["cbmidEmpresa"], $_POST["comboYear"], $_POST["cmbnombreGrafico"],"Riesgo muy alto", 1));
			$objAlto = mysqli_fetch_assoc($objPlan->consultarPorcentajeDimension($_POST["cbmidEmpresa"], $_POST["comboYear"], $_POST["cmbnombreGrafico"],"Riesgo alto", 1));
			$objMedio = mysqli_fetch_assoc($objPlan->consultarPorcentajeDimension($_POST["cbmidEmpresa"], $_POST["comboYear"], $_POST["cmbnombreGrafico"],"Riesgo medio", 1));
			$objBajo = mysqli_fetch_assoc($objPlan->consultarPorcentajeDimension($_POST["cbmidEmpresa"], $_POST["comboYear"], $_POST["cmbnombreGrafico"],"Riesgo bajo", 1));
			$objSin = mysqli_fetch_assoc($objPlan->consultarPorcentajeDimension($_POST["cbmidEmpresa"], $_POST["comboYear"], $_POST["cmbnombreGrafico"],"Sin riesgo", 1));
			$datos[] = [(string)"Riesgo muy alto",(double)$objMuyAlto['porcentaje']];
			$datos[] = [(string)"Riesgo alto",(double)$objAlto['porcentaje']];
			$datos[] = [(string)"Riesgo medio",(double)$objMedio['porcentaje']];
			$datos[] = [(string)"Riesgo bajo",(double)$objBajo['porcentaje']];
			$datos[] = [(string)"Sin riesgo",(double)$objSin['porcentaje']];
			echo json_encode($datos);
			break;
		default:
			# code...
			break;
	}


 ?>