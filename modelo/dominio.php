<?php
	class Dominio{
		private $objConexion = new Conexion();

		public function listar(){
			$consulta="select * from dominio";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>