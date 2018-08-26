<?php
	class Empresa{
		private $nit_empresa;
		private $nombre_usuario;
		private $ciudad_empresa;
		private $direccion_empresa;
		private $telefono_empresa;
		private $contacto_empresa;
		private $estado_empresa;
		private $habilitado_empresa;


		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}
	}

?>