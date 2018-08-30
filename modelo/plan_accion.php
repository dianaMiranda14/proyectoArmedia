<?php
	include_once("conexion.php");

	class PlanAccion{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function registrar($idDimension, $descripcion){
			$consulta="insert into plan_accion (id_dimension_plan_accion, descripcion_plan_accion, estado_plan_accion) values (".$idDimension.", '".$descripcion."', 'Activo')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($id, $idDimension, $descripcion, $estado){
			$consulta="update plan_accion set id_dimension_plan_accion = ".$idDimension.", descripcion_plan_accion = '".$descripcion."', estado_plan_accion = '".$estado."' where id_plan_accion = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function eliminar($id){
			$consulta="delete from plan_accion where id_plan_accion = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function listar(){
			$consulta="select plan_accion.*,descripcion_dimension from plan_accion, dimension where id_dimension_plan_accion = id_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarDescripcion($descripcion){
			$consulta="select plan_accion.*,descripcion_dimension from plan_accion, dimension where descripcion_plan_accion like '".$descripcion."' and id_dimension_plan_accion = id_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarDimension($idDimension){
			$consulta="select plan_accion.*,descripcion_dimension from plan_accion, dimension where id_dimension_plan_accion = ".$idDimension." and id_dimension_plan_accion = id_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarEstado($estado){
			$consulta="select plan_accion.*,descripcion_dimension from plan_accion, dimension where estado_plan_accion like '".$estado."'  and id_dimension_plan_accion = id_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function mostrar($resultado){
			if (mysqli_num_rows($resultado)>0) {
				$datos="";
				while ($obj=mysqli_fetch_assoc($resultado)) {
					$datos.=
						'<tr>
							<td>'.$obj['descripcion_dimension'].'</td>
							<td>'.$obj['descripcion_plan_accion'].'</td>
							<td>'.$obj['estado_plan_accion'].'</td>
							<td> <input type="button" class="btn btn-primary" value="Modificar" onclick=\'modalPlan("modificar",'.json_encode($obj).')\' /></td>
								<td> <input type="button" class="btn btn-primary" value="Eliminar" onclick=\'modalPlan("eliminar",'.json_encode($obj).')\' /></td>
						</tr>';
				}
				return $datos;
			}else{
				return 
					'<tr>
						<td colspan="3">No hay registros</td>
					</tr>';
			}
		}
	}
?>