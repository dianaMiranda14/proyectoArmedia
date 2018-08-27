<?php
	include_once("../modelo/usuario.php");
	include_once("../modelo/empresa.php");
	$objUsuario=new Usuario();
	$objEmpresa=new Empresa();

	function validarDatos($validacion){
		if ($_POST['txtCedula']=="") {
			return "La cedula es obligatoria";
		}else{
			if ($validacion) {
				if (mysqli_num_rows($objUsuario->consultarCedula($_POST['txtCedula']))!=0) {
					return "Ya exite un usuario registrado con la misma cedula";
				}
			}else{
				if (mysqli_num_rows($objUsuario->consultarCedula($_POST['txtCedula']))==0) {
					return "No exite un usuario registrado con la misma cedula";
				}
			}
		}
		if ($_POST['txtNombre']=="") {
			return "El nombre es obligatorio";
		}else if ($_POST['comboSexo']=="") {
			return "El sexo es obligatorio";
		}else if ($_POST['comboEstadoCivil']=="") {
			return "El estado civil es obligatorio";
		}else if ($_POST['txtFechaNacimiento']=="") {
			return "La fecha de nacimiento es obligatorio"
		}else if ($_POST['txtPersonasDepende']=="") {
			return "La cantidad de personas que dependen es obligatoria";
		}elseif ($_POST['comboNivelEstudio']=="") {
			return "El nivel de estudio es obligatorio";
		}elseif ($_POST['txtProfesion']=="") {
			return "La profesion es obligatoria";
		}else if ($_POST['comboDepartamentoResidencia']=="") {
			return "El departamento de residencia es obligatorio";
		}elseif ($_POST['comboCiudadResidencia']=="") {
			return "La ciudad de residencia es obligatoria";
		}elseif ($_POST['comboEstrato']=="") {
			return "El estrato es obligatorio";
		}elseif ($_POST['comboTipoVivienda']=="") {
			return "El tipo de vivienda es obligatorio";
		}elseif ($_POST['comboDepartamentoTrabajo']=="") {
			return "El departamento de trabajo es obligatorio";
		}elseif ($_POST['comboCiudadTrabajo']=="") {
			return "La ciudad de trabajo es obligatoria";
		}else if ($_POST['comboEmpresa']=="") {
			return "La empresa es obligatoria";
		}else if (mysqli_num_rows($objEmpresa->consultarNit($_POST['comboEmpresa']))==0) {
			return "La empresa seleccionada no esta registrada";
		}elseif ($_POST['txtYearsTrabajo']=="") {
			return "La cantidad de años de trabajo es obligatoria";
		}elseif ($_POST['txtDepartamentoLaboral']=="") {
			return "El departamento laboral es obligatorio";
		}elseif ($_POST['txtCargo']=="") {
			return "El cargo es obligatorio";
		}elseif ($_POST['comboTipoCargo']=="") {
			return "El tipo de cargo es obligatorio";
		}elseif ($_POST['txtYearsCargo']=="") {
			return "La cantidad de años en el cargo es obligatoria";
		}elseif ($_POST['txtHorasTrabajo']=="") {
			return "La cantidad de horas de trabajo al dia es obligatoria";
		}elseif ($_POST['comboTipoContrato']=="") {
			return "El tipo de contrato es obligatorio";
		}elseif ($_POST['comboTipoSalario']=="") {
			return "El tipo de salario es obligatorio";
		}else{
			return true;
		}
	}


	function registrar(){
		$val=validarDatos(true);
		if ($val) {
			$objUsuario->registrar($_POST['txtCedula'],$_POST['comboEmpresa'],$_POST['txtNombre'], $_POST['comboSexo'],$_POST['comboEstadoCivil'],$_POST['txtFechaNacimiento'],$_POST['txtPersonasDepende'],$_POST['comboDepartamentoResidencia'],$_POST['comboCiudadResidencia'],$_POST['comboEstrato'], $_POST['comboTipoVivienda'],$_POST['comboNivelEstudio'],$_POST['txtProfesion'],$_POST['comboDepartamentoTrabajo'],$_POST['comboCiudadTrabajo'],$_POST['txtYearsTrabajo'],$_POST['txtCargo'],$_POST['comboTipoCargo'],$_POST['txtYearsCargo'],$_POST['txtDepartamentoLaboral'], $_POST['comboTipoContrato'],$_POST['txtHorasTrabajo'],$_POST['comboTipoSalario']);
		}else{
			echo $val;
		}
	}

	function modificar(){
		$val=validarDatos(false);
		if ($val) {
			$objUsuario->modificar($_POST['txtCedula'],$_POST['comboEmpresa'],$_POST['txtNombre'], $_POST['comboSexo'],$_POST['comboEstadoCivil'],$_POST['txtFechaNacimiento'],$_POST['txtPersonasDepende'],$_POST['comboDepartamentoResidencia'],$_POST['comboCiudadResidencia'],$_POST['comboEstrato'], $_POST['comboTipoVivienda'],$_POST['comboNivelEstudio'],$_POST['txtProfesion'],$_POST['comboDepartamentoTrabajo'],$_POST['comboCiudadTrabajo'],$_POST['txtYearsTrabajo'],$_POST['txtCargo'],$_POST['comboTipoCargo'],$_POST['txtYearsCargo'],$_POST['txtDepartamentoLaboral'], $_POST['comboTipoContrato'],$_POST['txtHorasTrabajo'],$_POST['comboTipoSalario'],$_POST['comboEstado']);
		}else{
			echo $val;
		}
	}

	function listar(){
		print_r($objUsuario->listar());
	}

	function consultarCedula(){
		print_r($objUsuario->consultarCedula($_POST['txtCedula']));
	}

	function consultarNombre(){
		print_r($objUsuario->consultarNombre($_POST['txtConsultaNombre']));
	}

	function consultarEmpresa(){
		print_r($objUsuario->consultarEmpresa($_POST['comboEmpresa']));
	}


?>