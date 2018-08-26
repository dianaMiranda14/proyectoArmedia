<?php
	include_once("../modelo/empresa.php");
	$objEmpresa=new Empresa();
	

	function validarDatos($validacion){
		if ($_POST['txtNit']==="") {
			return "El nit es obligatorio";
		}else {
			if ($validacion) {
				if (mysqli_num_rows($objEmpresa->consultarId($_POST['txtNit']))!=0) ) {
					return "Ya existe una empresa con ese nit";
				}
			} else{
				if (mysqli_num_rows($objEmpresa->consultarId($_POST['txtNit']))==0) ) {
					return "No existe una empresa con ese nit";
				}
			}
		}
		if($_POST['txtNombre']==""){
			return "El nombre es obligatorio";
		}else if($_POST['comboCiudad']==""){
			return "La ciudad es obligatoria";
		}else if ($_POST['txtDireccion']=="") {
			return "La direccion es olbigatoria";
		}else if ($_POST['txtTelefono']=="") {
			return "El telefono es obligatorio";
		}else if ($_POST['txtContacto']=="") {
			return "El contacto es obligatorio";
		}else {
			return true;
		}
	}

	function registrar(){
		$val=validarDatos(true);
		if ($val) {
			$objEmpresa->registrar($_POST['txtNit'],$_POST['txtNombre'],$_POST['comboCiudad'],$_POST['txtDireccion'],$_POST['txtTelefono'],$_POST['txtContacto'],$_POST['checkHabilitado']);
		}else{
			echo $val;
		}
	}

	function modificar(){
		$val=validarDatos(false);
		if ($val) {
			$objEmpresa->modificar($_POST['txtNit'],$_POST['txtNombre'],$_POST['comboCiudad'],$_POST['txtDireccion'],$_POST['txtTelefono'],$_POST['txtContacto'],$_POST['checkHabilitado'],$_POST['comboEstado']);
		}else{
			echo $val;
		}
	}

	function eliminar(){
		if ($_POST['txtNit']=="") {
			echo "El nit esta vacio";
		}else{
			$objEmpresa->eliminar($_POST['txtNit']);
		}
	}

	function listar(){
		print_r($objEmpresa->listar());
	}

	function consultarNit(){
		if ($_POST['txtConsultaNit']=="") {
			echo "El nit esta vacio";
		}else{
			print_r($objEmpresa->consultarNit($_POST['txtConsultaNit']));
		}
	}

	function consultarNombre(){
		if ($_POST['txtConsultaNombre']=="") {
			echo "El nombre esta vacio";
		}else{
			print_r($objEmpresa->consultarNombre($_POST['txtConsultaNombre']));
		}
	}

	function consultarCiudad(){
		if ($_POST['comboConsultaCiudad']=="") {
			echo "La ciudad esta vacia";
		}else{
			print_r($objEmpresa->consultarCiudad($_POST['comboConsultaCiudad']));
		}
	}

	function consultarContacto(){
		if ($_POST['txtConsultaContacto']=="") {
			echo "El Contacto esta vacio";
		}else{
			print_r($objEmpresa->consultarContacto($_POST['txtConsultaContacto']));
		}
	}

	function consultarEstado(){
		if ($_POST['comboConsultaEstado']=="") {
			echo "El Estado esta vacio";
		}else{
			print_r($objEmpresa->consultarEstado($_POST['comboConsultaEstado']));
		}
	}

	function consultarUsuarios(){
		if ($_POST['txtConsultaNit']=="") {
			echo "El nit esta vacio";
		}else{
			print_r($objEmpresa->consultarUsuarios($_POST['txtConsultaNit']));
		}
	}



?>