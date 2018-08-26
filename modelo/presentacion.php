<?php
	class Presentacion{
		private $id_presentacion;
		private $id_cuestionario_presentacion;
		private $id_usuario_presentacion;
		private $fecha_presentacion;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}

?>