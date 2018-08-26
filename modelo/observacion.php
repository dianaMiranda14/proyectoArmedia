<?php
	class Observacion{
		private $id_observacion;
		private $id_dimension_observacion;
		private $id_cuestionario_observacion;
		private $tipo_observacion;
		private $contenido_observacion;
		private $descripcion_objservacion;
		private $estado_observacion;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}

?>