<?php
	include_once("usuario.php");
	include_once("empresa.php");
	include_once("presentacion.php");
	include_once("respuesta.php");
	$objUsuario=new Usuario();
	$objEmpresa=new Empresa();
	$objPresentacion=new Presentacion();
	$objRespuesta=new Respuesta();
	print_r($_POST);

	switch ($_POST['accion']) {
		case 'descargarUsuarios':
			if ($_POST['comboEmpresa']=="") {
				echo "El nit de la empresa esta vacio";
			}else{
					//une toda la informacion en un solo array
					$arrayData = array('empresa'=>$objEmpresa->arrEmpresa($_POST['comboEmpresa']),'usuarios'=>$objUsuario->arrUsuarios($_POST['comboEmpresa'])); 
					//convierte el array en un json
					$json =json_encode($arrayData);
					//print_r($json);
					//crea el archivo
					$file=fopen("datos.json", "w");
					if ($file) {
						//agrega la informacion del json
						fwrite($file, $json);
						fclose($file);
						echo "0";
					}
			}
			break;

		case 'importarUsuarios':
			$contenido=file_get_contents($_POST['archivoImportar']);
			print_r($contenido);
			$jsonContenido=json_decode($contenido,true);
			if ($jsonContenido!=="") {
				if (count($jsonContenido['empresa'])!==0) {
					if (count($jsonContenido['usuarios'])!==0) {
						$objRespuesta->vaciarTabla();
						$objPresentacion->vaciarTabla();
						$objEmpresa->vaciarTabla();
						$objEmpresa->registrar($jsonContenido['empresa'][0]['nit_empresa'],$jsonContenido['empresa'][0]['nombre_empresa'],$jsonContenido['empresa'][0]['ciudad_empresa'],$jsonContenido['empresa'][0]['direccion_empresa'],$jsonContenido['empresa'][0]['telefono_empresa'],$jsonContenido['empresa'][0]['contacto_empresa']);
						$objUsuario->vaciarTabla();
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
				$arrayData= array('empresa' => $objEmpresa->arrEmpresa(0), 'usuarios'=>$objUsuario->arrUsuarios(0), 'presentacion'=>$objPresentacion->arrPresentacion(), 'respuesta'=>$objRespuesta->arrRespuesta());
				//convierte el array en un json
					$json =json_encode($arrayData);
					//print_r($json);
					//crea el archivo
					$file=fopen("datosCuestionarios.json", "w");
					if ($file) {
						//agrega la informacion del json
						fwrite($file, $json);
						fclose($file);
						echo "0";
					}
				break;

			case 'importarInfo':
				$contenido=file_get_contents($_POST['archivoInfo']);
				//print_r($contenido);
				$jsonContenido=json_decode($contenido,true);
				if ($jsonContenido!=="") {
					if (count($jsonContenido['empresa'])!==0 && count($jsonContenido['usuarios'])!==0 && count($jsonContenido['presentacion'])!==0 && count($jsonContenido['respuesta'])!==0) {
						$objEmpresa->remplazar($jsonContenido['empresa'][0]['nit_empresa'], $jsonContenido['empresa'][0]['nombre_empresa'],$jsonContenido['empresa'][0]['ciudad_empresa'],$jsonContenido['empresa'][0]['direccion_empresa'],$jsonContenido['empresa'][0]['telefono_empresa'],$jsonContenido['empresa'][0]['contacto_empresa']);
						for ($i=0; $i < count($jsonContenido['usuarios']) ; $i++) { 
							$objUsuario->remplazar($jsonContenido['usuarios'][$i]['cedula_usuario'],
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
						for ($i=0; $i < count($jsonContenido['presentacion']) ; $i++) { 
							$objPresentacion->registrar($jsonContenido['presentacion'][$i]['id_cuestionario_presentacion'],$jsonContenido['presentacion'][$i]['id_usuario_presentacion'],$jsonContenido['presentacion'][$i]['fecha_presentacion']);
						}
						for ($i=0; $i < count($jsonContenido['respuesta']) ; $i++) { 
							$objRespuesta->registrar($jsonContenido['respuesta'][$i]['id_presentacion_respuesta'],$jsonContenido['respuesta'][$i]['id_pregunta_respuesta'],$jsonContenido['respuesta'][$i]['descripcion_respuesta']);
						}
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