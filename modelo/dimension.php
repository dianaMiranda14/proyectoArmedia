<?php
	include_once("conexion.php");
	class Dimension{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function listar(){
			$consulta="select * from dimension";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarId($id){
			$consulta="select * from dimension where id_dimension = ".$id;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function mostrarOption(){
			$resultado=$this->listar();
			if (mysqli_num_rows($resultado)>0) {
				$option="";
				while ($obj=mysqli_fetch_assoc($resultado)) {
					$option.= '<option value="'.$obj['id_dimension'].'">'.$obj['descripcion_dimension'].'</option>';
				}
				return $option;
			}
		}

		public function mostrarContenido(){
			$resultado=$this->listar();
			if (mysqli_num_rows($resultado)>0) {
				$option="";
				while ($obj=mysqli_fetch_assoc($resultado)) {
					$option.= '<option >'.$obj['descripcion_dimension'].'</option>';
				}
				return $option;
			}
		}
	}

?>