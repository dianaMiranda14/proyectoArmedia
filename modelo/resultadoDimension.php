<?php
	include_once("conexion.php");

	class ResultadoDimension{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function registrar($idPresentacion, $idDimension, $valor, $descripcion){
			$consulta="insert into resultado_dimension values(".$idPresentacion.", ".$idDimension.", ".$valor.", '".$descripcion."')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function consultarPresentacion($idPresentacion){
			$consulta="select resultado_dimension.* from presentacion, resultado_dimension where 
				resultado_dimension.id_presentacion_resultado_dimension = presentacion.id_presentacion and 
				presentacion.id_presentacion = ".$idPresentacion;
				return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>