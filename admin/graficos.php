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
			<select name="cbmidEmpresa" id="cbmidEmpresa" class="form-control" onchange="mostrarYear(this.value)">
				<option>Seleccione Una Empresa</option>
				<?php 
					$objEmpresa->mostrarOption();
				 ?>
			</select>
		</div>
		<div class="col-sm-4">
			<select name="comboYear" id="comboYear" class="form-control">
				<option>Seleccione Un Año</option>			
			</select>
		</div>
		<div class="col-sm-4">
			<select name="cmbnombreGrafico" class="form-control" id="cmbnombreGrafico" onchange="mostarGrafico()">
				<option>Seleccione Un Grafico</option>
				<option value="1">Distrubucion por Genero</option>
				<option value="2">Distrubucion por Grupo Etario | falta</option>
				<option value="3">Distrubucion por Estado Civil</option>
				<option value="4">Distrubucion por Grado de Escolaridad</option>
				<option value="5">Distrubucion por Estrato</option>
				<option value="6">Distribución Por Tenencia de la Vivienda</option>
				<option value="7">Distribución Por Personas a Cargo | falta</option>			
				<option value="8">Distribución Por Tiempo en la Empresa | falta</option>	
				<option value="9">Distribución Por Tipo de Cargo</option>	
				<option value="10">Distribución Por Teimpo en el Cargo | falta</option>	

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