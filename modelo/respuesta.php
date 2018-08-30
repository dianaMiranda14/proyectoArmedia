<?php
	include_once("conexion.php");

	class Respuesta{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}
	}
?>