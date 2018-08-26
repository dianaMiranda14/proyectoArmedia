<?php
	include_once("../modelo/plan_accion.php");
	include_once("../modelo/dimension.php");

	$objPlanAccion= new PlanAccion();
	$objDimension=new Dimension();

	function validarDatos($validacion){
		if ($validacion) {
			if ($_POST['txtId']=="") {
				return "El id esta vacio";
			}
		}
		if ($_POST['comboDimension']=="") {
			return "La dimension es obligatoria";
		}else if (mysqli_num_rows($objDimension->consultarId($_POST['txtId']))==0) {
			return "La dimension seleccionada no existe";
		}else if ($_POST['txtDescripcion']=="") {
			return "La descripcion es obligatoria";
		}else {
			return true;
		}
	}

	function registrar(){
		$val=validarDatos(false);
		if ($val) {
			$objPlanAccion->registrar($_POST['comboDimension'],$_POST['txtDescripcion']);
		}else {
			echo $val;
		}
	}

	function modificar(){
		$val=validarDatos(false);
		if ($val) {
			$objPlanAccion->modificar($_POST['txtId'],$_POST['comboDimension'],$_POST['txtDescripcion'], $_POST['comboEstado']);
		}else {
			echo $val;
		}
	}

	function eliminar(){
		if ($_POST['txtId']=="") {
			echo ">El id esta vacio";
		}else{
			$objPlanAccion->eliminar($_POST['txtId']);
		}
	}

	function listar(){
		print_r($objPlanAccion->listar());
	}

	function consultarDescripcion(){
		if ($_POST['txtConsultaDescripcion']=="") {
			echo "la descripcion esta vacia";
		}else{
			print_r($objPlanAccion->consultarDescripcion($_POST['txtConsultaDescripcion']));
		}
	}

	function listarDimension(){
		if ($_POST['comboConsultaDimension']=="") {
			echo "la Dimension esta vacia";
		}else{
			print_r($objPlanAccion->consultarDimension($_POST['comboConsultaDimension']));
		}
	}

	function listarEstado(){
		if ($_POST['comboConsultaEstado']=="") {
			echo "El Estado esta vacia";
		}else{
			print_r($objPlanAccion->consultarEstado($_POST['comboConsultaEstado']));
		}
	}


?>