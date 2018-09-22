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

		public function consultarResultadoDimension($idCuestionario, $year, $cedula){
			$consulta="select id_dominio_dimension, descripcion_dimension, valor_resultado_dimension, descripcion_resultado_dimension from 
				dimension, resultado_dimension, presentacion, cuestionario, usuario where
				dimension.id_dimension = resultado_dimension.id_dimension_resultado_dimension and 
				resultado_dimension.id_presentacion_resultado_dimension = presentacion.id_presentacion and 
				presentacion.id_cuestionario_presentacion = cuestionario.id_cuestionario and 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				YEAR(presentacion.fecha_presentacion) = ".$year." and 
				cuestionario.id_cuestionario = ".$idCuestionario." and 
				usuario.cedula_usuario = ".$cedula;
				return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarPorcentajeDimension($idEmpresa, $year, $descripcion){
			$consulta="select round(sum(resultado_dimension.valor_resultado_dimension) /
				(select sum(resultado_dimension.valor_resultado_dimension) 
				from resultado_dimension, presentacion, usuario, empresa where 
				resultado_dimension.id_presentacion_resultado_dimension = presentacion.id_presentacion and 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				usuario.id_empresa_usuario = empresa.nit_empresa and 
				empresa.nit_empresa = ".$idEmpresa." and 
				YEAR(presentacion.fecha_presentacion) = ".$year." ) * 100) as porcentaje
				from resultado_dimension, dimension, presentacion, usuario, empresa where
				resultado_dimension.id_dimension_resultado_dimension = dimension.id_dimension and 
				resultado_dimension.id_presentacion_resultado_dimension = presentacion.id_presentacion and 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				usuario.id_empresa_usuario = empresa.nit_empresa and 
				empresa.nit_empresa = ".$idEmpresa." and 
				year(presentacion.fecha_presentacion) = ".$year." and 
				dimension.descripcion_dimension like '".$descripcion."'";
				//echo $consulta."\n";
				//echo "------------------------------------------------------------------------------------------------";
				return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>