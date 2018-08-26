<?php
	class Dimension{
		private $id_dimension;
		private $descripcion_dimension;
		private $id_dominio_dimension;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}

?>