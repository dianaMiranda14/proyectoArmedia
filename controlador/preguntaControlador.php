<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/pregunta.php");

	class preguntaControlador{
		private $objPregunta;
		private $objConexion;

		public function __construct(){
			$this->objPregunta=new Pregunta();
			$this->objConexion=new Conexion();
		}

		public function listar(){
			$consulta="select * from pregunta";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}
?>