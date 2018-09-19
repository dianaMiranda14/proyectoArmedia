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

	switch ($_SESSION['infoPreguntas']['accion']) {
		//aqui registrar para intralaboral forma A y B y para el extralaboral de jefes y auxiliares
		case 'registrar':
			for ($i=$_POST['txtCantidad']; $i < $_SESSION['infoPreguntas']['cantidad']; $i++) { 
				$_SESSION['infoPreguntas']['radio'][$i] = $_POST['radio'.$i];
				$_SESSION['infoPreguntas']['pregunta'][$i] = $_POST['txtPregunta'.$i];
			}
			//print_r($_SESSION['infoPreguntas']);
			//registra la presentacion del cuestionario
			$objPresentacion->registrar($_SESSION['infoPreguntas']['idCuestionario'],$_SESSION['usuarioCuestionario']['cedula_usuario'], date("Y-m-d"));
			//consulta la presentacion que acaba de registrar
			$resultado=$objPresentacion->consultarFecha(date("Y-m-d"),$_SESSION['usuarioCuestionario']['cedula_usuario']);
			if (mysqli_num_rows($resultado)>0) {
				$objPresent=mysqli_fetch_assoc($resultado);

				for ($i=0; $i < $_SESSION['infoPreguntas']['cantidad']; $i++) { 
					//registra las respuestas con la informacion que llega por el post y la presentacion que acabo de registrar
					$objRespuesta->registrar($objPresent['id_presentacion'],$_SESSION['infoPreguntas']['pregunta'][$i],$_SESSION['infoPreguntas']['radio'][$i]);
				}
				//calcula los valores transformados de cada dimension y el nivel de riesgo
				calcularValoresDimension($objPresent);
				//calcula los valores transformados de cada dominio y el nivel de riesgo
				calcularValoresDominio($objPresent);
				//calcula el valor del cuestionario y el nivel de riesgo
				calcularValoresCuestionario($objPresent);
				//aumenta la posicion del cuestionario para mostrar el siguiente 
				echo "Antes";
				print_r($_SESSION['posCuestionario']);
				$_SESSION['posCuestionario']++;
				echo "Despues";
				print_r($_SESSION['posCuestionario']);
				unset($_SESSION['infoPreguntas']);
				//valida si ya es el formulario de estres porque ese es diferente
				if ($_SESSION['posCuestionario']==2) {
					print_r($objPregunta->mostrarInicioCuestionario($objCuestionario->mostrarCuestionario($_SESSION['usuarioCuestionario'], $_SESSION['posCuestionario']),"registrarEstres", 0));
				}else{
					print_r($objPregunta->mostrarInicioCuestionario($objCuestionario->mostrarCuestionario($_SESSION['usuarioCuestionario'], $_SESSION['posCuestionario']),"registrar", 0));
				}
				
			}
			break;

			//registra el cuestionario de estres para jefes y auxiliares
			case 'registrarEstres':
				for ($i=$_POST['txtCantidad']; $i < $_SESSION['infoPreguntas']['cantidad']; $i++) { 
					$_SESSION['infoPreguntas']['radio'][$i] = $_POST['radio'.$i];
					$_SESSION['infoPreguntas']['pregunta'][$i] = $_POST['txtPregunta'.$i];
				}
				//registra la presentacion del cuestionario
				$objPresentacion->registrar($_SESSION['infoPreguntas']['idCuestionario'],$_SESSION['usuarioCuestionario']['cedula_usuario'], date("Y-m-d"));
				//consulta la presentacion que acaba de registrar
				$resultado=$objPresentacion->consultarFecha(date("Y-m-d"),$_SESSION['usuarioCuestionario']['cedula_usuario']);
				if (mysqli_num_rows($resultado)>0) {
					$objPresent=mysqli_fetch_assoc($resultado);
					//guarda las respuestas del cuestionario
					for ($i=0; $i < $_SESSION['infoPreguntas']['cantidad']; $i++) { 
						$objRespuesta->registrar($objPresent['id_presentacion'],$_SESSION['infoPreguntas']['pregunta'][$i],$_SESSION['infoPreguntas']['radio'][$i]);
					} 
					//calcula el valor de cada dimension
					calcularValoresDimensionEstres($objPresent);
					//calcula el valor del cuestionario y el nivel de riesgo
					calcularValoresCuestionarioEstres($objPresent);
					unset($_SESSION['infoPreguntas']);
					unset($_SESSION['posCuestionario']);
				}
				break;
		default:
			# code...
			break;
		}

		function calcularValoresDimensionEstres($objPresent){
			$objRespuesta=new Respuesta();
			$objDimension=new Dimension();
			$objResultadoDimension=new ResultadoDimension();
			//consulta las dimensiones que estan relacionadas con el cuestionario
			$resultado=$objDimension->consultarCuestionario($_SESSION['infoPreguntas']['idCuestionario']);
			if (mysqli_num_rows($resultado)>0) {
				while ($objD=mysqli_fetch_assoc($resultado)) {
					//calcula el promedio de todas las respuestas de las preguntas de la dimension
					$res=$objDimension->promedioRespuestaDimension($objD['id_dimension'],$objPresent['id_presentacion']);
					if (mysqli_num_rows($res)>0) {
						$objR=mysqli_fetch_assoc($res);
						//hace la operacion del excel jajajaja
						$v=round(($objR['promedio']*$objD['valor_dimension']),1);
						//print_r($objD['valor_dimension']."    ".$objD['descripcion_dimension']."    ".$objR['promedio']."    ".$v."\n");
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
			$objC=mysqli_fetch_assoc($objCuestionario->consultarId($_SESSION['infoPreguntas']['idCuestionario']));
			//suma los valores de las dimensiones relacionadas al cuestionario y la divide
			$val=round((($objRC['suma']/$objC['valor_cuestionario'])*100),1);
			//calcula el nivel de risgo segun el resultado de la operacion anterior
			if ($val<=$objC['limite_sin_riesgo_cuestionario']) {
				$riesgo="Sin riesgo";
			}else if ($val<=$objC['limite_riesgo_bajo_cuestionario']) {
				$riesgo="Riesgo bajo";
			}else if($val<=$objC['limite_riesgo_medio_cuestionario']){
				$riesgo="Riesgo medio";
			}else{
				$riesgo="Riesgo muy alto";
			}
			//guarda el resultado en el registro de presentacion que ya tenia registrado
			$objPresentacion->modificar($objPresent['id_presentacion'], $val, $riesgo);
		
		}

		function calcularValoresDimension($objPresent){
			$objRespuesta=new Respuesta();
			$objDimension=new Dimension();
			$objResultadoDimension=new ResultadoDimension();
			//consulta todas las dimensiones que tiene el cuestionario
			$resultado=$objDimension->consultarCuestionario($_SESSION['infoPreguntas']['idCuestionario']);
			if (mysqli_num_rows($resultado)>0) {
				while ($objD=mysqli_fetch_assoc($resultado)) {
					//suma todas las respuestas de las preguntas de la dimension
					$res=$objDimension->sumaRespuestaDimension($objD['id_dimension'],$objPresent['id_presentacion']);
					if (mysqli_num_rows($res)>0) {
						$objR=mysqli_fetch_assoc($res);
						//la suma la divide por el valor que ya tiene definido la dimension
						$v=round((($objR['suma']/$objD['valor_dimension'])*100),1);
						//calcula el nivel de riesgo segun el resultado de la opracion anterior
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
						//print_r($objD['descripcion_dimension']."    ".$v."    ".$riesgo);
						//registra los valores en la tabla resultado_dimension
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
			$resultado=$objDominio->consultarPorCuestionario($_SESSION['infoPreguntas']['idCuestionario']);
			if (mysqli_num_rows($resultado)>0) {
				while ($objDom=mysqli_fetch_assoc($resultado)) {
					//suma las respuestas de las preguntas que pertenecen al dominio
					$res=$objDominio->sumaResultadoDimension($objDom['id_dominio'], $objPresent['id_presentacion']);
					$objRDom=mysqli_fetch_assoc($res);
					//la suma la divide por el valor que tiene definido cada dominio
					$v=round((($objRDom['suma']/$objDom['valor_dominio'])*100),1);
					//calcula el nivel de riesgo segun el resultado anterior
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
					//print_r($objDom['descripcion_dominio']."    ".$v."    ".$riesgo);
					//registra la información en la tabla resultado_dominio
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
			//consulta toda la informacion del cuestionario
			$objC=mysqli_fetch_assoc($objCuestionario->consultarId($_SESSION['infoPreguntas']['idCuestionario']));
			//la suma la divide segun el valor del cuestionario que ya esta definido
			$v=round((($val['suma']/$objC['valor_cuestionario'])*100),1);
			//define el nivel del riesgo segun el resultado anterior
			if ($v<=$objC['limite_sin_riesgo_cuestionario']) {
				$riesgo="Sin riesgo";
			}else if ($v<=$objC['limite_riesgo_bajo_cuestionario']) {
				$riesgo="Riesgo bajo";
			}else if($v<=$objC['limite_riesgo_medio_cuestionario']){
				$riesgo="Riesgo medio";
			}else{
				$riesgo="Riesgo muy alto";
			}
			//guarda la informacion anterior en el registro que ya existe de la presentacion del cuestionario por el usuario
			$objPresentacion->modificar($objPresent['id_presentacion'], $v, $riesgo);
		}


?>