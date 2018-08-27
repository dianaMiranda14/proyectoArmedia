<?php
	include_once("conexion.php");

	class Usuario{
		private $objConexion=new Conexion();

		public function registrar($cedula, $idEmpresa, $nombre, $sexo, $estadoCivil, $fechaNacimiento, $personasDepende, $departamentoResidencia, $ciudadResidencia, $estrato, $tipoVivienda, $nivelEstudio, $profesion, $departamentoTrabajo, $ciudadTrabajo, $yearsTrabajo, $cargo, $tipoCargo, $yearsCargo, $departamentoLaboral, $tipoContrato, $horasTrabajo, $tipoSalario){

			$consulta="insert into usuario values(".$cedula.",".$idEmpresa.",'".$nombre."','".$sexo."','".$estadoCivil."','".$fechaNacimiento."',".$personasDepende.",'".$departamentoResidencia."','".$ciudadResidencia."','".$estrato."','".$tipoVivienda."','".$nivelEstudio."','".$profesion."','".$departamentoTrabajo."','".$ciudadTrabajo."',".$yearsTrabajo.",'".$cargo."','".$tipoCargo."',".$yearsCargo.",'".$departamentoLaboral."','".$tipoContrato."',".$horasTrabajo.",'".$tipoSalario."','Usuario','activo')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($cedula, $idEmpresa, $nombre, $sexo, $estadoCivil, $fechaNacimiento, $personasDepende, $departamentoResidencia, $ciudadResidencia, $estrato, $tipoVivienda, $nivelEstudio, $profesion, $departamentoTrabajo, $ciudadTrabajo, $yearsTrabajo, $cargo, $tipoCargo, $yearsCargo, $departamentoLaboral, $tipoContrato, $horasTrabajo, $tipoSalario, $estado){

			$consulta="update usuario set id_empresa_usuario = ".$idEmpresa.", nombre_usuario = '".$nombre."', sexo_usuario = '".$sexo."', estado_civil_usuario = '".$estadoCivil."', fecha_nacimiento_usuario = '".$fechaNacimiento."', personas_depende_usuario = ".$personasDepende.", $departamento_residencia_usuario = '".$departamentoResidencia."', ciudad_residencia_usuario = '".$ciudadResidencia."', estrato_usuario = '".$estrato."', tipo_vivienda_usuario = '".$tipoVivienda."', nivel_estudio_usuario = '".$nivelEstudio."', profesion_usuario = '".$profesion."', departamento_trabajo_usuario = '".$departamentoTrabajo."', ciudad_trabajo_usuario = '".$ciudadTrabajo."', years_trabajo_usuario = ".$yearsTrabajo.", cargo_usuario = '".$cargo."', tipo_cargo_usuario = '".$tipoCargo."', departamento_laboral_usuario = '".$departamentoLaboral."', tipo_contrato_usuario = '".$tipoContrato."', horas_dia_trabajo_usuario = ".$horasTrabajo.", tipo_salario_usuario = '".$tipoSalario."', estado_usuario = '".$estado."' where cedula_usuario = ".$cedula;
			$this->objConexion->consultaSimple($consulta);		
		}

		public function listar(){
			$consulta="select * from usuario";
			$this->objConexion->consultaRetorno($consulta);
		}

		public function consultarCedula($cedula){
			$consulta="select * from usuario where cedula_usuario = ".$cedula;
			$this->objConexion->consultaRetorno($consulta);
		}

		public function consultarNombre($nombre){
			$consulta="select * from usuario where nombre_usuario like '".$cedula."%'";
			$this->objConexion->consultaRetorno($consulta);
		}

		public function consultaEmpresa($idEmpresa){
			$consulta="select * from usuario where id_empresa_usuario = ".$idEmpresa;
			$this->objConexion->consultaRetorno($consulta);
		}

	}

?>