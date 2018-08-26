<?php
	class AccionRecomendada{
		private $id_accion_recomendada;
		private $id_dimension_accion_recomendada;
		private $descripcion_accion_recomendada;
		private $estado_accion_recomedada;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}

?>