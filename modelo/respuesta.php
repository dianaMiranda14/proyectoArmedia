<?php
	class Respuesta{
		private $id_respuesta;
		private $id_presentacion_respuesta;
		private $id_pregunta_respuesta;
		private $descripcion_respuesta;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}
?>