<?php
	include_once("conexion.php");

	class Cuestionario{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function listar(){
			$consulta="select * from cuestionario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function mostrarOption($resultado){
			if (mysqli_num_rows($resultado)>0) {
				while ($obj=mysqli_fetch_assoc($resultado)) {
					echo utf8_encode('<option value="'.$obj['id_cuestionario'].'">'.$obj['nombre_cuestionario'].' '.$obj['tipo_usuario_cuestionario'].'</option>');
				}
			}
		}

		public function listarSinEstres(){
			$consulta="select * from cuestionario where nombre_cuestionario != 'estres'";
			return $this->objConexion->consultaRetorno($consulta);
		}


		public function consultarId($id){
			$consulta="select * from cuestionario where id_cuestionario = ".$id;
			return $this->objConexion->consultaRetorno($consulta);
		}

		/*public function consultarTipo($usuario){
			$tipo=$this->tipoUsuario($usuario);
			$consulta="select * from cuestionario where cuestionario.tipo_usuario_cuestionario like '".$tipo."'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function mostrarCuestionario($usuario,$numero){
			$resultado=$this->consultarTipo($usuario);
			if (mysqli_num_rows($resultado)>0) {
				$arrayCuestionario = array('datos' =>'datos');
				while($obj=mysqli_fetch_assoc($resultado)){
					array_push($arrayCuestionario, $obj);
				}
				return $arrayCuestionario[$numero]['id_cuestionario'];
				
			}
		}*/

		public function mostrarCuestionario($usuario,$numero){
			if ($usuario['tipo_cargo_usuario']==='Jefatura' || 
					$usuario['tipo_cargo_usuario']==='Profesional' ||
					$usuario['tipo_cargo_usuario']==='Analista' ||
					$usuario['tipo_cargo_usuario']==='Tecnico especializado') {
				switch ($numero) {
					case 0:
						return 1;
						break;
					
					case 1:
						return 3;
						break;
					case 2:
						return 5;
						break;
				}
			}else{
				switch ($numero) {
					case 0:
						return 2;
						break;
					case 1:
						return 4;
						break;
					case 2:
						return 6;
						break;
				}
			}
		}

		public function sumaResultadoCuestionario($idPresentacion){
			$consulta="select sum(respuesta.descripcion_respuesta) as 'suma' from respuesta, presentacion where
					respuesta.id_presentacion_respuesta=presentacion.id_presentacion and
					presentacion.id_presentacion = ".$idPresentacion;

			return $this->objConexion->consultaRetorno($consulta);
		}

		public function sumaResultadoCuestionarioEstres($idPresentacion){
			$consulta="select sum(resultado_dimension.valor_resultado_dimension) as 'suma' from presentacion, resultado_dimension where resultado_dimension.id_presentacion_resultado_dimension = presentacion.id_presentacion and presentacion.id_presentacion = ".$idPresentacion;
			return $this->objConexion->consultaRetorno($consulta);
		}

	}

?>