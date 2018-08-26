<?php
	class PlanAccion{
		private $id_plan_accion;
		private $id_dimension_plan_accion;
		private $descripcion_plan_accion;
		private $estado_plan_accion;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}
?>