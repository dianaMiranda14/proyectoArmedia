<?php 
//	print_r($_POST);
	include_once("../modelo/usuario.php");
	$objUsuario = new Usuario();

if ($_POST['cmbnombreGrafico'] == 1) {
	$usuario = $objUsuario->consultarDistribucionPorGenero($_POST['cbmidEmpresa']);
		while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
			$datos[] = [(string)$mostrarUsuario['sexo_usuario'],(double)$mostrarUsuario['porcentaje']];
		}
	echo json_encode($datos);

}elseif($_POST['cmbnombreGrafico'] == 2){



}elseif($_POST['cmbnombreGrafico'] == 3){
	$usuario = $objUsuario->consultarDistribucionPorEstadoCivil($_POST['cbmidEmpresa']);
		while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
			$datos[] = [(string)$mostrarUsuario['estado_civil_usuario'],(double)$mostrarUsuario['porcentaje']];
		}
	echo json_encode($datos);

}elseif($_POST['cmbnombreGrafico'] == 4){
	$usuario = $objUsuario->consultarDistribucionPorGradoEscolaridad($_POST['cbmidEmpresa']);
		while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
			$datos[] = [(string)$mostrarUsuario['nivel_estudio_usuario'],(double)$mostrarUsuario['porcentaje']];
		}
	echo json_encode($datos);

}elseif($_POST['cmbnombreGrafico'] == 5){
	$usuario = $objUsuario->consultarDistribucionPorEstrato($_POST['cbmidEmpresa']);
		while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
			$datos[] = [(string)$mostrarUsuario['estrato_usuario'],(double)$mostrarUsuario['porcentaje']];
		}
	echo json_encode($datos);
	
}elseif($_POST['cmbnombreGrafico'] == 6){
	$usuario = $objUsuario->consultarDistribucionVivienda($_POST['cbmidEmpresa']);
		while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
			$datos[] = [(string)$mostrarUsuario['tipo_vivienda_usuario'],(double)$mostrarUsuario['porcentaje']];
		}
	echo json_encode($datos);
	
}elseif($_POST['cmbnombreGrafico'] == 7){



}elseif($_POST['cmbnombreGrafico'] == 8){


}elseif($_POST['cmbnombreGrafico'] == 9){

$usuario = $objUsuario->consultarDistribucionPorCargo($_POST['cbmidEmpresa']);
		while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
			$datos[] = [(string)$mostrarUsuario['tipo_cargo_usuario'],(double)$mostrarUsuario['porcentaje']];
		}
	echo json_encode($datos);

}elseif($_POST['cmbnombreGrafico'] == 10){



}elseif($_POST['cmbnombreGrafico'] == 11){



}


	/*switch ($_POST['cmbnombreGrafico']) {

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
	}*/

 ?>