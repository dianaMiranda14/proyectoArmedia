<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../resources/js/procedimientos.js"></script>
	<link rel="stylesheet" type="text/css" href="../resources/css/estilos.css">
</head>
<body>
	<div class="container">
		<?php
			include_once("../controlador/enrutadorAdmin.php");
			$objEnrutador=new enrutadorAdmin();
			if ($objEnrutador->validarVista($_GET['cargar'])) {
				$objEnrutador->cargarVista($_GET['cargar']);
			}
		?>
	</div>
</body>
</html>