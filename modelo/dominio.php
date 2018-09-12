<?php
	class Dominio{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function listar(){
			$consulta="select * from dominio";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarPorCuestionario($id){
			$consulta="select dominio.* from dominio where id_cuestionario_dominio = ".$id;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function sumaResultadoDimension($idDominio, $idPresentacion){
			$consulta="select sum(respuesta.descripcion_respuesta) as 'suma'
					from respuesta, pregunta, dominio, dimension, presentacion where
					respuesta.id_presentacion_respuesta = presentacion.id_presentacion and 
					respuesta.id_pregunta_respuesta = pregunta.id_pregunta and 
					pregunta.id_dimension_pregunta = dimension.id_dimension and 
					dimension.id_dominio_dimension = dominio.id_dominio and 
					dominio.id_dominio = ".$idDominio." and 
					presentacion.id_presentacion = ".$idPresentacion;
			return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>