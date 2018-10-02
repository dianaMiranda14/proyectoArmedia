<?php 
		include_once("../modelo/empresa.php");
		$objEmpresa = new Empresa();

		include_once("../modelo/graficos.php");
		$objGrafico = new Graficos();
 ?>
 <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<div class="row" >
	<div class="col-sm-12">
		<h1 class="text-center">Graficos</h1>
		<div class="dropdown-divider " style="color: #839af8;"></div>
	</div>
	<div class="container">
		
	
	<form id="frmGraficos" name="frmGraficos">
		
		<div class="row ">
		<div class="col-sm-4">
			Empresa:
			<select name="cbmidEmpresa" id="cbmidEmpresa" class="form-control" onchange="mostrarYear(this.value)">
				<option>Seleccione Una Empresa</option>
				<?php 
					$objEmpresa->mostrarOption();
				 ?>
			</select>
		</div>
		<div class="col-sm-4">
				Año:
			<select name="comboYear" id="comboYear" class="form-control">
				<option>Seleccione Un Año</option>			
			</select>
		</div>
		<div class="col-sm-4">
			Grafico:
			<select name="cmbnombreGrafico" class="form-control" id="cmbnombreGrafico" onchange='mostarGrafico()'>
				<option>Seleccione</option>
				<?php 
					$grafico = $objGrafico->listarGraficos();

						while ($mostarGrafico = mysqli_fetch_assoc($grafico)) {
							echo utf8_encode("<option  value=".$mostarGrafico['id_grafico'].">".$mostarGrafico['nombre_grafico']."</option>");
							$nombre_grafico = $mostarGrafico['nombre_grafico'];
						}


						echo '</select>
		</div>
		</div>
	
';

				 ?>
				<!--<option>Seleccione Un Grafico</option>
				<option value="1">Distrubucion por Genero</option>
				<option value="2">Distrubucion por Grupo Etario</option>
				<option value="3">Distrubucion por Estado Civil</option>
				<option value="4">Distrubucion por Grado de Escolaridad</option>
				<option value="5">Distrubucion por Estrato</option>
				<option value="6">Distribución Por Tenencia de la Vivienda</option>
				<option value="7">Distribución Por Personas a Cargo</option>			
				<option value="8">Distribución Por Tiempo en la Empresa</option>	
				<option value="9">Distribución Por Tipo de Cargo</option>	
				<option value="10">Distribución Por Tiempo en el Cargo</option>	
				<option value="Capacitacion">Dimension Capacitación</option>-->


			
		<style type="text/css">
${demo.css}
		</style>
<script src="../Highcharts-4.1.5/js/highcharts.js"></script>
<!--<script src="../Highcharts-4.1.5/js/modules/exporting.js"></script>-->
<div class="container text-center" id="container" name="container">
	
</div>
	<div class="container" id="contenedorComentario" style="display: none;">
	<p>Comentarios Del Evaluador</p>
	<textarea  class="form-control mx-auto" rows="5" id="textComentario" name="textComentario"></textarea>
	<input type="hidden" name="accionComentario" id="accionComentario">
	<input type="button" name="guardarComentario" onclick="registrarComentario()" class="btn btn-primary form-control col-sm-4 m-3 mx-auto" value="Guardar Comentario">
	</div>

</form>
</div>

