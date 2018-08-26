<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/plan_accion.php");

	class PlanAccionControlador{
		private $objPlanAccion;
		private $objConexion;

		public function __construct(){
			$this->objPlanAccion= new PlanAccion();
			$this->objConexion=new Conexion();
		}

		public function registrar($idDimension, $descripcion){
			$consulta="insert into plan_accion (id_dimension_plan_accion, descripcion_plan_accion, estado_plan_accion) values (".$idDimension.", '".$descripcion."', 'activo')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($id, $idDimension, $descripcion, $estado){
			$consulta="update plan_accion set id_dimension_plan_accion = ".$idDimension.", descripcion_plan_accion = '".$descripcion."', estado_plan_accion = '".$estado."' where id_plan_accion = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function eliminar($id){
			$consulta="delete from plan_accion where id_plan_accion = ".$id;
			$this->objConexion->consultaSimple($consulta);
		}

		public function listar(){
			$consulta="select * from plan_accion";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarDescripcion($descripcion){
			$consulta="select * from plan_accion where descripcion_plan_accion like '".$descripcion."'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarDimension($idDimension){
			$consulta="select * from plan_accion id_dimension_plan_accion = ".$idDimension;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarEstado($estado){
			$consulta="select * from plan_accion estado_plan_accion like '".$estado."'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		
	}
?>