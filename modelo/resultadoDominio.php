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

		public function consultarResultadoDominio($idCuestionario, $year, $idCedula){
			$consulta='select id_dominio, descripcion_dominio, valor_resultado_dominio, descripcion_resultado_dominio
				from dominio, resultado_dominio, presentacion, usuario, cuestionario where
				dominio.id_dominio = resultado_dominio.id_dominio_resultado_dominio and 
				presentacion.id_presentacion = resultado_dominio.id_presentacion_resultado_dominio and 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				cuestionario.id_cuestionario = presentacion.id_cuestionario_presentacion and 
				cuestionario.id_cuestionario = '.$idCuestionario.' and
				year(presentacion.fecha_presentacion) = '.$year.' and
				usuario.cedula_usuario = '.$idCedula;
				return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>