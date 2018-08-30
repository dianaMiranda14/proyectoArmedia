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

		public function mostrarOption(){
			$resultado=$this->listar();
			if (mysqli_num_rows($resultado)>0) {
				while ($obj=mysqli_fetch_assoc($resultado)) {
					echo '<option value="'.$obj['id_cuestionario'].'">'.$obj['nombre_cuestionario'].'</option>';
				}
			}
		}

		public function consultarId($id){
			$consulta="select * from cuestionario where id_cuestionario = ".$id;
			return $this->objConexion->consultaRetorno($consulta);
		}
	}

?>