<?php
	include_once("conexion.php");

	class Respuesta{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function listar(){
			$consulta="select * from respuesta";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function vaciarTabla(){
			$consulta="delete from respuesta";
			$this->objConexion->consultaSimple($consulta);
		}

		public function registrar($idPresentacion, $idPregunta, $descripcion){
			$consulta="insert into respuesta (id_presentacion_respuesta, id_pregunta_respuesta, descripcion_respuesta) values (".$idPresentacion.",".$idPregunta.",'".$descripcion."')";
			$this->objConexion->consultaSimple($consulta);
			
		}
	}
?>