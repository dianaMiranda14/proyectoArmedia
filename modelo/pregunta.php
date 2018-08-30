<?php
	include_once("conexion.php");

	class Pregunta{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}
		
		public function listar(){
			$consulta="select * from pregunta";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}
?>