<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/Cuestionario.php");

	class cuestionarioControlador{

		private $objCuestionario;
		private $objConexion;

		public function __construct(){
			$this->objCuestionario=new Cuestionario();
			$this->objConexion=new Conexion();
		}

		public function listar(){
			$consulta="select * from cuestionario";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}
	
?>