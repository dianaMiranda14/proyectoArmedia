<?php
	include_once("../modelo/usuario.php");
	include_once("../modelo/resultadoDimension.php");
	include_once("../modelo/resultadoDominio.php");
	include_once("../modelo/presentacion.php");
	include_once("../modelo/empresa.php");
	include_once("../modelo/cuestionario.php");
	include_once("../modelo/observacion.php");
	include_once("../vendor/autoload.php");
	use Dompdf\Dompdf;

	//print_r($_POST);
	$objUsuario=new Usuario();
	$objEmpresa=new Empresa();
	$objPresentacion=new Presentacion();
	$nombreEmpresa=mysqli_fetch_assoc($objEmpresa->consultarNit($_POST['comboEmpresa']))['nombre_empresa'];
	session_start();
	//unset($_SESSION["arrayObservaciones"]);
	$html='<!DOCTYPE html>
				<html>
				<head>
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
				</head>
				<body>
				
				<table class="table">';
	$nombrePDF="";
	switch ($_POST['comboTipoInforme']) {
		case '0':
				$html.=mostrarIntralaboral($_POST['txtCedula'],$_POST['comboYear']);
				$html.=mostrarExtralaboral($_POST['txtCedula'],$_POST['comboYear']);
				$html.=mostrarEstres($_POST['txtCedula'],$_POST['comboYear']);
				$nombrePDF="InformeIndividual-Empleado:".$_POST['txtCedula'].'-'.$_POST['comboYear'];
			break;
		
		case '1':
			$resultadoEmpresa=$objEmpresa->consultarUsuarios($_POST['comboEmpresa']);
			if (mysqli_num_rows($resultadoEmpresa)>0) {
				while ($objU=mysqli_fetch_assoc($resultadoEmpresa)) {
					$html.=mostrarIntralaboral($objU['cedula_usuario'],$_POST['comboYear']);

				}
			}
			$nombrePDF="InformeIntralaboral-Empresa:".$nombreEmpresa.'-'.$_POST['comboYear'];
			break;

		case '2':
			$resultadoEmpresa=$objEmpresa->consultarUsuarios($_POST['comboEmpresa']);
			if (mysqli_num_rows($resultadoEmpresa)>0) {
				while ($objU=mysqli_fetch_assoc($resultadoEmpresa)) {
					$html.=mostrarExtralaboral($objU['cedula_usuario'],$_POST['comboYear']);

				}
			}
			$nombrePDF="InformeExtralaboral-Empresa:".$nombreEmpresa.'-'.$_POST['comboYear'];
			break;

		case '3':
			$resultadoEmpresa=$objEmpresa->consultarUsuarios($_POST['comboEmpresa']);
			if (mysqli_num_rows($resultadoEmpresa)>0) {
				while ($objU=mysqli_fetch_assoc($resultadoEmpresa)) {
					$html.=mostrarEstres($objU['cedula_usuario'],$_POST['comboYear']);

				}
			}
			$nombrePDF="InformeEstres-Empresa:".$nombreEmpresa.'-'.$_POST['comboYear'];
			break;

		case '4':
			$resultadoEncuestados=$objPresentacion->consultarUsuarios($_POST['comboEmpresa'], $_POST['comboYear']);
			if (mysqli_num_rows($resultadoEncuestados)>0) {
				$html.="<tr>
					<th>Número de indentificación</th>
					<th>Nombre</th>
					<th>Cargo</th>
					<th>Intralaboral </th>
					<th>Estralaboral</th>
					<th>Éstres</th>
				</tr>";
				$arrayUsuarios="";
				$contador=0;
				while ($objE=mysqli_fetch_assoc($resultadoEncuestados)) {
					$arrayUsuarios[$contador]=$objE;
					$contador++;
				}
				$aux=0;
				for ($i=0; $i < $contador; $i++) { 
					if ($arrayUsuarios[$i]['cedula_usuario']!=$aux) {
						$aux=$arrayUsuarios[$i]['cedula_usuario'];
						$html.='</tr>
							<tr>
							<td>'.$arrayUsuarios[$i]['cedula_usuario'].'</td>
							<td>'.$arrayUsuarios[$i]['nombre_usuario'].'</td>
							<td>'.$arrayUsuarios[$i]['cargo_usuario'].'</td>
							<td>'.$arrayUsuarios[$i]['id_cuestionario'].'</td>
						';
					}else{
						$html.='<td>'.$arrayUsuarios[$i]['id_cuestionario'].'</td> ';
						
					}
				}
			}
			$nombrePDF="InformeParticipacion-Empresa:".$nombreEmpresa.'-'.$_POST['comboYear'];
			break;

		case '5':
			$resultadoRiesgo=$objPresentacion->usuariosRiesgoEstres($_POST['comboEmpresa'], $_POST['comboYear']);
			if (mysqli_num_rows($resultadoRiesgo)>0) {
				$html.="<tr>
					<th>Número de indentificación</th>
					<th>Nombre</th>
					<th>Cargo</th>
					<th>Puntaje </th>
					<th>Nivel de riesgo</th>
				</tr>";
				while ($objR=mysqli_fetch_assoc($resultadoRiesgo)) {
					$html.='<tr>
						<td>'.$objR['cedula_usuario'].'</td>
						<td>'.$objR['nombre_usuario'].'</td>
						<td>'.$objR['cargo_usuario'].'</td>
						<td>'.$objR['resultado_presentacion'].'</td>
						<td>'.$objR['descripcion_presentacion'].'</td>
					</tr>';
				}
			}
			$nombrePDF="InformeEmpleadosRiesgo-Empresa:".$nombreEmpresa.'-'.$_POST['comboYear'];
			break;

		case '6':
			# code...
			break;

	}
	$html."
	</table>
	</body>
	</html>";
	echo $html;
	//descargarPDF($html, $nombrePDF);

	function consultarCuestionarios($id){
		$objCuestionario=new Cuestionario();
		$resultado=$objCuestionario->listar();
		if (mysqli_num_rows($resultado)>0) {
			$arrCuestionario="";
			$contador=0;
			while ($objC=mysqli_fetch_assoc($resultado)) {
				$arrCuestionario[$contador]=$objC;
			}
			for ($i=0; $i < $contador; $i++) { 
				if ($id==$arrCuestionario[$i]['id_cuestionario']) {
					return "v";
				}
			}
		}
	}

	function sacarDatosUsuario($cedula){
		$objUsuario=new Usuario();
		$resultadoUsuario=$objUsuario->consultarCedula($cedula);
		if (mysqli_num_rows($resultadoUsuario)>0) {
			return mysqli_fetch_assoc($resultadoUsuario);
		}else{
			return null;
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
				if ($obj['descripcion_resultado_dimension']=="Riesgo alto"
					 || $obj['descripcion_resultado_dimension']=="Riesgo muy alto") {
					array_push($_SESSION['arrayObservaciones'], $obj['descripcion_dimension']);
				}
				$arrResultadoDimension[$contador]=$obj;
				$contador++;
			}
			return $arrResultadoDimension;
		}
	}

	function resultadoCuestionario($idCuestionario, $cedula){
		$objPresentacion=new Presentacion();
		$resultadoPresentacion=$objPresentacion->consultarResultadoPresentacion($idCuestionario, $cedula, $_POST['comboYear']);
		if (mysqli_num_rows($resultadoPresentacion)>0) {
			return mysqli_fetch_assoc($resultadoPresentacion);
		}
	}

	function mostrarIntralaboral($cedula, $year){
		$objUsuario=new Usuario();
		$objResultadoUsuario=sacarDatosUsuario($cedula);
		$tipo=tipoUsuario($objResultadoUsuario);
		if ($tipo==="jefe") {
			$idCuestionario=1;
		}else{
			$idCuestionario=2;
		}
		$_SESSION['arrayObservaciones']['idCuestionario']=$idCuestionario;
		$objU=$objUsuario->consultarUsuarioPresentacion($cedula, $idCuestionario, $year);
		if (mysqli_num_rows($objU)>0) {
			$html=datosUsuario(mysqli_fetch_assoc($objU));
			$html.='<tr>
				<th colspan="3">Resultados del cuestionario</th>
			</tr>';
			$resultadoDominio=resultadoDominio($idCuestionario, $cedula);
			$resultadoDimension=resultadoDimension($idCuestionario, $cedula);
			$resultadoCuestionario=resultadoCuestionario($idCuestionario, $cedula);
			for ($i=0; $i < count($resultadoDominio); $i++) { 
				$html.=mostrarContenidoDimension($resultadoDimension,$resultadoDominio[$i]['id_dominio']);
				$html.=mostrarContenidoDominio($resultadoDominio[$i]);
			}
			$html.=mostrarContenidoCuestionario($resultadoCuestionario);
			return $html.=observaciones();
		}
	}

	function mostrarExtralaboral($cedula,$year){
		$objUsuario=new Usuario();
		$objResultadoUsuario=sacarDatosUsuario($cedula);
		$tipo=tipoUsuario($objResultadoUsuario);
		if ($tipo==="jefe") {
			$idCuestionario=3;
		}else{
			$idCuestionario=4;
		}
		$_SESSION['arrayObservaciones']['idCuestionario']=$idCuestionario;
		$objU=$objUsuario->consultarUsuarioPresentacion($cedula, $idCuestionario, $year);
		if (mysqli_num_rows($objU)>0) {
			$html=datosUsuario(mysqli_fetch_assoc($objU));
			$html.='<tr>
				<th colspan="3">Resultados del cuestionario</th>
			</tr>';
			$resultadoDimension=resultadoDimension($idCuestionario, $cedula);
			$resultadoCuestionario=resultadoCuestionario($idCuestionario, $cedula);
			$html.=mostrarContenidoDimension($resultadoDimension,null);
			$html.=mostrarContenidoCuestionario($resultadoCuestionario);
			return $html.observaciones();
		}
	}

	function mostrarEstres($cedula,$year){
		$objUsuario=new Usuario();
		$objResultadoUsuario=sacarDatosUsuario($cedula);
		$tipo=tipoUsuario($objResultadoUsuario);
		if ($tipo==="jefe") {
			$idCuestionario=5;
		}else{
			$idCuestionario=6;
		}
		$_SESSION['arrayObservaciones']['idCuestionario']=$idCuestionario;
		$objU=$objUsuario->consultarUsuarioPresentacion($cedula, $idCuestionario, $year);
		if (mysqli_num_rows($objU)>0) {
			$html=datosUsuario(mysqli_fetch_assoc($objU));
			$html.='<tr>
				<th colspan="3">Resultados del cuestionario</th>
			</tr>';
			$resultadoCuestionario=resultadoCuestionario($idCuestionario, $cedula);
			$html.=mostrarContenidoCuestionario($resultadoCuestionario);
			return $html.observaciones();
		}

	}

	function mostrarContenidoDimension($arrayInfo,$idDominio){
		$html="";
		for ($i=0; $i < count($arrayInfo); $i++) { 
			if ($idDominio==null) {
				$html.='
					<tr>
						<td>'.$arrayInfo[$i]['descripcion_dimension'].'</td>
						<td>'.$arrayInfo[$i]['valor_resultado_dimension'].'</td>
						<td>'.$arrayInfo[$i]['descripcion_resultado_dimension'].'</td>
					</tr>
				';
			}else{
				if ($arrayInfo[$i]['id_dominio_dimension']==$idDominio) {
					$html.='
						<tr>
							<td>'.$arrayInfo[$i]['descripcion_dimension'].'</td>
							<td>'.$arrayInfo[$i]['valor_resultado_dimension'].'</td>
							<td>'.$arrayInfo[$i]['descripcion_resultado_dimension'].'</td>
						</tr>
					';
				}
			}
			
		}
		return utf8_encode($html);
	}

	function mostrarContenidoDominio($objInfo){
		$html='
			<tr style="background:green">
				<td>'.$objInfo['descripcion_dominio'].'</td>
				<td>'.$objInfo['valor_resultado_dominio'].'</td>
				<td>'.$objInfo['descripcion_resultado_dominio'].'</td>
			</tr>
		';		
		return utf8_encode($html);
	}

	function mostrarContenidoCuestionario($objInfo){
		$_SESSION['arrayObservaciones']['valorCuestionario']=$objInfo['descripcion_presentacion'];
		$html='
			<tr style="background:red">
				<td>total</td>
				<td>'.$objInfo['resultado_presentacion'].'</td>
				<td>'.$objInfo['descripcion_presentacion'].'</td>
			</tr>
		';		
		return utf8_encode($html);
	}

	function datosEvaluador(){
		$objUsuario=new Usuario();
		$objE=$objUsuario->consultarEvaluador();
		if (mysqli_num_rows($objE)>0) {
			$resultadoE=mysqli_fetch_assoc($objE);
			return '
			<tr>
				<th colspan="2">Datos evaluador</th>
			</tr>

			<tr>
				<td>Nombre del evaluador</td>
				<td>'.utf8_encode($resultadoE['nombre_usuario']).'</td>
			</tr>

			<tr>
				<td>Número de identificación del evaluador</td>
				<td>'.$resultadoE['cedula_usuario'].'</td>
			</tr>

			<tr>
				<td>Profesión del evaluador</td>
				<td>'.$resultadoE['profesion_usuario'].'</td>
			</tr>

			<tr>
				<td>Postgrado del evaluador</td>
				<td>'.$resultadoE['postgrado_usuario'].'</td>
			</tr>

			<tr>
				<td>Número de la tarjeta profesional del evaluador</td>
				<td>'.$resultadoE['numero_tarjeta_profesional_usuario'].'</td>
			</tr>

			<tr>
				<td>Número de licencia en salud ocupacional del evaluador</td>
				<td>'.$resultadoE['numero_licencia_so_usuario'].'</td>
			</tr>

			<tr>
				<td>Fecha de expedición de la licencia en salud ocupacional del evaluador</td>
				<td>'.$resultadoE['fecha_expedicion_so_usuario'].'</td>
			</tr>';
		}
	}

	function datosUsuario($objU){
		$html='
			<tr>
				<th colspan="2">Datos Generales del trabajdor</th>
			</tr>

			<tr>
				<td>Nombre del trabajador</td>
				<td>'.utf8_encode($objU['nombre_usuario']).'</td>
			</tr>

			<tr>
				<td>Número  de identificación</td>
				<td>'.$objU['cedula_usuario'].'</td>
			</tr>

			<tr>
				<td>Cargo del trabajador</td>
				<td>'.utf8_encode($objU['cargo_usuario']).'</td>
			</tr>

			<tr>
				<td>Departamento o sección</td>
				<td>'.utf8_encode($objU['departamento_laboral_usuario']).'</td>
			</tr>

			<tr>
				<td>Edad del trabajador</td>
				<td>'.(date("Y")-date("Y",strtotime($objU['fecha_nacimiento_usuario']))).'</td>
			</tr>

			<tr>
				<td>Sexo del trabajador</td>
				<td>'.$objU['sexo_usuario'].'</td>
			</tr>

			<tr>
				<th colspan="2">Datos del cuestionario</th>
			</tr>

			<tr>
				<td>Nombre cuestionario</td>
				<td>'.$objU['nombre_cuestionario'].'</td>
			</tr>

			<tr>
				<td>Fecha presentacion</td>
				<td>'.$objU['fecha_presentacion'].'</td>
			</tr>

			<tr>
				<td>Nombre empresa</td>
				<td>'.utf8_encode($objU['nombre_empresa']).'</td>
			</tr>

			';
		return $html.=datosEvaluador();
		
	}

	function datosObservaciones($resultado){
			if (mysqli_num_rows($resultado)>0) {
				$html="";
				while ($obj=mysqli_fetch_assoc($resultado)) {
					$html.='<tr>
						<td colspan="3">'.' id '.$obj['id_observacion'].' descripcion '.$obj['descripcion_observacion'].'</td>
					</tr>';
				}
				return $html;
			}
	}

	function observaciones(){
		$objObservacion=new Observacion();
		$html="<tr>
			<td colspan='3'>OBSERVACIONES Y COMENTARIOS DEL EVALUADOR</td>
			<td colspan='3'>".datosObservaciones($objObservacion->consultarCuestionarioContenido($_SESSION['arrayObservaciones']['idCuestionario'], $_SESSION['arrayObservaciones']['valorCuestionario']))."</td>
		</tr>
		<tr>
			<td>RECOMENDACIONES PARTICULARES</td>
		</tr>";
		for ($i=0; $i < (count($_SESSION['arrayObservaciones'])-2); $i++) { 
			$html.=datosObservaciones($objObservacion->consultarCuestionarioContenido($_SESSION['arrayObservaciones']['idCuestionario'], $_SESSION['arrayObservaciones'][$i]));
		}
		unset($_SESSION['arrayObservaciones']);
		return $html;
	}

	function descargarPDF($html,$nombrePDF){
		$objDomPdf=new DOMPDF();
		$objDomPdf->loadHtml($html);
		$objDomPdf->setPaper('A4', 'landscape');
		$objDomPdf->render();
		$objDomPdf->stream($nombrePDF);
	}

?>