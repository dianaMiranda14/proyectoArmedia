<?php
	include_once("../modelo/Dimension.php");
	include_once("../modelo/plan_accion_empresa.php");
	$objDimension=new Dimension();
	$objPlanEmpresa=new PlanAccionEmpresa();

	//print_r($_POST);
	switch ($_POST["accion"]) {

		case 'porcentaje':
			echo '<table class="table table-hover">
					<tr>
						<th scope="col" class="table-primary">Dimensión</th>
						<th scope="col" class="table-primary">Riesgo Muy Alto</th>
						<th scope="col" class="table-primary">Riesgo Alto</th>
						<th scope="col" class="table-primary">Riesgo medio</th>
					</tr>';
			echo $objPlanEmpresa->porcentaje($_POST['comboEmpresa'],$_POST["comboYear"], $objDimension->listarCuestionarioIntralaboral(),1);
			echo $objPlanEmpresa->porcentaje($_POST['comboEmpresa'],$_POST["comboYear"], $objDimension->listarCuestionarioExtralaboral(),3);
			echo "</table>";
			break;

		case 'registrar':
				$objPlanEmpresa->registrar($_POST["idEmpresa"],$_POST['idDimension'], $_POST["valorDimension"], $_POST["year"], $_POST["comboArea"], $_POST["comboResponsable"], $_POST["idPlan"], $_POST["idAccion"]);
				echo "0";
			break;
		
		case 'modificar':
				$objPlanEmpresa->modificar($_POST["id"],$_POST["comboArea"],$_POST["comboResponsable"], $_POST["idPlan"], $_POST["idAccion"]);
				echo "0";
			break;
		
		default:
			# code...
			break;
	}
?>