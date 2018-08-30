<?php
	include_once("../modelo/accion_recomendada.php");
	include_once("../modelo/dimension.php");
	//print_r($_POST);
	$function = $_POST['accion'];
	$function();

	function validarDatos($validacion){
		$objDimension=new Dimension();
		if ($validacion) {
			if($_POST['txtId']===""){
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
		$objAccionRecomendada=new AccionRecomendada();
		$val=validarDatos(false);
		if ($val) {
			$objAccionRecomendada->registrar($_POST['comboDimension'], $_POST['txtDescripcion']);
			echo "0";
		}else{
			echo $val;
		}
	}

	function modificar(){
		$objAccionRecomendada=new AccionRecomendada();
		$val=validarDatos(true);
		if ($val) {
			$objAccionRecomendada->modificar($_POST['txtId'],$_POST['comboDimension'],$_POST['txtDescripcion'],$_POST['comboEstado']);
			echo "0";
		}else{
			echo $val;
		}
	}

	function eliminar(){
		$objAccionRecomendada=new AccionRecomendada();
		if ($_POST['txtId']==="") {
			echo "El id de la accion recomendada esta vacío";
		}else{
			$objAccionRecomendada->eliminar($_POST['txtId']);
		}
	}

	function listar(){
		$objAccionRecomendada=new AccionRecomendada();
		echo $objAccionRecomendada->mostrar($objAccionRecomendada->listar());
	}

	function consultarEstado(){
		$objAccionRecomendada=new AccionRecomendada();
		if ($_POST['valor']=="Estado") {
			echo $objAccionRecomendada->mostrar($objAccionRecomendada->listar());
		}else{
			echo $objAccionRecomendada->mostrar($objAccionRecomendada->consultarEstado($_POST['valor']));
		}
		
	}

	function consultarDescripcion(){
		$objAccionRecomendada=new AccionRecomendada();
		echo $objAccionRecomendada->mostrar($objAccionRecomendada->consultarDescripcion($_POST['valor']));
	}

	function consultarDimension(){
		$objAccionRecomendada=new AccionRecomendada();
		if ($_POST['valor']=="Dimensión") {
			echo $objAccionRecomendada->mostrar($objAccionRecomendada->listar());
		}else{
			echo $objAccionRecomendada->mostrar($objAccionRecomendada->consultarDimension($_POST['valor']));
		}
	}
?>