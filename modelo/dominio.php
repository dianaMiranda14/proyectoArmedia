<?php
	class Dominio{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function listar(){
			$consulta="select * from dominio";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>