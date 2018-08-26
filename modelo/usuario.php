<?php
	class Usuario{
		private $cedula_usuario;
		private $id_empresa_usuario;
		private $nombre_usuario;
		private $sexo_usuario;
		private $estado_civil_usuario;
		private $fecha_nacimiento_usuario;
		private $personas_depende_usuario;
		private $departamento_residencia_usuario;
		private $ciudad_residencia_usuario;
		private $estrato_usuario;
		private $tipo_vivienda_usuario;
		private $nivel_estudio_usuario;
		private $profesion_usuario;
		private $departamento_trabajo_usuario;
		private $ciudad_trabajo_usuario;
		private $years_trabajo_usuario;
		private $cargo_usuario;
		private $tipo_cargo_usuario;
		private $years_cargo_usuario;
		private $departamento_laboral_usuario;
		private $tipo_contrato_usuario;
		private $horas_dia_trabajo_usuario;
		private $tipo_salario_usuario;
		private $tipo_usuario;
		private $estado_usuario;

		public function get($campo){
			return $this->$campo;
		}

		public function set($campo,$valor){
			$this->$campo=$valor;
		}

	}

?>