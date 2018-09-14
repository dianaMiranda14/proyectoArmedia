<?php
	include_once("../modelo/usuario.php");
	include_once("../modelo/resultadoDimension.php");
	include_once("../modelo/resultadoDominio.php");
	include_once("../modelo/presentacion.php");
	include_once("../modelo/empresa.php");

	print_r($_POST);
	$objEmpresa=new Empresa();
	$objPresentacion=new Presentacion();
	switch ($_POST['comboTipoInforme']) {
		case '0':
			mostrarIntralaboral($_POST['txtCedula']);
			mostrarExtralaboral($_POST['txtCedula']);
			mostrarEstres($_POST['txtCedula']);
			break;
		
		case '1':
			$resultadoEmpresa=$objEmpresa->consultarUsuarios($_POST['comboEmpresa']);
			print_r(mysqli_num_rows($resultadoEmpresa));
			if (mysqli_num_rows($resultadoEmpresa)>0) {
				while ($objU=mysqli_fetch_assoc($resultadoEmpresa)) {
					print_r($objU);
					mostrarIntralaboral($objU['cedula_usuario']);

				}
			}
			break;

		case '2':
			$resultadoEmpresa=$objEmpresa->consultarUsuarios($_POST['comboEmpresa']);
			if (mysqli_num_rows($resultadoEmpresa)>0) {
				while ($objU=mysqli_fetch_assoc($resultadoEmpresa)) {
					mostrarExtralaboral($objU['cedula_usuario']);

				}
			}
			break;

		case '3':
			$resultadoEmpresa=$objEmpresa->consultarUsuarios($_POST['comboEmpresa']);
			if (mysqli_num_rows($resultadoEmpresa)>0) {
				while ($objU=mysqli_fetch_assoc($resultadoEmpresa)) {
					mostrarEstres($objU['cedula_usuario']);

				}
			}
			break;

		case '4':
			$resultadoEncuestados=$objPresentacion->consultarUsuarios($_POST['comboEmpresa'], $_POST['comboYear']);
			if (mysqli_num_rows($resultadoEncuestados)>0) {
				while ($objE=mysqli_fetch_assoc($resultadoEncuestados)) {
					print_r($objE);
				}
			}
			break;

		case '5':
			$resultadoRiesgo=$objPresentacion->usuariosRiesgoEstres($_POST['comboEmpresa'], $_POST['comboYear']);
			if (mysqli_num_rows($resultadoRiesgo)>0) {
				while ($objR=mysqli_fetch_assoc($resultadoRiesgo)) {
					print_r($objR);
				}
			}
			break;

		case '6':
			# code...
			break;

	}

	function sacarDatosUsuario($cedula){
		$objUsuario=new Usuario();
		$resultadoUsuario=$objUsuario->consultarCedula($cedula);
		if (mysqli_num_rows($resultadoUsuario)>0) {
			return mysqli_fetch_assoc($resultadoUsuario);
		}
	}

	function tipoUsuario($usuario){
		if ($usuario['tipo_cargo_usuario']==='Jefatura' || 
				$usuario['tipo_cargo_usuario']==='Profesional' ||
				$usuario['tipo_cargo_usuario']==='analista' ||
				$usuario['tipo_cargo_usuario']==='Tecnico especializado') {
			return "jefe";
		}else{
			return "auxiliar";
		}
	}

	function resultadoDominio($idCuestionario, $cedula){
		$objResultadoDominio=new ResultadoDominio();
		$resultadoDominio=$objResultadoDominio->consultarResultadoDominio($idCuestionario, $_POST['comboYear'], $cedula);
		if (mysqli_num_rows($resultadoDominio)) {
			$contador=0;
			while ($obj=mysqli_fetch_assoc($resultadoDominio)) {
				$arrResultadoDominio[$contador]=$obj;
				$contador++;
			}
			return $arrResultadoDominio;
		}
	}

	function resultadoDimension($idCuestionario, $cedula){
		$objResultadoDimension=new ResultadoDimension();
		$resultadoDimension=$objResultadoDimension->consultarResultadoDimension($idCuestionario, $_POST['comboYear'], $cedula);
		if (mysqli_num_rows($resultadoDimension)) {
			$contador=0;
			while ($obj=mysqli_fetch_assoc($resultadoDimension)) {
				$arrResultadoDimension[$contador]=$obj;
				$contador++;
			}
			return $arrResultadoDimension;
		}
	}

	function resultadoCuestionario($idCuestionario, $cedula){
		$objPresentacion=new Presentacion();
		$resultadoPresentacion=$objPresentacion->consultarPresentacion($idCuestionario, $cedula, $_POST['comboYear']);
		if (mysqli_num_rows($resultadoPresentacion)>0) {
			return mysqli_fetch_assoc($resultadoPresentacion);
		}
	}

	function mostrarIntralaboral($cedula){
		$objResultadoUsuario=sacarDatosUsuario($cedula);
		$tipo=tipoUsuario($objResultadoUsuario);
		if ($tipo==="jefe") {
			$idCuestionario=1;
		}else{
			$idCuestionario=2;
		}
		$resultadoDominio=resultadoDominio($idCuestionario, $cedula);
		$resultadoDimension=resultadoDimension($idCuestionario, $cedula);
		$resultadoCuestionario=resultadoCuestionario($idCuestionario, $cedula);
		print_r($resultadoDominio);
		print_r($resultadoDimension);
		print_r($resultadoCuestionario);
	}

	function mostrarExtralaboral($cedula){
		$objResultadoUsuario=sacarDatosUsuario($cedula);
		$tipo=tipoUsuario($objResultadoUsuario);
		if ($tipo==="jefe") {
			$idCuestionario=3;
		}else{
			$idCuestionario=4;
		}
		$resultadoDimension=resultadoDimension($idCuestionario, $cedula);
		$resultadoCuestionario=resultadoCuestionario($idCuestionario, $cedula);
		print_r($resultadoDimension);
		print_r($resultadoCuestionario);
	}

	function mostrarEstres($cedula){
		$objResultadoUsuario=sacarDatosUsuario($cedula);
		$tipo=tipoUsuario($objResultadoUsuario);
		if ($tipo==="jefe") {
			$idCuestionario=5;
		}else{
			$idCuestionario=6;
		}
		$resultadoCuestionario=resultadoCuestionario($idCuestionario, $cedula);
		print_r($resultadoCuestionario);
	}

?>