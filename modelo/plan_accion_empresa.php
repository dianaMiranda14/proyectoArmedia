<?php
	include_once("conexion.php");

	class PlanAccionEmpresa{
		private $objConexion;
	

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function consultarPorcentajeDimension($idEmpresa, $year, $descripcion){
			$consulta="select round(sum(resultado_dimension.valor_resultado_dimension) /
				(select sum(resultado_dimension.valor_resultado_dimension) 
				from resultado_dimension, presentacion, usuario, empresa where 
				resultado_dimension.id_presentacion_resultado_dimension = presentacion.id_presentacion and 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				usuario.id_empresa_usuario = empresa.nit_empresa and 
				empresa.nit_empresa = ".$idEmpresa." and 
				YEAR(presentacion.fecha_presentacion) = ".$year." ) * 100) as porcentaje
				from resultado_dimension, dimension, presentacion, usuario, empresa where
				resultado_dimension.id_dimension_resultado_dimension = dimension.id_dimension and 
				resultado_dimension.id_presentacion_resultado_dimension = presentacion.id_presentacion and 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				usuario.id_empresa_usuario = empresa.nit_empresa and 
				empresa.nit_empresa = ".$idEmpresa." and 
				year(presentacion.fecha_presentacion) = ".$year." and 
				dimension.descripcion_dimension like '".$descripcion."'";
				//echo $consulta."\n";
				//echo "------------------------------------------------------------------------------------------------";
				return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarPlanes($id){
			$consulta="select id_plan_accion from plan_plan_accion where id_plan_accion_empresa = ".$id;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarAcciones($id){
			$consulta="select id_accion_recomendada from plan_accion_recomendada where id_plan_accion_empresa = ".$id;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarPlanEmpresaCompleto($idEmpresa, $year, $idDimension){
			$resultado=$this->consultarPlanEmpresa($idEmpresa, $year, $idDimension);
			if (mysqli_num_rows($resultado)>0) {
				$objP=mysqli_fetch_assoc($resultado);
				$result=$this->consultarPlanes($objP["id_plan_accion_empresa"]);
				if (mysqli_num_rows($result)>0) {
					$arrPlan="";
					$cont=0;
					while ($objPlan=mysqli_fetch_assoc($result)) {
						$arrPlan[$cont]=$objPlan["id_plan_accion"];
						$cont++;
					}
				}
				$resultD=$this->consultarAcciones($objP["id_plan_accion_empresa"]);
				if (mysqli_num_rows($resultD)>0) {
					$arrAccion="";
					$cont=0;
					while ($objAccion=mysqli_fetch_assoc($resultD)) {
						$arrAccion[$cont]=$objAccion["id_accion_recomendada"];
						$cont++;
					}
				}
				$objP["idPlanes"]=$arrPlan;
				$objP["idAcciones"]=$arrAccion;
				return $objP;
			}else{
				return 0;
			}
		}

		public function consultarPlanEmpresa($idEmpresa, $year, $idDimension){
			$consulta='select plan_accion_empresa.* from plan_accion_empresa,dimension, empresa where
				plan_accion_empresa.id_dimension_plan_accion_empresa = dimension.id_dimension and 
				plan_accion_empresa.id_empresa_plan_accion_empresa = empresa.nit_empresa and 
				dimension.id_dimension = '.$idDimension.' and 
				empresa.nit_empresa = '.$idEmpresa.' and 
				plan_accion_empresa.year_plan_accion_empresa = '.$year;
				return $this->objConexion->consultaRetorno($consulta);
		}

		public function porcentaje($idEmpresa, $year,$resultado){
			if (mysqli_num_rows($resultado)>0) {
				echo "<table class='table'>";
				while ($objD=mysqli_fetch_assoc($resultado)) {
					//$objD['descripcion_dimension']=utf8_encode($objD['descripcion_dimension']);
					$result=$this->consultarPorcentajeDimension($idEmpresa, $year, $objD['descripcion_dimension']);
					if (mysqli_num_rows($result)>0) {
						while ($objR=mysqli_fetch_assoc($result)) {
							if ($objR["porcentaje"]>=10) {
								echo "<tr> <td>".utf8_encode($objD["descripcion_dimension"])."</td>";
								echo "<td>".$objR["porcentaje"]."</td>";
								$resultadoConsulta=$this->consultarPlanEmpresaCompleto($idEmpresa, $year, $objD["id_dimension"]);
								if ($resultadoConsulta!==0) {
									$objD["plan"]=$resultadoConsulta;
									$objD["accion"]="modificar";
								}else{
									$objD["idEmpresa"]=$idEmpresa;
									$objD["year"]=$year;
									$objD["porcentaje"]=$objR["porcentaje"];
									$objD["accion"]="registrar";
								}
								echo "<td><input type='button' class='btn' value='+' onclick='modalPlanAccion(".json_encode($objD).")'></td>
								</tr>";
								
							}
						}
					}
				}
				echo "</table>";
			}
		}

		public function registrarPlanes($id,$planes){
			$arrPlanes=split(",", $planes);
			for ($i=0; $i < count($arrPlanes); $i++) { 
				$consulta="insert into plan_plan_accion values (".$id.",".$arrPlanes[$i].")";
				$this->objConexion->consultaSimple($consulta);
			}
		}

		public function registrarAcciones($id,$acciones){
			$arrAcciones=split(",", $acciones);
			for ($i=0; $i < count($arrAcciones); $i++) { 
				$consulta="insert into plan_accion_recomendada values (".$id.",".$arrAcciones[$i].")";
				$this->objConexion->consultaSimple($consulta);
			}
		}

		public function registrar($idEmpresa, $idDimension, $valor, $year, $area, $responsable, $planes, $acciones){
			$consulta="insert into plan_accion_empresa (id_empresa_plan_accion_empresa, id_dimension_plan_accion_empresa, valor_dimension_plan_accion_empresa, year_plan_accion_empresa, area_plan_accion_empresa, responsable_plan_accion_empresa) values (".$idEmpresa.",".$idDimension.", '".$valor."',".$year.", '".$area."', '".$responsable."')";
			$this->objConexion->consultaSimple($consulta);
			$resultado=$this->consultarPlanEmpresa($idEmpresa, $year, $idDimension);
			if (mysqli_num_rows($resultado)>0) {
				$objPlanE=mysqli_fetch_assoc($resultado);
				$this->registrarPlanes($objPlanE['id_plan_accion_empresa'], $planes);
				$this->registrarAcciones($objPlanE['id_plan_accion_empresa'],$acciones);
			}
		}

		public function modificar($id,$area, $responsable, $planes, $acciones){
			$consulta="update plan_accion_empresa set area_plan_accion_empresa = '".$area.
			"', responsable_plan_accion_empresa = '".$responsable.
			"' where id_plan_accion_empresa = ".$id;
			$this->objConexion->consultaSimple($consulta);
			$consulta="delete from plan_accion_recomendada where id_plan_accion_empresa = ".$id;
			$this->objConexion->consultaSimple($consulta);
			$consulta="delete from plan_plan_accion where id_plan_accion_empresa = ".$id;
			$this->objConexion->consultaSimple($consulta);
			$this->registrarPlanes($id, $planes);
			$this->registrarAcciones($id,$acciones);
		}
	}
?>