<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/dominio.php");

	class dominioControlador{
		private $objDominio;
		private $objConexion;

		public function __construct(){
			$this->objDominio=new Dominio();
			$this->objConexion=new Conexion();
		}

		public function listrar(){
			$consulta="select * from dominio";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}
?>