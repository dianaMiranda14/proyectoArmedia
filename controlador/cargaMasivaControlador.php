<?php
	include_once("../vendor/autoload.php");
	include_once("../modelo/usuario.php");
	include_once("../modelo/empresa.php");

	switch ($_POST["accion"]) {
		case 'descargar':
			header('Content-type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="formato carga masiva empleados.xlsx"');
			//ruta del documento 
			$ruta="../resources/formatos/formato carga masiva empleados.xlsx";
			//lee el archivo
			$objReader = PHPExcel_IOFactory::load($ruta);
			//genera uno nuevo el cual descarga
			$objWriter = PHPExcel_IOFactory::createWriter($objReader, 'Excel2007'); 
			$objWriter->save('php://output');
			break;

		case 'subir':
			$objExcel = PHPExcel_IOFactory::load($_FILES["fileCarga"]["tmp_name"]);
			$column= $objExcel->getActiveSheet()->getHighestColumn();
			$filas =$objExcel->getActiveSheet()->getHighestRow();
			$objHoja=$objExcel->getActiveSheet()->toArray(null,true,true,true);
			//print_r($objHoja);
			if (($objHoja[2]["A"]==="Nombre empresa") &&
				($objHoja[2]["B"]==="Número de identificación") &&
				($objHoja[2]["C"]==="Nombre completo") &&
				($objHoja[2]["D"]==="Cargo") &&
				($objHoja[2]["E"]==="Área a la que pertenece")) {
				if (count($objHoja)>2) {
					$objUsuario=new Usuario();
					$objEmpresa = new Empresa();
					for($i=3; $i<=$filas; $i++){
						$resultado=$objUsuario->consultarCedula($objHoja[$i]["B"]);
						if (mysqli_num_rows($resultado)===0) {
							$resultadoEmpresa=$objEmpresa->consultarNombre($objHoja[$i]["A"]);
							if (mysqli_num_rows($resultadoEmpresa)>0) {
								$objE=mysqli_fetch_assoc($resultadoEmpresa);
								$objUsuario->registrarBasico($objHoja[$i]["B"],$objE["nit_empresa"],$objHoja[$i]["C"],$objHoja[$i]["D"],$objHoja[$i]["E"]);
							}else{
								echo "
								<div class='row'>
									<div class='col-md-6 col-md-offset-5 alert alert-danger'>
										verifique el nombre de la empresa
									</div>
								</div>";
							}
							
						}
						echo "<div class='row'>
									<div class='alert alert-danger'>
										Registro exitoso 
									</div>
								</div>";
					}
				}else{
					echo "<div class='row'>
							<div class='col-md-6 col-md-offset-5 alert alert-danger'>
								El archivo está vacío
							</div>
						</div>";
				}
			}else{
				echo "<div class='row'>
						<div class='col-md-6 col-md-offset-5 alert alert-danger'>
							El archivo no es formato correcto
						</div>
					</div>";
			}
			break;
		
		default:
			# code...
			break;
	}
?>