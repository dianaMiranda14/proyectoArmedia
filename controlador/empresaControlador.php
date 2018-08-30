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
				$objEmpresa->modificar($_POST['txtNit'],$_POST['txtNombre'],$_POST['comboCiudad'],$_POST['txtDireccion'],$_POST['txtTelefono'],$_POST['txtContacto'],(isset($_POST['checkHabilitado']) ? $_POST['checkHabilitado'] : 0),$_POST['comboEstado']);
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
			$resultado=$objEmpresa->listar();
	    	if (mysqli_num_rows($resultado)>0) {
	    		while ($obj=mysqli_fetch_assoc($resultado)) {
	    			mostrarLista($obj);
	    		}
	    	}else{
	    		echo '
	    		<tr>
	    			<td colspan="9">No hay registros</td>
	    		</tr>';
	    	}

			break;

		case 'consultarNit':
			if ($_POST['valor']=="") {
				$resultado=$objEmpresa->listar();
		    	if (mysqli_num_rows($resultado)>0) {
		    		while ($obj=mysqli_fetch_assoc($resultado)) {
		    			mostrarLista($obj);
		    		}
		    	}
			}else{
				$resultado=$objEmpresa->consultarNit($_POST['valor']);
		    	if (mysqli_num_rows($resultado)>0) {
		    		while ($obj=mysqli_fetch_assoc($resultado)) {
		    			mostrarLista($obj);
		    		}
		    	}else{
		    		echo '
		    		<tr>
		    			<td colspan="9">No hay registros</td>
		    		</tr>';
		    	}
			}
			break;

		case 'consultarNombre':
			$resultado=$objEmpresa->consultarNombre($_POST['valor']);
	    	if (mysqli_num_rows($resultado)>0) {
	    		while ($obj=mysqli_fetch_assoc($resultado)) {
	    			mostrarLista($obj);
	    		}
	    	}else{
	    		echo '
	    		<tr>
	    			<td colspan="9">No hay registros</td>
	    		</tr>';
	    	}
			break;

		case 'consultarCiudad':
			$resultado=$objEmpresa->consultarCiudad($_POST['valor']);
	    	if (mysqli_num_rows($resultado)>0) {
	    		while ($obj=mysqli_fetch_assoc($resultado)) {
	    			mostrarLista($obj);
	    		}
	    	}else{
	    		echo '
	    		<tr>
	    			<td colspan="9">No hay registros</td>
	    		</tr>';
	    	}
			break;

		case 'consultarContacto':
			$resultado=$objEmpresa->consultarContacto($_POST['valor']);
	    	if (mysqli_num_rows($resultado)>0) {
	    		while ($obj=mysqli_fetch_assoc($resultado)) {
	    			mostrarLista($obj);
	    		}
	    	}else{
	    		echo '
	    		<tr>
	    			<td colspan="9">No hay registros</td>
	    		</tr>';
	    	}
			break;

		case 'consultarEstado':
			if ($_POST['valor']=="Estado") {
				$resultado=$objEmpresa->listar();
				if (mysqli_num_rows($resultado)>0) {
		    		while ($obj=mysqli_fetch_assoc($resultado)) {
		    			mostrarLista($obj);
		    		}
		    	}
			}else{
				$resultado=$objEmpresa->consultarEstado($_POST['valor']);
		    	if (mysqli_num_rows($resultado)>0) {
		    		while ($obj=mysqli_fetch_assoc($resultado)) {
		    			mostrarLista($obj);
		    		}
		    	}else{
		    		echo '
		    		<tr>
		    			<td colspan="9">No hay registros</td>
		    		</tr>';
		    	}
			}
			
			break;

		case 'consultarUsuarios':
			if ($_POST['txtConsultaNit']=="") {
				echo "El nit esta vacio";
			}else{
				print_r($objEmpresa->consultarUsuarios($_POST['txtConsultaNit']));
			}
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

	function mostrarLista($obj){
		$mostrar=
	    			'<tr>
	    				<td>'.$obj['nit_empresa'].'</td>
	    				<td>'.$obj['nombre_empresa'].'</td>
	    				<td>'.$obj['ciudad_empresa'].'</td>
	    				<td>'.$obj['direccion_empresa'].'</td>
	    				<td>'.$obj['telefono_empresa'].'</td>
	    				<td>'.$obj['contacto_empresa'].'</td>
	    				<td>'.$obj['estado_empresa'].'</td>';
	    			if ($obj['habilitado_empresa']=='0') {
	    				$habilitado="x";
	    			}else{
	    				$habilitado="✓";
	    			}
	    			$mostrar.='
	    				<td>'.$habilitado.'</td>
	    				<td> <input type="button" class="btn btn-primary" onclick=\'modalEmpresa("modificar",'.json_encode($obj).')\' value="Modificar"></td>
	    				<td> <input type="button" class="btn btn-primary" onclick=\'modalEmpresa("eliminar",'.json_encode($obj).')\' value="Eliminar"></td>
	    			</tr>';
	    			echo $mostrar;
	}
?>