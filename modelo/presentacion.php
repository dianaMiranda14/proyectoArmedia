<?php
	include_once("conexion.php");

	class Presentacion{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}
	}

?>