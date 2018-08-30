<?php
	include_once("conexion.php");

	class Usuario{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function registrar($cedula, $idEmpresa, $nombre, $sexo, $estadoCivil, $fechaNacimiento, $personasDepende, $departamentoResidencia, $ciudadResidencia, $estrato, $tipoVivienda, $nivelEstudio, $profesion, $departamentoTrabajo, $ciudadTrabajo, $yearsTrabajo, $cargo, $tipoCargo, $yearsCargo, $departamentoLaboral, $tipoContrato, $horasTrabajo, $tipoSalario){

			$consulta="insert into usuario (cedula_usuario, id_empresa_usuario, nombre_usuario, sexo_usuario, estado_civil_usuario, fecha_nacimiento_usuario, personas_dependen_usuario, departamento_residencia_usuario, ciudad_residencia_usuario, estrato_usuario, tipo_vivienda_usuario, nivel_estudio_usuario, profesion_usuario, departamento_trabajo_usuario, ciudad_trabajo_usuario, years_trabajo_usuario, cargo_usuario, tipo_cargo_usuario, years_cargo_usuario, departamento_laboral_usuario, tipo_contrato_usuario, horas_dia_trabajo_usuario, tipo_salario_usuario, tipo_usuario, estado_usuario) values(".$cedula.",".$idEmpresa.",'".$nombre."','".$sexo."','".$estadoCivil."','".$fechaNacimiento."',".$personasDepende.",'".$departamentoResidencia."','".$ciudadResidencia."','".$estrato."','".$tipoVivienda."','".$nivelEstudio."','".$profesion."','".$departamentoTrabajo."','".$ciudadTrabajo."',".$yearsTrabajo.",'".$cargo."','".$tipoCargo."',".$yearsCargo.",'".$departamentoLaboral."','".$tipoContrato."',".$horasTrabajo.",'".$tipoSalario."','Usuario','Activo')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($cedula, $idEmpresa, $nombre, $sexo, $estadoCivil, $fechaNacimiento, $personasDepende, $departamentoResidencia, $ciudadResidencia, $estrato, $tipoVivienda, $nivelEstudio, $profesion, $departamentoTrabajo, $ciudadTrabajo, $yearsTrabajo, $cargo, $tipoCargo, $yearsCargo, $departamentoLaboral, $tipoContrato, $horasTrabajo, $tipoSalario, $estado){

			$consulta="update usuario set id_empresa_usuario = ".$idEmpresa.", nombre_usuario = '".$nombre."', sexo_usuario = '".$sexo."', estado_civil_usuario = '".$estadoCivil."', fecha_nacimiento_usuario = '".$fechaNacimiento."', personas_dependen_usuario = ".$personasDepende.", departamento_residencia_usuario = '".$departamentoResidencia."', ciudad_residencia_usuario = '".$ciudadResidencia."', estrato_usuario = '".$estrato."', tipo_vivienda_usuario = '".$tipoVivienda."', nivel_estudio_usuario = '".$nivelEstudio."', profesion_usuario = '".$profesion."', departamento_trabajo_usuario = '".$departamentoTrabajo."', ciudad_trabajo_usuario = '".$ciudadTrabajo."', years_trabajo_usuario = ".$yearsTrabajo.", cargo_usuario = '".$cargo."', tipo_cargo_usuario = '".$tipoCargo."', years_cargo_usuario = ".$yearsCargo.", departamento_laboral_usuario = '".$departamentoLaboral."', tipo_contrato_usuario = '".$tipoContrato."', horas_dia_trabajo_usuario = ".$horasTrabajo.", tipo_salario_usuario = '".$tipoSalario."', estado_usuario = '".$estado."' where cedula_usuario = ".$cedula;
			$this->objConexion->consultaSimple($consulta);		
		}

		public function listar(){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarCedula($cedula){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where cedula_usuario = ".$cedula." and tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarNombre($nombre){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where nombre_usuario like '".$nombre."%' and tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarEmpresa($idEmpresa){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where id_empresa_usuario = ".$idEmpresa." and tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarEstado($estado){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where estado_usuario = '".$estado."' and tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarLogin($correo, $pass){
			$consulta="select * from usuario where correo_usuario like '".$correo."' and password_usuario like '".$pass."' and tipo_usuario like 'admin'";
			return $this->objConexion->consultaRetorno($consulta);
		}

	}

?>