<?php
	include_once("conexion.php");

	class Presentacion{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function vaciarTabla(){
			$consulta="delete from presentacion";
			$this->objConexion->consultaSimple($consulta);
		}

		//lo llamo cuando voy a exportar los datos 
		public function arrPresentacion(){
			$consulta="select * from presentacion";
			$resultado=$this->objConexion->consultaRetorno($consulta);
			if (mysqli_num_rows($resultado)>0) {
				$i=0;
				while ($obj = mysqli_fetch_assoc($resultado)) {
					//guarda toda la informacion de la presentacion en una posicion del array
					$arrPresentacion[$i]= array('id_cuestionario_presentacion' => $obj['id_cuestionario_presentacion'], 'id_usuario_presentacion'=>$obj['id_usuario_presentacion'],'fecha_presentacion'=>$obj['fecha_presentacion'],
						'resultado_presentacion'=>$obj["resultado_presentacion"], "descripcion_presentacion"=>$obj["descripcion_presentacion"]);
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

		public function consultarResultadoPresentacion($idCuestionario, $cedula, $year){
			$consulta="select resultado_presentacion, descripcion_presentacion from 
			presentacion where 
			presentacion.id_cuestionario_presentacion = ".$idCuestionario." and 
			presentacion.id_usuario_presentacion = ".$cedula." and 
			year(presentacion.fecha_presentacion) = ".$year;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarUsuarios($idEmpresa, $year){
			$consulta="select cedula_usuario, nombre_usuario, cargo_usuario, id_cuestionario
				from usuario, presentacion, cuestionario, empresa where 
				presentacion.id_cuestionario_presentacion = cuestionario.id_cuestionario and 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				usuario.id_empresa_usuario = empresa.nit_empresa and 
				empresa.nit_empresa = ".$idEmpresa." and 
				year(presentacion.fecha_presentacion) = ".$year;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function modificar($id, $result, $riesgo){
			$consulta="update presentacion set resultado_presentacion = ".$result.", descripcion_presentacion = '".$riesgo."' where id_presentacion = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function usuariosRiesgoEstres($idEmpresa, $year){
			$consulta="select cedula_usuario, nombre_usuario, cargo_usuario, 
				resultado_presentacion, descripcion_presentacion
				from usuario, presentacion, cuestionario, empresa where 
				presentacion.id_cuestionario_presentacion = cuestionario.id_cuestionario and 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				usuario.id_empresa_usuario = empresa.nit_empresa and 
				empresa.nit_empresa = ".$idEmpresa." and 
				year(presentacion.fecha_presentacion) = ".$year." and 
				presentacion.resultado_presentacion >= 30 and 
				(cuestionario.id_cuestionario=5 or cuestionario.id_cuestionario = 6)";
			return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>