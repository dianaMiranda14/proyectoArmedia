<?php
	class Cuestionario{
		private $id_cuestionario;
		private $nombre_cuestionario;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}

?>