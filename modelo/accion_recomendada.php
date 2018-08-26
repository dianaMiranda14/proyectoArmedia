<?php
	class AccionRecomendada{
		public function registrar($idDimension, $descripcion){
			$consulta="insert into accion_recomendada (id_dimension_accion_recomendada, descripcion_accion_recomendada, estado_accion_recomedada) values (".$idDimension.",'".$descripcion."','activo')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($id, $idDimension, $descripcion, $estado){
			$consulta="update accion_recomendada set id_dimension_accion_recomendada = ".$idDimension.", descripcion_accion_recomendada = '".$descripcion."', estado_accion_recomedada = '".$estado."' where id_accion_recomendada = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function eliminar($id){
			$consulta="delete from accion_recomendada where id_accion_recomendada = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function listar(){
			$consulta="select * from accion_recomendada";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarEstado($estado){
			$consulta="select * from accion_recomendada where estado_accion_recomedada like '".$estado."'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarDescripcion($descripcion){
			$consulta="select * from accion_recomendada where descripcion_accion_recomendada like '".$descripcion."'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarDimension($idDimension){
			$consulta="select * from accion_recomendada where id_dimension_accion_recomendada = ".$idDimension;
			return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>