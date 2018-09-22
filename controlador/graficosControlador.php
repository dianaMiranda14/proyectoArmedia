<?php 
//	print_r($_POST);
	include_once("../modelo/usuario.php");
	$objUsuario = new Usuario();

	switch ($_POST['cmbnombreGrafico']) {

		case '1':
			$usuario = $objUsuario->consultarDistribucionPorGenero($_POST['cbmidEmpresa']);
			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				//echo $mostrarUsuario['porcentaje'];
				$datos[] = [(string)$mostrarUsuario['sexo_usuario'],(double)$mostrarUsuario['porcentaje']];

			}
				echo json_encode($datos);
			break;

		case '2':
				$usuario = $objUsuario->consultarDistribucionPorEstadoCivil($_POST['cbmidEmpresa']);
			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				$datos[] = [(string)$mostrarUsuario['estado_civil_usuario'],(double)$mostrarUsuario['porcentaje']];
			}
				echo json_encode($datos);
			break;
		
		default:
			# code...
			break;
	}

 ?>