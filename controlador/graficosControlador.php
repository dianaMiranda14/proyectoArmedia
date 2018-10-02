<?php 
	//print_r($_POST);
	include_once("../modelo/usuario.php");
	include_once("../modelo/plan_accion_empresa.php");
	include_once("../modelo/graficos.php");
	$objUsuario = new Usuario();
	$objPlan=new PlanAccionEmpresa();
	$objGrafico = new Graficos();


	switch ($_POST["cmbnombreGrafico"]) {
		case '1':
			$usuario = $objUsuario->consultarDistribucionPorGenero($_POST['cbmidEmpresa']);
			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				$datos[] = [(string)$mostrarUsuario['sexo_usuario'],(double)$mostrarUsuario['porcentaje']];
			}


			echo json_encode($datos);
			break;
		case '2':
			$usuario = $objUsuario->consultarPorGrupoEtario($_POST['cbmidEmpresa']);
				$menosde20 = 0;
				$de21a30 = 0;
				$de31a40 = 0;
				$de41a50 = 0;
				$masde50 = 0;
				$totalDatos = 0;

			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				if ($mostrarUsuario['edad'] <= 20) {
					$menosde20 ++;
				}else if($mostrarUsuario['edad'] >= 21 && $mostrarUsuario['edad'] <= 30){
					$de21a30 ++;
				}else if($mostrarUsuario['edad'] >= 31 && $mostrarUsuario['edad'] <= 40){
					$de31a40 ++;
				}else if($mostrarUsuario['edad'] >= 41 && $mostrarUsuario['edad'] <= 50){
					$de41a50 ++;
				}else if($mostrarUsuario['edad'] >= 50){
					$masde50 ++;
				}
				$totalDatos++;
			}
				//$totalDatos = count($usuario);

				$resultadomenosde20 = $menosde20 *100 / $totalDatos;
				$resultadode21a30 = $de21a30 *100 / $totalDatos;
				$resultadode31a40 = $de31a40 *100 / $totalDatos;
				$resultadode41a50 = $de41a50 *100 / $totalDatos;
				$resultadomasde50 = $masde50 *100 / $totalDatos;

				$resultadomenosde20 = number_format($resultadomenosde20,2);
				$resultadode21a30 = number_format($resultadode21a30,2);
				$resultadode31a40 = number_format($resultadode31a40,2);
				$resultadode41a50 = number_format($resultadode41a50,2);
				$resultadomasde50 = number_format($resultadomasde50,2);

				if ($menosde20 != 0) {
					$datos[] = ["Menos de 20 Años ".$resultadomenosde20."%",(double)$resultadomenosde20];
				}

				if ($de21a30 != 0) {
					$datos[] = ["21 a 30 Años ".$resultadode21a30."%",(double)$resultadode21a30];
				}
				if ($de31a40 != 0) {
					$datos[] = ["31 a 40 Años".$resultadode31a40."%",(double)$resultadode31a40];
				}
				if ($de41a50 != 0) {
					$datos[] = ["41 a 50 Añoss".$resultadode41a50."%",(double)$resultadode41a50];
				}
				if ($masde50 != 0) {
					$datos[] = ["Mas de 50 Años".$resultadomasde50."%",(double)$resultadomasde50];
				}

				echo json_encode($datos);

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

		case '7':
			$usuario = $objUsuario->consultarPorEmpresa($_POST['cbmidEmpresa']);

			$cero = 0;
			$de1a2 = 0;
			$de3a4 = 0;
			$masde4 = 0;
			$totalDatos = 0;


			while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
				if ($mostrarUsuario['personas_dependen_usuario'] == 0) {
					$cero ++;

				}
				if($mostrarUsuario['personas_dependen_usuario'] >= 1 && $mostrarUsuario['personas_dependen_usuario'] <= 2){
					$de1a2 ++;
				}
				if ($mostrarUsuario['personas_dependen_usuario'] >= 3 && $mostrarUsuario['personas_dependen_usuario'] <= 4) {
					$de3a4 ++;
				}
				if ($mostrarUsuario['personas_dependen_usuario'] > 4) {
					$masde4 ++;
				}
					$totalDatos++;
			}
				//$totalDatos = count($usuario);
				$resultadocero = $cero * 100 /$totalDatos;
				$resultadpde1a2 = $de1a2 * 100 /$totalDatos;
				$resultadode3a4 = $de3a4 * 100 /$totalDatos;
				$resultadomasde4 = $masde4 * 100 /$totalDatos;

				$resultadocero = number_format($resultadocero,2);
				$resultadpde1a2 = number_format($resultadpde1a2,2);
				$resultadode3a4 = number_format($resultadode3a4,2);
				$resultadomasde4 = number_format($resultadomasde4,2);

				if ($cero != 0) {
					$datos[] = ["0 personas ".$resultadocero."%",(double)$resultadocero];
				}
				if($de1a2 != 0){
					$datos[] = ["1 a 2 personas ".$resultadpde1a2."%",(double)$resultadpde1a2];
				}
				if($de3a4 != 0){
					$datos[] = ["3 a 4 personas ".$resultadode3a4."%",(double)$resultadode3a4];
				}
				if($masde4 != 0){
					$datos[] = ["Mas de 4 personas ".$resultadomasde4."%",(double)$resultadomasde4];
				}

			echo json_encode($datos);

			break;

		case '8':
			$usuario = $objUsuario->consultarPorEmpresa($_POST['cbmidEmpresa']);

			$Menosde1 = 0;
			$de1a5 = 0;
			$de5a10 = 0;
			$Masde10 = 0;
			$totalDatos = 0;

				while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
					if ($mostrarUsuario['years_trabajo_usuario'] < 1) {
						$Menosde1 ++;
					}else if($mostrarUsuario['years_trabajo_usuario'] >= 1 && $mostrarUsuario['years_trabajo_usuario'] < 5){
						$de1a5 ++;
					}else if($mostrarUsuario['years_trabajo_usuario'] >= 5 && $mostrarUsuario['years_trabajo_usuario'] <= 10){
						$de5a10 ++;
					}else if($mostrarUsuario['years_trabajo_usuario'] > 10 ){
						$Masde10 ++;
					}
					$totalDatos++;
				}


				$resultadomenosde1 = $Menosde1 * 100 /$totalDatos;
				$resultadpde1a5 = $de1a5 * 100 /$totalDatos;
				$resultadode5a10 = $de5a10 * 100 /$totalDatos;
				$resultadomasde10 = $Masde10 * 100 /$totalDatos;

				$resultadomenosde1 = number_format($resultadomenosde1,2);
				$resultadpde1a5 = number_format($resultadpde1a5,2);
				$resultadode5a10 = number_format($resultadode5a10,2);
				$resultadomasde10 = number_format($resultadomasde10,2);


				if ($Menosde1 != 0) {
					$datos[] = ["Menos de 1 Año ".$resultadomenosde1."%",(double)$resultadomenosde1];
				}
				if($de1a5 != 0){
					$datos[] = ["1 a 5 años ".$resultadpde1a5."%",(double)$resultadpde1a5];
				}
				if($de5a10 != 0){
					$datos[] = ["5 a 10 años ".$resultadode5a10."%",(double)$resultadode5a10];
				}
				if($Masde10 != 0){
					$datos[] = ["Mas de 10 años ".$resultadomasde10."%",(double)$resultadomasde10];
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

		case '10':

			$usuario = $objUsuario->consultarTiempoEnElCargo($_POST['cbmidEmpresa']);

		
			$Menosde1 = 0;
			$de1a5 = 0;
			$de5a10 = 0;
			$Masde10 = 0;
			$totalDatos = 0;

				while ($mostrarUsuario = mysqli_fetch_assoc($usuario)) {
					if ($mostrarUsuario['years_cargo_usuario'] < 1) {
						$Menosde1 ++;
					}else if($mostrarUsuario['years_cargo_usuario'] >= 1 && $mostrarUsuario['years_cargo_usuario'] <= 5){
						$de1a5 ++;
					}else if($mostrarUsuario['years_cargo_usuario'] >= 6 && $mostrarUsuario['years_cargo_usuario'] <= 10){
						$de5a10 ++;
					}else if($mostrarUsuario['years_cargo_usuario'] > 10 ){
						$Masde10 ++;
					}
					$totalDatos++;
				}


				$resultadomenosde1 = $Menosde1 * 100 /$totalDatos;
				$resultadpde1a5 = $de1a5 * 100 /$totalDatos;
				$resultadode5a10 = $de5a10 * 100 /$totalDatos;
				$resultadomasde10 = $Masde10 * 100 /$totalDatos;

				$resultadomenosde1 = number_format($resultadomenosde1,2);
				$resultadpde1a5 = number_format($resultadpde1a5,2);
				$resultadode5a10 = number_format($resultadode5a10,2);
				$resultadomasde10 = number_format($resultadomasde10,2);


				if ($Menosde1 != 0) {
					$datos[] = ["Menos de 1 Año ".$resultadomenosde1."%",(double)$resultadomenosde1];
				}
				if($de1a5 != 0){
					$datos[] = ["1 a 5 años ".$resultadpde1a5."%",(double)$resultadpde1a5];
				}
				if($de5a10 != 0){
					$datos[] = ["5 a 10 años ".$resultadode5a10."%",(double)$resultadode5a10];
				}
				if($Masde10 != 0){
					$datos[] = ["Mas de 10 años ".$resultadomasde10."%",(double)$resultadomasde10];
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