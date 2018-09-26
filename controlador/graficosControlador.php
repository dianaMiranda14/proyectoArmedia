<?php 
	//print_r($_POST);
	include_once("../modelo/usuario.php");
	$objUsuario = new Usuario();

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
		default:
			# code...
			break;
	}


 ?>