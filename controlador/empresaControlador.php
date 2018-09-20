<?php
	include_once("../modelo/empresa.php");
	$objEmpresa=new Empresa();
	//print_r($_POST);
	switch ($_POST['accion']) {
		case 'registrar':
			$val=validarDatos(true);
			if ($val===true) {
				$objEmpresa->registrar($_POST['txtNit'],$_POST['txtNombre'],$_POST['comboCiudad'],$_POST['txtDireccion'],$_POST['txtTelefono'],$_POST['txtContacto']);
				echo "0";
			}else{
				echo $val;
			}
			break;
		
		case 'modificar':
			$val=validarDatos(false);
			if ($val===true) {
				$objEmpresa->modificar($_POST['txtNit'],$_POST['txtNombre'],$_POST['comboCiudad'],$_POST['txtDireccion'],$_POST['txtTelefono'],$_POST['txtContacto'],$_POST['comboEstado']);
				echo "0";
			}else{
				echo $val;
			}
			break;

		case 'eliminar':
			if ($_POST['txtNit']=="") {
			echo "El nit esta vacio";
			}else{
				if (mysqli_num_rows($objEmpresa->consultarUsuarios($_POST['txtNit']))!=0) {
					echo "La empresa tiene usuario relacionados, no se puede eliminar";
				}else{
					$objEmpresa->eliminar($_POST['txtNit']);
					echo "0";
				}
			}
			break;

		case 'listar':
			echo $objEmpresa->mostrar($objEmpresa->listar());
			break;

		case 'consultarNit':
			if ($_POST['valor']=="") {
				echo $objEmpresa->mostrar($objEmpresa->listar());
			}else{
				echo $objEmpresa->mostrar($objEmpresa->consultarNit($_POST['valor']));
			}
			break;

		case 'consultarNombre':
			echo $objEmpresa->mostrar($objEmpresa->consultarNombre($_POST['valor']));
			break;

		case 'consultarCiudad':
			echo $objEmpresa->mostrar($objEmpresa->consultarCiudad($_POST['valor']));
			break;

		case 'consultarContacto':
			echo $objEmpresa->mostrar($objEmpresa->consultarContacto($_POST['valor']));
			break;

		case 'consultarEstado':
			if ($_POST['valor']=="Estado") {
				echo $objEmpresa->mostrar($objEmpresa->listar());
			}else{
				echo $objEmpresa->mostrar($objEmpresa->consultarEstado($_POST['valor']));
			}
			
			break;

		case 'mostrarOption':
			echo $objEmpresa->mostrarOption();
			break;

		case 'mostrarOptionYear':
			echo $objEmpresa->mostrarOptionYear($_POST['idEmpresa']);
			break;
		default:
			# code...
			break;
	}
	function validarDatos($validacion){
		$objE=new Empresa();
		if ($_POST['txtNit']==="") {
			return "El nit es obligatorio";
		}else {
			if ($validacion) {
				if (mysqli_num_rows($objE->consultarNit($_POST['txtNit']))!=0){
					return "Ya existe una empresa con ese nit";
				}
			} else{
				if (mysqli_num_rows($objE->consultarNit($_POST['txtNit']))==0){
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
?>