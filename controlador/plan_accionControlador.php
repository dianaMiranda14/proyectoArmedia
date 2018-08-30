<?php
	include_once("../modelo/plan_accion.php");
	include_once("../modelo/dimension.php");
	//print_r($_POST);
	$_POST['accion']();

	function validarDatos($validacion){
		$objDimension=new Dimension();
		if ($validacion) {
			if ($_POST['txtId']=="") {
				return "El id esta vacio";
			}
		}
		if ($_POST['comboDimension']=="") {
			return "La dimension es obligatoria";
		}else if (mysqli_num_rows($objDimension->consultarId($_POST['comboDimension']))==0) {
			return "La dimension seleccionada no existe";
		}else if ($_POST['txtDescripcion']=="") {
			return "La descripcion es obligatoria";
		}else {
			return true;
		}
	}

	function registrar(){
		$objPlanAccion= new PlanAccion();
		$val=validarDatos(false);
		if ($val) {
			$objPlanAccion->registrar($_POST['comboDimension'],$_POST['txtDescripcion']);
			echo "0";
		}else {
			echo $val;
		}
	}

	function modificar(){
		$objPlanAccion= new PlanAccion();
		$val=validarDatos(false);
		if ($val) {
			$objPlanAccion->modificar($_POST['txtId'],$_POST['comboDimension'],$_POST['txtDescripcion'], $_POST['comboEstado']);
			echo "0";
		}else {
			echo $val;
		}
	}

	function eliminar(){
		$objPlanAccion= new PlanAccion();
		if ($_POST['txtId']=="") {
			echo ">El id esta vacio";
		}else{
			$objPlanAccion->eliminar($_POST['txtId']);
			echo "0";
		}
	}

	function listar(){
		$objPlanAccion= new PlanAccion();
		print_r($objPlanAccion->mostrar($objPlanAccion->listar()));
	}

	function consultarDescripcion(){
		$objPlanAccion= new PlanAccion();
		print_r($objPlanAccion->mostrar($objPlanAccion->consultarDescripcion($_POST['txtConsultaDescripcion'])));
	}

	function listarDimension(){
		$objPlanAccion= new PlanAccion();
		if ($_POST['valor']=="Dimensión") {
			print_r($objPlanAccion->mostrar($objPlanAccion->listar()));
		}else{
			print_r($objPlanAccion->mostrar($objPlanAccion->consultarDimension($_POST['comboConsultaDimension'])));
		}
	}

	function listarEstado(){
		$objPlanAccion= new PlanAccion();
		if ($_POST['valor']=="Estado") {
			print_r($objPlanAccion->mostrar($objPlanAccion->listar()));
		}else{
			print_r($objPlanAccion->mostrar($objPlanAccion->consultarEstado($_POST['comboConsultaEstado'])));
		}
	}


?>