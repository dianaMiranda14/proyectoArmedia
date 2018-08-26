<?php
	include_once("../modelo/accion_recomendada.php");
	include_once("../modelo/dimension.php");
	$objAccionRecomendada=new AccionRecomendada();
	$objDimension=new Dimension();
	$function = $_POST['accion'];
	$function();

	function validarDatos($validacion){
		if ($validacion) {
			if($_POST['txtIdAccion']===""){
				return "El id de la acción recomendada está vacío";
			}
		}
		if ($_POST['comboDimension']==="") {
			return "La dimensión es obligatoria";
		}else if(mysqli_num_rows($objDimension->consultarId($_POST['comboDimension']))==0){
			return "La dimension seleccionada no esta registrada";
		}else if ($_POST['txtDescripcion']==="") {
			return "La descripcion es obligatoria";
		}else{
			return true;
		}
	}

	function registrar(){
		$val=validarDatos(false);
		if ($val) {
			$objAccionRecomendada->registrar($_POST['comboDimension'], $_POST['txtDescripcion']);
		}else{
			echo $val;
		}
	}

	function modificar(){
		$val=validarDatos(true);
		if ($val) {
			$objAccionRecomendada->modificar($_POST['txtIdAccion'],$_POST['comboDimension'],$_POST['txtDescripcion'],$_POST['comboEstado']);
		}else{
			echo $val;
		}
	}

	function eliminar(){
		if ($_POST['txtIdAccion']==="") {
			echo "El id de la accion recomendada esta vacío";
		}else{
			$objAccionRecomendada->eliminar($_POST['txtIdAccion']);
		}
	}

	function listar(){
		print_r($objAccionRecomendada->listar());
	}

	function consultarEstado(){
		if ($_POST['comboConsultaEstado']==="") {
			echo "Debe de elegir un estado valido";
		}else{
			print_r($objAccionRecomendada->consultarEstado());
		}
	}

	function consultarDescripcion(){
		if ($_POST['txtConsultaDescripcion']==="") {
			echo "La descripcion esta vacia";
		}else{
			print_r($objAccionRecomendada->consultarDescripcion());
		}
	}

	function consultarDimension(){
		if ($_POST['comboConsultaDimension']==="") {
			echo "La dimension esta vacia";
		}else{
			print_r($objAccionRecomendada->consultarDimension());
		}
	}
?>