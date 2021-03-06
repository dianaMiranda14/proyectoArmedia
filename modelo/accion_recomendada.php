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

		public function consultarDimensionEstado($idDimension){
			$consulta="select accion_recomendada.*, descripcion_dimension from accion_recomendada, dimension where id_dimension_accion_recomendada = ".$idDimension." and id_dimension_accion_recomendada = id_dimension 
				and estado_accion_recomendada like 'Activo'";
			return $this->objConexion->consultaRetorno($consulta);
		}		

		public function mostrar($resultado){
			if (mysqli_num_rows($resultado)>0) {
					while ($obj=mysqli_fetch_assoc($resultado)) {
						//convierte el texto en utf8 porque sale error cuando envia el json por parametros
						$obj['descripcion_dimension']=utf8_encode($obj['descripcion_dimension']);
						echo 
							'<tr>
								<td>'.$obj['descripcion_dimension'].'</td>
								<td>'.$obj['descripcion_accion_recomendada'].'</td>
								<td>'.$obj['estado_accion_recomendada'].'</td>
								<td> <img src="../image/exchange.png" onclick=\'modalAccion("modificar",'.json_encode($obj).')\' /></td>
								<td> <img src="../image/x.png" onclick=\'modalAccion("eliminar",'.json_encode($obj).')\' /></td>
							</tr>';
							/*<td> <input type="button" class="btn btn-primary" value="Modificar" onclick=\'modalAccion("modificar",'.json_encode($obj).')\' /></td>
								<td> <input type="button" class="btn btn-primary" value="Eliminar" onclick=\'modalAccion("eliminar",'.json_encode($obj).')\' /></td>*/
					}
					//return utf8_encode($datos);
				}else{
					echo 
						'<tr>
							<td colspan="3">No se encontraron registros</td>
						</tr>';
				}
		}

		public function mostrarOption($idDimension){
			$resultado=$this->consultarDimensionEstado($idDimension);
			if (mysqli_num_rows($resultado)>0) {
				while ($obj=mysqli_fetch_assoc($resultado)) {
					echo ' <a onclick="marcarSeleccionAccion('.$obj["id_accion_recomendada"].')" id="opcionAccion-'.$obj["id_accion_recomendada"].'" class="list-group-item ">'.$obj["descripcion_accion_recomendada"].'</a>';
				}
			}
		}
	}

?>