<?php
	include_once("conexion.php");

	class Cuestionario{
		private $objConexion=new Conexion();

		public function listar(){
			$consulta="select * from cuestionario";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>