<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/presentacion.php");

	class presentacionControlador{
		private $objPresentacion;
		private $objConexion();

		public function __construct(){
			$this->objPresentacion=new Presentacion();
			$this->objConexion=new Conexion();
		}

		
	}

?>