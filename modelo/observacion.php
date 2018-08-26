<?php
	include_once("conexion.php");

	class Observacion{
		private $objConexion=new Conexion();

		public function registrar($idCuestionario, $tipo, $contenido, $descripcion){
			$consulta="insert into observacion (id_cuestionario_observacion, tipo_observacion, contenido_observacion, descripcion_observacion, estado_observacion) values (".$idCuestionario.", '".$tipo."','".$contenido."','".$descripcion."','activo')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($id, $idCuestionario, $tipo, $contenido, $descripcion, $estado){
			$consulta="update observacion set id_cuestionario_observacion = ".$idCuestionario.", tipo_observacion = '".$tipo."', contenido_observacion = '".$contenido."', descripcion_observacion = '".$descripcion."', estado_observacion = '".$estado."' where id_observacion = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function eliminar($id){
			$consulta="delete from observacion where id_observacion = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function listar(){
			$consulta="select * from observacion";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarId($idCuestionario){
			$consulta="select * from observacion where id_cuestionario_observacion = ".$idCuestionario;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarDescripcion($descripcion){
			$consulta="select * from observacion where descripcion_observacion like '".$descripcion."%'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarTipo($tipo){
			$consulta="select * from observacion where tipo_observacion like '".$tipo."'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarContenido($contenido){
			$consulta="select * from observacion where contenido_observacion like '".$contenido."%'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarEstado($estado){
			$consulta="select * from observacion where estado_observacion like '".$estado."'";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>