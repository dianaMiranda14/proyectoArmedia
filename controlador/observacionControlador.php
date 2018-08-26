<?php
	include_once("../modelo/observacion.php");
	include_once("../modelo/cuestionario.php");

	$objObservacion=new Observacion();
	$objCuestionario=new Cuestionario();

	function validarDatos($validacion){
		if ($validacion) {
			if ($_POST['txtId']=="") {
				return  "Ei id esta vacio";
			}
		}
		if ($_POST['comboCuestionario']=="") {
			return "El cuestionario esta vacio"
		}else if (mysqli_num_rows($objCuestionario->consultarId($_POST['comboCuestionario']))==0) {
			return "El cuestionario seleccionado no existe";
		}else if ($_POST['comboTipo']=="") {
			return "El tipo es obligatorio";
		}else if ($_POST['comboContenido']=="") {
			return "El contenido es obligatorio";
		}else if ($_POST['txtDescripcion']=="") {
			return "La descripcion es obligatoria";
		}else{
			return true;
		}
	}

	function registrar(){
		$val=validarDatos(false);
		if ($val) {
			$objObservacion->registrar($_POST['comboCuestionario'],$_POST['comboTipo'], $_POST['comboContenido'],$_POST['txtDescripcion']);
		}else{
			echo $val;
		}
	}

	function modificar(){
		$val=validarDatos(false);
		if ($val) {
			$objObservacion->modificar($_POST['txtId'],$_POST['comboCuestionario'],$_POST['comboTipo'], $_POST['comboContenido'],$_POST['txtDescripcion'], $_POST['comboEstado']);
		}else{
			echo $val;
		}
	}

	function eliminar(){
		if ($_POST['txtId']=="") {
			echo "El id esta vacio";
		}else{
			$objObservacion->eliminar($_POST['txtId']);
		}
	}

	function listar(){
		print_r($objObservacion->listar());
	}

	function consultarId(){
		print_r($objObservacion->consultarId($_POST['txtConsultaId']));
	}

	function consultarDescripcion(){
		print_r($objObservacion->consultarDescripcion($_POST['txtConsultarDescripcion']));
	}

	function consultarTipo(){
		print_r($objObservacion->consultarTipo($_POST['comboConsultarTipo']));
	}

	function consultarContenido(){
		print_r($objObservacion->consultarContenido($_POST['txtConsultarContenido']));
	}

	function consultarEstado(){
		print_r($objObservacion->consultarEstado($_POST['comboConsultarEstado']));
	}

?>