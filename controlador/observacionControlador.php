<?php
	include_once("../modelo/observacion.php");
	include_once("../modelo/cuestionario.php");
	//print_r($_POST);
	$_POST['accion']();

	function validarDatos($validacion){
		$objCuestionario=new Cuestionario();
		if ($validacion) {
			if ($_POST['txtId']=="") {
				return  "Ei id esta vacio";
			}
		}
		if ($_POST['comboCuestionario']=="") {
			return "El cuestionario esta vacio";
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
		$objObservacion=new Observacion();
		$val=validarDatos(false);
		if ($val) {
			$objObservacion->registrar($_POST['comboCuestionario'],$_POST['comboTipo'], $_POST['comboContenido'],$_POST['txtDescripcion']);
			echo "0";
		}else{
			echo $val;
		}
	}

	function modificar(){
		$objObservacion=new Observacion();
		$val=validarDatos(false);
		if ($val) {
			$objObservacion->modificar($_POST['txtId'],$_POST['comboCuestionario'],$_POST['comboTipo'], $_POST['comboContenido'],$_POST['txtDescripcion'], $_POST['comboEstado']);
			echo "0";
		}else{
			echo $val;
		}
	}

	function eliminar(){
		$objObservacion=new Observacion();
		if ($_POST['txtId']=="") {
			echo "El id esta vacio";
		}else{
			$objObservacion->eliminar($_POST['txtId']);
			echo "0";
		}
	}

	function listar(){
		$objObservacion=new Observacion();
		print_r($objObservacion->mostrar($objObservacion->listar()));
	}

	function consultarCuestionario(){
		$objObservacion=new Observacion();
		if ($_POST['valor']=="Cuestionario") {
			print_r($objObservacion->mostrar($objObservacion->listar()));
		}else{
			print_r($objObservacion->mostrar($objObservacion->consultarCuestionario($_POST['valor'])));
		}
	}

	function consultarDescripcion(){
		$objObservacion=new Observacion();
		print_r($objObservacion->mostrar($objObservacion->consultarDescripcion($_POST['valor'])));
	}

	function consultarTipo(){
		$objObservacion=new Observacion();
		if ($_POST['valor']=="Tipo") {
			print_r($objObservacion->mostrar($objObservacion->listar()));
		}else{
			print_r($objObservacion->mostrar($objObservacion->consultarTipo($_POST['valor'])));
		}
	}

	function consultarContenido(){
		$objObservacion=new Observacion();
		print_r($objObservacion->mostrar($objObservacion->consultarContenido($_POST['valor'])));
	}

	function consultarEstado(){
		$objObservacion=new Observacion();
		if ($_POST['valor']=="Estado") {
			print_r($objObservacion->mostrar($objObservacion->listar()));
		}else{
			print_r($objObservacion->mostrar($objObservacion->consultarEstado($_POST['valor'])));
		}
	}

?>