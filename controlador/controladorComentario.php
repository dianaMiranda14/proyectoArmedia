<?php 
	include_once("../modelo/graficos.php");
	$objGrafico = new Graficos();

//	print_r($_POST);

	switch ($_POST['accionComentario']) {
		case '1':
			
			$comentario = $objGrafico->consultarComentario($_POST['cbmidEmpresa'],$_POST['comboYear'],$_POST['cmbnombreGrafico']);
				while ($mostrarComentario = mysqli_fetch_assoc($comentario)) {
					echo $mostrarComentario['comentario'];
				}

			break;
		
		case '2':
			
			$comentario = $objGrafico->registrarComentario($_POST['cbmidEmpresa'],$_POST['comboYear'],$_POST['cmbnombreGrafico'],$_POST['textComentario']);
				echo $comentario;

			break;
	}


	/**/





 ?>