<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/respuesta.php");

	class respuestaControlador{
		private $objRespuesta;
		private $objConexion;

		public function __construct(){
			$this->objRespuesta=new Respuesta();
			$this->objConexion=new Conexion();
		}
	}
?>