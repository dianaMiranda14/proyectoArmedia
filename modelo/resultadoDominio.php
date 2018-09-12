<?php
	include_once("conexion.php");

	class ResultadoDominio{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function registrar($idPresentacion, $idDimension, $valor, $descripcion){
			$consulta="insert into resultado_dominio values(".$idPresentacion.", ".$idDimension.", ".$valor.", '".$descripcion."')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function consultarPresentacion($idPresentacion){
			$consulta="select resultado_dominio.* from presentacion, resultado_dominio where 
				resultado_dominio.id_presentacion_resultado_dominio = presentacion.id_presentacion and 
				presentacion.id_presentacion = ".$idPresentacion;
				return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>