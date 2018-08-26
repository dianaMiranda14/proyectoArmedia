<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/Dimension.php");

	class dimensionControlador{
		private $objDimension;
		private $objConexion;

		public function __construct(){
			$this->objDimension=new Dimension();
			$this->objConexion=new Conexion();
		}

		public function listar(){
			$consulta="select * from dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}
?>