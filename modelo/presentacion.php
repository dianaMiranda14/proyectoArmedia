<?php
	include_once("conexion.php");

	class Presentacion{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function listar(){
			$consulta="select * from presentacion";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function vaciarTabla(){
			$consulta="delete from presentacion";
			$this->objConexion->consultaSimple($consulta);
		}

		public function arrPresentacion(){
			$resultado=$this->listar();
			if (mysqli_num_rows($resultado)>0) {
				$i=0;
				while ($obj = mysqli_fetch_assoc($resultado)) {
					//guarda toda la informacion de la presentacion en una posicion del array
					$arrPresentacion[$i]= array('id_cuestionario_presentacion' => $obj['id_cuestionario_presentacion'], 'id_usuario_presentacion'=>$obj['id_usuario_presentacion'],'fecha_presentacion'=>$obj['fecha_presentacion']);
					$i++;
				}
				return $arrPresentacion;
			}
		}

		public function registrar($idCuestionario, $idUsuario, $fecha){
			$consulta="insert into presentacion (id_cuestionario_presentacion, id_usuario_presentacion, fecha_presentacion) values(".$idCuestionario.", ".$idUsuario.", '".$fecha."')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function consultarFecha($fecha, $idUsuario){
			$consulta="select presentacion.* from presentacion where fecha_presentacion like '".$fecha."' and id_usuario_presentacion = ".$idUsuario. " order by id_presentacion desc limit 1";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function modificar($id, $result, $riesgo){
			$consulta="update presentacion set resultado_presentacion = ".$result.", descripcion_presentacion = '".$riesgo."' where id_presentacion = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}
	}

?>