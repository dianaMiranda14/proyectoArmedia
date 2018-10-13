<?php
	include_once("usuario.php");
	include_once("empresa.php");
	include_once("presentacion.php");
	include_once("respuesta.php");
	include_once("resultadoDimension.php");
	include_once("resultadoDominio.php");
	$objUsuario=new Usuario();
	$objEmpresa=new Empresa();
	$objPresentacion=new Presentacion();
	$objRespuesta=new Respuesta();
	$objResultadoDimension=new resultadoDimension();
	$objResultadoDominio=new ResultadoDominio();
	//print_r($_POST);
	//print_r($_FILES);
	switch ($_POST['accion']) {
		case 'descargarUsuarios':
			if ($_POST['comboEmpresa']=="") {
				echo "Debe elegir una empresa";
			}else{
					//une toda la informacion en un solo array
					$arrayData = array('empresa'=>$objEmpresa->arrEmpresa($_POST['comboEmpresa']),'usuarios'=>$objUsuario->arrUsuarios($_POST['comboEmpresa'])); 
					//$arrayData = array('empresa'=>$objEmpresa->arrEmpresa($_POST['comboEmpresa']));
					//print_r($arrayData);
					//convierte el array en un json
					$json =json_encode($arrayData,JSON_UNESCAPED_UNICODE);
					$resultadoE=$objEmpresa->consultarNit($_POST["comboEmpresa"]);
					if (mysqli_num_rows($resultadoE)>0) {
						$objE=mysqli_fetch_assoc($resultadoE);
						$nombre="listaEmpleados-".$objE["nombre_empresa"]." ".date("Y-m-d").".json";
						//crea el archivo
						header('Content-type:application/json');
						header('Content-Disposition: attachment; filename="'.$nombre.'"');
						$file=fopen("php://output", "w");
						if ($file) {
							//agrega la informacion del json
							fwrite($file, $json);
							fclose($file);
						}
					}
					
			}
			break;

		case 'importarUsuarios':
			$contenido=file_get_contents($_FILES['archivoImportar']['tmp_name']);
			//print_r($contenido);
			$jsonContenido=json_decode($contenido,true);
			//print_r($jsonContenido["usuarios"]);
			if ($jsonContenido!=="") {
				if (count($jsonContenido['empresa'])!==0) {
					if (count($jsonContenido['usuarios'])!==0) {
						//$objRespuesta->vaciarTabla();
						//$objPresentacion->vaciarTabla();
						//$objEmpresa->vaciarTabla();
						$objEmpresa->registrar($jsonContenido['empresa'][0]['nit_empresa'],$jsonContenido['empresa'][0]['nombre_empresa'],$jsonContenido['empresa'][0]['ciudad_empresa'],$jsonContenido['empresa'][0]['direccion_empresa'],$jsonContenido['empresa'][0]['telefono_empresa'],$jsonContenido['empresa'][0]['contacto_empresa']);
						//$objUsuario->vaciarTabla();
						for ($i=0; $i < count($jsonContenido['usuarios']); $i++) { 
							$objUsuario->registrar($jsonContenido['usuarios'][$i]['cedula_usuario'],
								$jsonContenido['usuarios'][$i]['id_empresa_usuario'],
								$jsonContenido['usuarios'][$i]['nombre_usuario'], 
								$jsonContenido['usuarios'][$i]['sexo_usuario'],
								$jsonContenido['usuarios'][$i]['estado_civil_usuario'],
								$jsonContenido['usuarios'][$i]['fecha_nacimiento_usuario'],
								$jsonContenido['usuarios'][$i]['personas_dependen_usuario'],
								$jsonContenido['usuarios'][$i]['departamento_residencia_usuario'],
								$jsonContenido['usuarios'][$i]['ciudad_residencia_usuario'],
								$jsonContenido['usuarios'][$i]['estrato_usuario'],
								$jsonContenido['usuarios'][$i]['tipo_vivienda_usuario'],
								$jsonContenido['usuarios'][$i]['nivel_estudio_usuario'],
								$jsonContenido['usuarios'][$i]['profesion_usuario'],
								$jsonContenido['usuarios'][$i]['departamento_trabajo_usuario'],
								$jsonContenido['usuarios'][$i]['ciudad_trabajo_usuario'],
								$jsonContenido['usuarios'][$i]['years_trabajo_usuario'],
								$jsonContenido['usuarios'][$i]['cargo_usuario'],
								$jsonContenido['usuarios'][$i]['tipo_cargo_usuario'],
								$jsonContenido['usuarios'][$i]['years_cargo_usuario'],
								$jsonContenido['usuarios'][$i]['departamento_laboral_usuario'],
								$jsonContenido['usuarios'][$i]['tipo_contrato_usuario'],
								$jsonContenido['usuarios'][$i]['horas_dia_trabajo_usuario'],
								$jsonContenido['usuarios'][$i]['tipo_salario_usuario']);
						}
						echo "Registro exitoso";
					}else{
						echo "El archivo no contiene la informacion pertinente";
					}
				}else{
					echo "El archivo no contiene la informacion pertinente";
				}
			}else{
				echo "El archivo esta vacio";
			}
			break;
		
			case 'descargarInfo':
				$arrayData= array('empresa' => $objEmpresa->arrEmpresa(0), 'usuarios'=>$objUsuario->arrUsuarios(0), 'presentacion'=>$objPresentacion->arrPresentacion());
				//print_r($arrayData);
				//print_r($arrayData);
				//convierte el array en un json
				$json =json_encode($arrayData, JSON_UNESCAPED_UNICODE);
				//print_r($arrayData);
				//$json=print_r($arrayData,true);
				//crea el archivo
				$nombre="datosCuestionario".date("Y-m-d").".json";
				header('Content-type:application/json');
				header('Content-Disposition: attachment; filename="'.$nombre.'"');
				$file=fopen("php://output", "w");
				if ($file) {
					//agrega la informacion del json
					fwrite($file, $json);
					fclose($file);
				}
				break;

			case 'importarInfo':
				$contenido=file_get_contents($_FILES['archivoInfo']['tmp_name']);
				//print_r($contenido);
				$jsonContenido=json_decode($contenido,true);
				//print_r($jsonContenido);
				if ($jsonContenido!=="") {
					if (count($jsonContenido['empresa'])!==0 && count($jsonContenido['usuarios'])!==0 && count($jsonContenido['presentacion'])!==0) {
						for ($i=0; $i < count($jsonContenido['usuarios']) ; $i++) { 
							$resultadoU=$objUsuario->consultarCedula($jsonContenido['usuarios'][$i]['cedula_usuario']);
							if (mysqli_num_rows($resultadoU)>0) {
								$accion="modificar";
							}else{
								$accion="registrar";
							}
							$objUsuario->$accion($jsonContenido['usuarios'][$i]['cedula_usuario'],
									$jsonContenido['usuarios'][$i]['cedula_usuario'],
									$jsonContenido['usuarios'][$i]['id_empresa_usuario'],
									$jsonContenido['usuarios'][$i]['nombre_usuario'], 
									$jsonContenido['usuarios'][$i]['sexo_usuario'],
									$jsonContenido['usuarios'][$i]['estado_civil_usuario'],
									$jsonContenido['usuarios'][$i]['fecha_nacimiento_usuario'],
									$jsonContenido['usuarios'][$i]['personas_dependen_usuario'],
									$jsonContenido['usuarios'][$i]['departamento_residencia_usuario'],
									$jsonContenido['usuarios'][$i]['ciudad_residencia_usuario'],
									$jsonContenido['usuarios'][$i]['estrato_usuario'],
									$jsonContenido['usuarios'][$i]['tipo_vivienda_usuario'],
									$jsonContenido['usuarios'][$i]['nivel_estudio_usuario'],
									$jsonContenido['usuarios'][$i]['profesion_usuario'],
									$jsonContenido['usuarios'][$i]['departamento_trabajo_usuario'],
									$jsonContenido['usuarios'][$i]['ciudad_trabajo_usuario'],
									$jsonContenido['usuarios'][$i]['years_trabajo_usuario'],
									$jsonContenido['usuarios'][$i]['cargo_usuario'],
									$jsonContenido['usuarios'][$i]['tipo_cargo_usuario'],
									$jsonContenido['usuarios'][$i]['years_cargo_usuario'],
									$jsonContenido['usuarios'][$i]['departamento_laboral_usuario'],
									$jsonContenido['usuarios'][$i]['tipo_contrato_usuario'],
									$jsonContenido['usuarios'][$i]['horas_dia_trabajo_usuario'],
									$jsonContenido['usuarios'][$i]['tipo_salario_usuario'],
									$jsonContenido['usuarios'][$i]['estado_usuario']);
							
						}
						//print_r($jsonContenido['presentacion'][0]);
						for ($i=0; $i < count($jsonContenido['presentacion']) ; $i++) {
							$objPresentacion->registrar($jsonContenido['presentacion'][$i]['id_cuestionario_presentacion'],$jsonContenido['presentacion'][$i]['id_usuario_presentacion'],$jsonContenido['presentacion'][$i]['fecha_presentacion'], $jsonContenido["presentacion"][$i]["resultado_presentacion"], $jsonContenido["presentacion"][$i]["descripcion_presentacion"]);
							$resultadoP=$objPresentacion->consultarFecha($jsonContenido['presentacion'][$i]['fecha_presentacion'],$jsonContenido['presentacion'][$i]['id_usuario_presentacion']);
							if (mysqli_num_rows($resultadoP)>0) {
								$objP=mysqli_fetch_assoc($resultadoP);
								if (count($jsonContenido['presentacion'][$i]['respuestas'])>0) {
									for ($j=0; $j < count($jsonContenido['presentacion'][$i]['respuestas']) ; $j++) {
									//print_r($jsonContenido['respuesta'][$i]); 
										$objRespuesta->registrar($objP["id_presentacion"],$jsonContenido['presentacion'][$i]['respuestas'][$j]['id_pregunta_respuesta'],$jsonContenido['presentacion'][$i]['respuestas'][$j]['descripcion_respuesta']);
									}
								}
								if (count($jsonContenido['presentacion'][$i]['resultadoDimension'])>0) {
									for ($j=0; $j < count($jsonContenido['presentacion'][$i]['resultadoDimension']); $j++) { 
										$objResultadoDimension->registrar($objP["id_presentacion"],$jsonContenido['presentacion'][$i]['resultadoDimension'][$j]["id_dimension_resultado_dimension"], $jsonContenido['presentacion'][$i]['resultadoDimension'][$j]["valor_resultado_dimension"], $jsonContenido['presentacion'][$i]['resultadoDimension'][$j]["descripcion_resultado_dimension"]);
									}
								}
								if (count($jsonContenido['presentacion'][$i]['resultadoDominio'])) {
									for ($j=0; $j < count($jsonContenido['presentacion'][$i]['resultadoDominio']); $j++) { 
										$objResultadoDimension->registrar($objP["id_presentacion"], $jsonContenido['presentacion'][$i]['resultadoDominio'][$j]["id_dominio_resultado_dominio"], $jsonContenido['presentacion'][$i]['resultadoDominio'][$j]["valor_resultado_dominio"], $jsonContenido['presentacion'][$i]['resultadoDominio'][$j]["descripcion_resultado_dominio"]);
									}
								}
							}
						}
						
						echo "registro exitoso";
					}else{
						echo "El archivo no tiene la informacion pertinente";
					}
				}else{
					echo "El archivo esta vacio";
				}
				break;
		default:
			# code...
			break;
	}
?>