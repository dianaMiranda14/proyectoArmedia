<?php
	include_once("conexion.php");
	include_once("resultadoDimension.php");
	class Dimension{
		private $objConexion;
		private $objResultadoDimension;

		public function __construct(){
			$this->objConexion=new Conexion();
			$this->objResultadoDimension=new ResultadoDimension();
		}

		public function listar(){
			$consulta="select dimension.* from dimension where dimension.id_dominio_dimension != 11 and dimension.id_dominio_dimension != 12
				group by dimension.descripcion_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarId($id){
			$consulta="select * from dimension where id_dimension = ".$id;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarCuestionario($id){
			$consulta="select dimension.* from dimension, dominio, cuestionario where id_cuestionario = ".$id." and id_cuestionario_dominio = id_cuestionario and id_dominio = id_dominio_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function mostrarOption(){
			$resultado=$this->listar();
			if (mysqli_num_rows($resultado)>0) {
				$option="";
				while ($obj=mysqli_fetch_assoc($resultado)) {
					$option.= '<option value="'.$obj['id_dimension'].'">'.$obj['descripcion_dimension'].'</option>';
				}
				return utf8_encode($option);
			}
		}

		public function sumaRespuestaDimension($idDimension, $idPresentacion){
			$consulta="select sum(descripcion_respuesta) as 'suma' from respuesta, dimension, pregunta, presentacion where 
				id_dimension = ".$idDimension." and id_dimension = id_dimension_pregunta and
				id_pregunta = id_pregunta_respuesta and id_presentacion = id_presentacion_respuesta and 
				id_presentacion = ".$idPresentacion;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function promedioRespuestaDimension($idDimension, $idPresentacion){
			$consulta="select avg(descripcion_respuesta) as 'promedio' from respuesta, dimension, pregunta, presentacion where 
				id_dimension = ".$idDimension." and id_dimension = id_dimension_pregunta and
				id_pregunta = id_pregunta_respuesta and id_presentacion = id_presentacion_respuesta and 
				id_presentacion = ".$idPresentacion;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function mostrarContenido($id){
			$resultado=$this->consultarCuestionario($id);
			if (mysqli_num_rows($resultado)>0) {
				$option="";
				while ($obj=mysqli_fetch_assoc($resultado)) {
					$option.= '<option >'.$obj['descripcion_dimension'].'</option>';
				}
				return utf8_encode($option);
			}
		}

		public function porcentaje($idEmpresa, $year){
			$resultado=$this->listar();
			if (mysqli_num_rows($resultado)>0) {
				echo "<table class='table'>";
				while ($objD=mysqli_fetch_assoc($resultado)) {
					//$objD['descripcion_dimension']=utf8_encode($objD['descripcion_dimension']);
					$result=$this->objResultadoDimension->consultarPorcentajeDimension($idEmpresa, $year, 
						$objD['descripcion_dimension']);
					if (mysqli_num_rows($result)>0) {
						while ($objR=mysqli_fetch_assoc($result)) {
							if ($objR["porcentaje"]>=10) {
								echo "<tr> <td>".utf8_encode($objD["descripcion_dimension"])."</td>";
								echo "<td>".$objR["porcentaje"]."</td>
								<td><input type='button' class='btn' value='+' onclick='modalPlanAccion(".json_encode($objD).",".json_encode($objR["porcentaje"]).")'></td>
								</tr>";
							}
						}
					}
				}
				echo "</table>";
			}
		}
	}

?>