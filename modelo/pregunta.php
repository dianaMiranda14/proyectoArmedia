<?php
	function Pregunta{
		private $id_pregunta;
		private $id_cuestionario_pregunta;
		private $id_dimension_pregunta;
		private $descripcion_pregunta;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}
?>