<?php
	include_once("conexion.php");
	class Dimension{
		private $objConexion=new Conexion();

		public function listar(){
			$consulta="select * from dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarId($id){
			$consulta="select * from dimension where id_dimension = ".$id;
			return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>