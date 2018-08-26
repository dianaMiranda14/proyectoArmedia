<?php
	class Dominio{
		private $id_dominio;
		private $descripcion_dominio;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}

?>