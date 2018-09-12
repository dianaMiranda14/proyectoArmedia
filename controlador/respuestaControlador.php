<?php
	include_once("../modelo/respuesta.php");
	include_once("../modelo/pregunta.php");
	include_once("../modelo/presentacion.php");
	include_once("../modelo/dimension.php");
	include_once("../modelo/dominio.php");
	include_once("../modelo/resultadoDimension.php");
	include_once("../modelo/resultadoDominio.php");
	include_once("../modelo/cuestionario.php");

	$objPregunta=new Pregunta();
	$objRespuesta=new Respuesta();
	$objPresentacion=new presentacion();
	$objCuestionario=new Cuestionario();

	print_r($_POST);
	
	session_start();

	switch ($_POST['accion']) {

		case 'registrar':
			$objPresentacion->registrar($_POST['idCuestionario'],$_SESSION['usuarioCuestionario']['cedula_usuario'], date("Y-m-d"));
			//consulta la presentacion que acaba de registrar
			$resultado=$objPresentacion->consultarFecha(date("Y-m-d"),$_SESSION['usuarioCuestionario']['cedula_usuario']);
			if (mysqli_num_rows($resultado)>0) {
				$objPresent=mysqli_fetch_assoc($resultado);
				for ($i=0; $i < $_POST['cantidad']; $i++) { 
					$objRespuesta->registrar($objPresent['id_presentacion'],$_POST['txtPregunta'.$i],$_POST['radio'.$i]);
				}
				calcularValoresDimension($objPresent);
				calcularValoresDominio($objPresent);
				calcularValoresCuestionario($objPresent);
				//print_r($objPregunta->listarPreguntasCuestionario($objCuestionario->mostrarCuestionario($_SESSION['usuarioCuestionario'], 1),"registrar"));
			}
			break;

			case 'registrarEstres':
				$objPresentacion->registrar($_POST['idCuestionario'],$_SESSION['usuarioCuestionario']['cedula_usuario'], date("Y-m-d"));
				//consulta la presentacion que acaba de registrar
				$resultado=$objPresentacion->consultarFecha(date("Y-m-d"),$_SESSION['usuarioCuestionario']['cedula_usuario']);
				if (mysqli_num_rows($resultado)>0) {
					$objPresent=mysqli_fetch_assoc($resultado);
				}
				for ($i=0; $i < $_POST['cantidad']; $i++) { 
					$objRespuesta->registrar($objPresent['id_presentacion'],$_POST['txtPregunta'.$i],$_POST['radio'.$i]);
				}
				calcularValoresDimensionEstres($objPresent);
				calcularValoresCuestionarioEstres($objPresent);
				break;
		default:
			# code...
			break;
		}

		function calcularValoresDimensionEstres($objPresent){
			$objRespuesta=new Respuesta();
			$objDimension=new Dimension();
			$objResultadoDimension=new ResultadoDimension();
			$resultado=$objDimension->consultarCuestionario($_POST['idCuestionario']);
			if (mysqli_num_rows($resultado)>0) {
				while ($objD=mysqli_fetch_assoc($resultado)) {
					//calcula el promedio de todas las respuestas de las preguntas de la dimension
					$res=$objDimension->promedioRespuestaDimension($objD['id_dimension'],$objPresent['id_presentacion']);
					if (mysqli_num_rows($res)>0) {
						$objR=mysqli_fetch_assoc($res);
						$v=round(($objR['promedio']*$objD['valor_dimension']),1);
						print_r($objD['valor_dimension']."    ".$objD['descripcion_dimension']."    ".$objR['promedio']."    ".$v."\n");
						$objResultadoDimension->registrar($objPresent['id_presentacion'], $objD['id_dimension'], $v, null);
					}
				}
			}
		}

		function calcularValoresCuestionarioEstres($objPresent){
			$objPresentacion=new presentacion();
			$objDominio=new Dominio();
			$objCuestionario=new Cuestionario();
			//calcula el valor de todo el cuestionario
			$objRC=mysqli_fetch_assoc($objCuestionario->sumaResultadoCuestionarioEstres($objPresent['id_presentacion']));
			$objC=mysqli_fetch_assoc($objCuestionario->consultarId($_POST['idCuestionario']));
			$val=round((($objRC['suma']/$objC['valor_cuestionario'])*100),1);
			if ($val<=$objC['limite_sin_riesgo_cuestionario']) {
				$riesgo="Sin riesgo";
			}else if ($val<=$objC['limite_riesgo_bajo_cuestionario']) {
				$riesgo="Riesgo bajo";
			}else if($val<=$objC['limite_riesgo_medio_cuestionario']){
				$riesgo="Riesgo medio";
			}else{
				$riesgo="Riesgo muy alto";
			}
			$objPresentacion->modificar($objPresent['id_presentacion'], $val, $riesgo);
		
		}

		function calcularValoresDimension($objPresent){
			$objRespuesta=new Respuesta();
			$objDimension=new Dimension();
			$objResultadoDimension=new ResultadoDimension();
			//consulta todas las dimensiones que tiene el cuestionario
			$resultado=$objDimension->consultarCuestionario($_POST['idCuestionario']);
			if (mysqli_num_rows($resultado)>0) {
				while ($objD=mysqli_fetch_assoc($resultado)) {
					//suma todas las respuestas de las preguntas de la dimension
					$res=$objDimension->sumaRespuestaDimension($objD['id_dimension'],$objPresent['id_presentacion']);
					if (mysqli_num_rows($res)>0) {
						$objR=mysqli_fetch_assoc($res);
						$v=round((($objR['suma']/$objD['valor_dimension'])*100),1);
						if ($v<=$objD['limite_sin_riesgo_dimension']) {
							$riesgo="Sin riesgo";
						}else if ($v<=$objD['limite_riesgo_bajo_dimension']) {
							$riesgo="Riesgo bajo";
						}else if($v<=$objD['limite_riesgo_medio_dimension']){
							$riesgo="Riesgo medio";
						}else if ($v<=$objD['limite_riesgo_alto_dimension']) {
							$riesgo="Riesgo alto";
						}else{
							$riesgo="Riesgo muy alto";
						}
						print_r($objD['descripcion_dimension']."    ".$v."    ".$riesgo);
						$objResultadoDimension->registrar($objPresent['id_presentacion'], $objD['id_dimension'], $v, $riesgo);
					}
				}
			}
		}

		function calcularValoresDominio($objPresent){
			$objDimension=new Dimension();
			$objDominio=new Dominio();
			$objResultadoDominio= new ResultadoDominio();
			//consulta todos los dominios que tiene relacionado el cuestionario
			$resultado=$objDominio->consultarPorCuestionario($_POST['idCuestionario']);
			if (mysqli_num_rows($resultado)>0) {
				while ($objDom=mysqli_fetch_assoc($resultado)) {
					//suma las respuestas de las preguntas que pertenecen al dominio
					$res=$objDominio->sumaResultadoDimension($objDom['id_dominio'], $objPresent['id_presentacion']);
					$objRDom=mysqli_fetch_assoc($res);
					$v=round((($objRDom['suma']/$objDom['valor_dominio'])*100),1);
					if ($v<=$objDom['limite_sin_riesgo_dominio']) {
						$riesgo="Sin riesgo";
					}else if ($v<=$objDom['limite_riesgo_bajo_dominio']) {
						$riesgo="Riesgo bajo";
					}else if($v<=$objDom['limite_riesgo_medio_dominio']){
						$riesgo="Riesgo medio";
					}else if ($v<=$objDom['limite_riesgo_alto_dominio']) {
						$riesgo="Riesgo alto";
					}else{
						$riesgo="Riesgo muy alto";
					}
					print_r($objDom['descripcion_dominio']."    ".$v."    ".$riesgo);
					$objResultadoDominio->registrar($objPresent['id_presentacion'], $objDom['id_dominio'], $v, $riesgo);
				}
			}
		}

		function calcularValoresCuestionario($objPresent){
			$objPresentacion=new presentacion();
			$objDominio=new Dominio();
			$objCuestionario=new Cuestionario();
			//calcula el valor de todo el cuestionario
			$val=mysqli_fetch_assoc($objCuestionario->sumaResultadoCuestionario($objPresent['id_presentacion']));
			$objC=mysqli_fetch_assoc($objCuestionario->consultarId($_POST['idCuestionario']));
			$v=round((($val['suma']/$objC['valor_cuestionario'])*100),1);
			if ($v<=$objC['limite_sin_riesgo_cuestionario']) {
				$riesgo="Sin riesgo";
			}else if ($v<=$objC['limite_riesgo_bajo_cuestionario']) {
				$riesgo="Riesgo bajo";
			}else if($v<=$objC['limite_riesgo_medio_cuestionario']){
				$riesgo="Riesgo medio";
			}else{
				$riesgo="Riesgo muy alto";
			}
			$objPresentacion->modificar($objPresent['id_presentacion'], $v, $riesgo);
		}


?>