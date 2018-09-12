<?php
	include_once("../modelo/usuario.php");
	include_once("../modelo/empresa.php");
	$objUsuario= new Usuario();
	$objEmpresa= new Empresa();
	session_start();
	//print_r($_POST);
	//print_r($_FILES);
	switch ($_POST['accion']) {
		case 'registrar':
			$val=validarDatos(true);
			if ($val===true) {
				$objUsuario->registrar($_POST['txtCedula'],$_POST['comboEmpresa'],$_POST['txtNombre'], $_POST['comboSexo'],$_POST['comboEstadoCivil'],$_POST['txtFechaNacimiento'],$_POST['txtPersonasDependen'],$_POST['comboDepartamentoResidencia'],$_POST['comboCiudadResidencia'],$_POST['comboEstrato'], $_POST['comboTipoVivienda'],$_POST['comboNivelEstudio'],$_POST['txtProfesion'],$_POST['comboDepartamentoTrabajo'],$_POST['comboCiudadTrabajo'],$_POST['txtYearsTrabajo'],$_POST['txtCargo'],$_POST['comboTipoCargo'],$_POST['txtYearsCargo'],$_POST['txtDepartamentoLaboral'], $_POST['comboTipoContrato'],$_POST['txtHorasTrabajo'],$_POST['comboTipoSalario']);
				echo "0";
			}else{
				echo $val;
			}
			break;

		case 'modificar':
			$val=validarDatos(false);
			if ($val===true) {
				$objUsuario->modificar($_POST['txtId'],$_POST['txtCedula'],$_POST['comboEmpresa'],$_POST['txtNombre'], $_POST['comboSexo'],$_POST['comboEstadoCivil'],$_POST['txtFechaNacimiento'],$_POST['txtPersonasDependen'],$_POST['comboDepartamentoResidencia'],$_POST['comboCiudadResidencia'],$_POST['comboEstrato'], $_POST['comboTipoVivienda'],$_POST['comboNivelEstudio'],$_POST['txtProfesion'],$_POST['comboDepartamentoTrabajo'],$_POST['comboCiudadTrabajo'],$_POST['txtYearsTrabajo'],$_POST['txtCargo'],$_POST['comboTipoCargo'],$_POST['txtYearsCargo'],$_POST['txtDepartamentoLaboral'], $_POST['comboTipoContrato'],$_POST['txtHorasTrabajo'],$_POST['comboTipoSalario'],$_POST['comboEstado']);
				echo "0";
			}else{
				echo $val;
			}
			break;

		case 'modificarUsuario':
			$objUsuario->modificar($_POST['txtCedula'],$_POST['txtCedula'],$_POST['comboEmpresa'],$_POST['txtNombre'], $_POST['comboSexo'],$_POST['comboEstadoCivil'],$_POST['txtFechaNacimiento'],$_POST['txtPersonasDependen'],$_POST['comboDepartamentoResidencia'],$_POST['comboCiudadResidencia'],$_POST['comboEstrato'], $_POST['comboTipoVivienda'],$_POST['comboNivelEstudio'],$_POST['txtProfesion'],$_POST['comboDepartamentoTrabajo'],$_POST['comboCiudadTrabajo'],$_POST['txtYearsTrabajo'],$_POST['txtCargo'],$_POST['comboTipoCargo'],$_POST['txtYearsCargo'],$_POST['txtDepartamentoLaboral'], $_POST['comboTipoContrato'],$_POST['txtHorasTrabajo'],$_POST['comboTipoSalario'],'Activo');
			$_SESSION['usuarioCuestionario']=mysqli_fetch_assoc($objUsuario->consultarCedula($_POST['txtCedula']));
			echo "0";
			break;

		case 'listar':
			echo $objUsuario->mostrar($objUsuario->listar());
			break;

		case 'consultarCedula':
			if ($_POST['valor']=="") {
				echo $objUsuario->mostrar($objUsuario->listar());
			}else{
				echo $objUsuario->mostrar($objUsuario->consultarCedula($_POST['valor']));
			}
			break;

		case 'consultarNombre':
			echo $objUsuario->mostrar($objUsuario->consultarNombre($_POST['valor']));	
			break;

		case 'consultarEmpresa':
			if ($_POST['valor']=="Empresa") {
				echo $objUsuario->mostrar($objUsuario->listar());
			}else{
				echo $objUsuario->mostrar($objUsuario->consultarEmpresa($_POST['valor']));
			}
			break;

		case 'consultarEstado':
			if ($_POST['valor']=="Estado") {
				echo $objUsuario->mostrar($objUsuario->listar());
			}else{
				echo $objUsuario->mostrar($objUsuario->consultarEstado($_POST['valor']));
			}
			break;

		case 'consultarLogin':
			$resultado = $objUsuario->consultarLogin($_POST['txtCorreo'], $_POST['txtPassword']);
			if (mysqli_num_rows($resultado)>0) {
				$_SESSION['usuarioLogin']=mysqli_fetch_assoc($resultado);
				echo "0";
			}else{
				echo "Datos incorrectos";
			}
			break;

		case 'consultarUsuario':
			$resultado=$objUsuario->consultarCedulaEstado($_POST['valor']);
			if (mysqli_num_rows($resultado)>0) {
				$fetch = mysqli_fetch_assoc($resultado);
				$json = json_encode($fetch);
				echo $json;
				
			}
			break;
		default:
			# code...
			break;
	}

	function validarDatos($validacion){
		$objUsuario=new Usuario();
		$objEmpresa=new Empresa();
		print_r($_POST);
		if ($_POST['txtCedula']=="") {
			return "La cedula es obligatoria";
		}else{
			if ($validacion==true) {
				if (mysqli_num_rows($objUsuario->consultarCedula($_POST['txtCedula']))!=0) {
					return "Ya exite un usuario registrado con la misma cedula";
				}
			}else{
				if ($_POST['txtId']!==$_POST['txtCedula']) {
					if (mysqli_num_rows($objUsuario->consultarCedula($_POST['txtCedula']))!=0) {
						return "Ya exite un usuario registrado con la misma cedula";
					}
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
			return "La fecha de nacimiento es obligatorio";
		}else if ($_POST['txtPersonasDependen']=="") {
			return "La cantidad de personas que dependen es obligatoria";
		}else if ($_POST['comboNivelEstudio']=="") {
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
?>