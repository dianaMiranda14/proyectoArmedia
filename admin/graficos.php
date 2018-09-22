<?php 
		include_once("../modelo/empresa.php");
		$objEmpresa = new Empresa();
 ?>
 <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<div class="container mt-5 pt-2 pb-4" style="background: #fff;">
	<h1 class="text-center">Graficos</h1>
	<div class="dropdown-divider " style="color: #839af8;"></div>
	
	<div class="row">
		<div class="col-sm-4">
			Empresa:
		</div>
		<div class="col-sm-4">
			Año:
		</div>
		<div class="col-sm-4">
			Grafico:
		</div>
	</div>
	<form id="frmGraficos" name="frmGraficos">
	<div class="row mb-5">
		<div class="col-sm-4">
			<select name="cbmidEmpresa" id="cbmidEmpresa" class="form-control">
				<option>Seleccione Una Empresa</option>
				<?php 
					$empresas = $objEmpresa->listar();
					while ($mostrarEmpresas = mysqli_fetch_assoc($empresas)) {
						echo '<option value="'.$mostrarEmpresas["nit_empresa"].'">'.$mostrarEmpresas["nombre_empresa"].'</option>';
					}
				 ?>
			</select>
		</div>
		<div class="col-sm-4">
			<select name="cbmidanio" id="cbmidanio" class="form-control">
				<option>Seleccione Un Año</option>
				<option>2018</option>
				<option>2017</option>
				<option>2016</option>
			</select>
		</div>
		<div class="col-sm-4">
			<select name="cmbnombreGrafico" class="form-control" id="cmbnombreGrafico" onchange="mostarGrafico()">
				<option>Seleccione Un Grafico</option>
				<option value="1">Distrubucion por Genero</option>
				<option value="2">Distrubucion por Grupo Etario</option>
				<option value="3">Distrubucion por Estado Civil</option>
			</select>
		</div>
	</div>
</form>

		<head>
	
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">


		</script>
	</head>
	<body>
<script src="../Highcharts-4.1.5/js/highcharts.js"></script>
<!--<script src="../Highcharts-4.1.5/js/modules/exporting.js"></script>-->

<div id="container" style="width:100%; height:400px;"></div>


</div>