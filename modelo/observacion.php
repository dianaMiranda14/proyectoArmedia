<?php
	include_once("conexion.php");

	class Observacion{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function registrar($idCuestionario, $tipo, $contenido, $descripcion){
			$consulta="insert into observacion (id_cuestionario_observacion, tipo_observacion, contenido_observacion, descripcion_observacion, estado_observacion) values (".$idCuestionario.", '".$tipo."','".$contenido."','".$descripcion."','Activo')";
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
			$consulta="select observacion.*, nombre_cuestionario from observacion, cuestionario where id_cuestionario_observacion = id_cuestionario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarCuestionario($idCuestionario){
			$consulta="select observacion.*, nombre_cuestionario from observacion, cuestionario where id_cuestionario_observacion = ".$idCuestionario." and id_cuestionario_observacion = id_cuestionario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarDescripcion($descripcion){
			$consulta="select observacion.*, nombre_cuestionario from observacion, cuestionario where descripcion_observacion like '%".$descripcion."%' and id_cuestionario_observacion = id_cuestionario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarTipo($tipo){
			$consulta="select observacion.*, nombre_cuestionario from observacion, cuestionario where tipo_observacion like '".$tipo."' and id_cuestionario_observacion = id_cuestionario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarContenido($contenido){
			$consulta="select observacion.*, nombre_cuestionario from observacion, cuestionario where contenido_observacion like '".$contenido."%' and id_cuestionario_observacion = id_cuestionario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarEstado($estado){
			$consulta="select observacion.*, nombre_cuestionario from observacion, cuestionario where estado_observacion like '".$estado."' and id_cuestionario_observacion = id_cuestionario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function mostrar($resultado){
			if (mysqli_num_rows($resultado)>0) {
				$datos="";
				while ($obj=mysqli_fetch_assoc($resultado)) {
					$datos.=
						'<tr>
							<td>'.$obj['nombre_cuestionario'].'</td>
							<td>'.$obj['tipo_observacion'].'</td>
							<td>'.$obj['contenido_observacion'].'</td>
							<td>'.$obj['descripcion_observacion'].'</td>
							<td>'.$obj['estado_observacion'].'</td>
							<td> <input type="button" class="btn btn-primary" value="Modificar" onclick=\'modalObservacion("modificar",'.json_encode($obj).')\' /></td>
							<td> <input type="button" class="btn btn-primary" value="Eliminar" onclick=\'modalObservacion("eliminar",'.json_encode($obj).')\' /></td>
						</tr>';
				}
				return $datos;
			}else{
				return '<tr><td colspan="6">No hay registros</td></tr>';
			}
		}
	}

?>