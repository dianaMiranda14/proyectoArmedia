<?php
	include_once("conexion.php");
	class AccionRecomendada{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function registrar($idDimension, $descripcion){
			$consulta="insert into accion_recomendada (id_dimension_accion_recomendada, descripcion_accion_recomendada, estado_accion_recomendada) values (".$idDimension.",'".$descripcion."','Activo')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($id, $idDimension, $descripcion, $estado){
			$consulta="update accion_recomendada set id_dimension_accion_recomendada = ".$idDimension.", descripcion_accion_recomendada = '".$descripcion."', estado_accion_recomendada = '".$estado."' where id_accion_recomendada = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function eliminar($id){
			$consulta="delete from accion_recomendada where id_accion_recomendada = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function listar(){
			$consulta="select accion_recomendada.*, descripcion_dimension from accion_recomendada, dimension where id_dimension_accion_recomendada = id_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarEstado($estado){
			$consulta="select accion_recomendada.*, descripcion_dimension from accion_recomendada, dimension where estado_accion_recomendada like '".$estado."' and id_dimension_accion_recomendada = id_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarDescripcion($descripcion){
			$consulta="select accion_recomendada.*, descripcion_dimension from accion_recomendada, dimension where descripcion_accion_recomendada like '%".$descripcion."%' and id_dimension_accion_recomendada = id_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarDimension($idDimension){
			$consulta="select accion_recomendada.*, descripcion_dimension from accion_recomendada, dimension where id_dimension_accion_recomendada = ".$idDimension." and id_dimension_accion_recomendada = id_dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function mostrar($resultado){
			if (mysqli_num_rows($resultado)>0) {
					$datos="";
					while ($obj=mysqli_fetch_assoc($resultado)) {
						$datos.=
							'<tr>
								<td>'.$obj['descripcion_dimension'].'</td>
								<td>'.$obj['descripcion_accion_recomendada'].'</td>
								<td>'.$obj['estado_accion_recomendada'].'</td>
								<td> <input type="button" class="btn btn-primary" value="Modificar" onclick=\'modalAccion("modificar",'.json_encode($obj).')\' /></td>
								<td> <input type="button" class="btn btn-primary" value="Eliminar" onclick=\'modalAccion("eliminar",'.json_encode($obj).')\' /></td>
							</tr>';
					}
					return $datos;
				}else{
					return 
						'<tr>
							<td colspan="3">No se encontraron registros</td>
						</tr>';
				}
		}
	}

?>