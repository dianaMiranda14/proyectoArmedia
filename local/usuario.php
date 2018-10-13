<?php
	include_once("../modelo/Empresa.php");
	$objEmpresa=new Empresa();
?>

<div class="row">

	<div class="col-sm-10">
		<h1 class="text-center">Usuarios</h1>
	</div>

	<div class="col-sm-2">
		
	<input type="button" class="btn btn-primary float-right  m-2 mb-4" value="Registrar" onclick="modalUsuario('registrar',null)">
	</div>
	<div class="dropdown-divider " style="color: #839af8;"></div>
		
<div class="table-responsive">
	<table class="table table-sm">
		<thead class="thead">
			<tr>
				<th scope="col" class="table-primary">
			      	<input class="form-control filtro" type="text" name="txtConsultaCedula" id="txtConsultaCedula" placeholder="Cedula" onkeyup='filtrarUsuario("consultarCedula",this.value)' >
			    </th>

			    <th scope="col" class="table-primary">
			      	<input class="form-control filtro" type="text" name="txtConsultaNombre" id="txtConsultaNombre" placeholder="Nombre" onkeyup='filtrarUsuario("consultarNombre",this.value)' >
			    </th>

			    <th scope="col" class="table-primary">
			      	<input type="text" class="form-control readOnly" placeholder="Sexo" disabled="true" >
			    </th>

			    <th scope="col" class="table-primary">
			      	<input type="text" class="form-control readOnly" placeholder="Edad" disabled="true" >
			    </th>

			    <th scope="col" class="table-primary">
			      	<input type="text" class="form-control readOnly" placeholder="Profesión" disabled="true" >
			    </th>

			    <th scope="col" class="table-primary">
			      	<select class="form-control filtro" name="comboConsultaEmpresa" id="comboConsultaEmpresa" onchange='filtrarUsuario("consultarEmpresa",this.value)'>
			      		<option>Empresa</option>
			      		<?php
			      			echo $objEmpresa->mostrarOption();
			      		?>
			      	</select>
			    </th>

			    <th scope="col" class="table-primary">
			      	<input type="text" class="form-control readOnly" placeholder="Cargo" disabled="true" >
			    </th>

			    <th scope="col" class="table-primary">
			      	<select class="form-control filtro" name="comboConsultaEstado" id="comboConsultaEstado" onchange='filtrarUsuario("consultarEstado",this.value)'>
			      		<option>Estado</option>
			      		<option>Activo</option>
			      		<option>Inactivo</option>
			      	</select>
			    </th>
			    <th scope="col" class="table-primary">
			      
			    </th>
			</tr>

		</thead>
		<tbody id="cuerpoTablaUsuario">
			<?php
				include_once("../modelo/usuario.php");
				$objUsuario=new Usuario();
				echo $objUsuario->mostrar($objUsuario->listar());
			?>
		</tbody>
	</table>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModalUsuario">
        	
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<div id="mensajesUsuario"></div>
	      	<form id="formularioUsuario">
	      		<input type="hidden" name="accion" id="accionUsuario">
	      		<ul class="nav nav-tabs" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="personal_tab" data-toggle="tab" href="#infoPersonal" role="tab" aria-controls="infoPersonal" aria-selected="true">Personal</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="info2-tab" data-toggle="tab" href="#info2" role="tab" aria-controls="info2" aria-selected="false">Info2</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="info3-tab" data-toggle="tab" href="#info3" role="tab" aria-controls="info3" aria-selected="false">Info3</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="info4-tab" data-toggle="tab" href="#info4" role="tab" aria-controls="info4" aria-selected="false">Info4</a>
				  </li>
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="infoPersonal" role="tabpanel" aria-labelledby="home-tab">
				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Cedula</label>
				      			<input type="hidden" name="txtId" id="txtId">
				      			<input type="text" name="txtCedula" id="txtCedula" class="form-control" >
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Nombre</label>
				      			<input type="text" name="txtNombre" id="txtNombre" class="form-control" >
				      		</div>
				  		</div>
				  	</div>

				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Sexo</label>
				      			<select name="comboSexo" id="comboSexo" class="form-control" >
				      				<option value="">Seleccione</option>
				      				<option>Masculino</option>
				      				<option>Femenino</option>
				      			</select>
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Estado civil</label>
				      			<select name="comboEstadoCivil" id="comboEstadoCivil" class="form-control" >
				      				<option value="">Seleccione</option>
				      				<option>Soltero</option>
				      				<option>Casado</option>
				      				<option>Union libre</option>
				      				<option>Separado</option>
				      				<option>Divorciado</option>
				      				<option>Viudo</option>
				      				<option>Sacerdote / Monja</option>
				      			</select>
				      		</div>
				  		</div>
				  	</div>

				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Fecha de nacomiento</label>
				      			<input type="date" name="txtFechaNacimiento" id="txtFechaNacimiento" class="form-control" >
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Personas que dependen económicamente de usted</label>
				      			<input type="number" name="txtPersonasDependen" id="txtPersonasDependen" class="form-control" >
				      		</div>
				  		</div>
				  	</div>
				  </div>

				  <div class="tab-pane fade" id="info2" role="tabpanel" aria-labelledby="info2-tab">
				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Departamento residencia</label>
				      			<input type="text" name="comboDepartamentoResidencia" id="comboDepartamentoResidencia" class="form-control" >
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Ciudad residencia</label>
				      			<input type="text" name="comboCiudadResidencia" id="comboCiudadResidencia" class="form-control" >
				      		</div>
				  		</div>
				  	</div>

				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Tipo vivienda</label>
				      			<select name="comboTipoVivienda" id="comboTipoVivienda" class="form-control" >
				      				<option value="">Seleccione</option>
				      				<option>Propia</option>
				      				<option>Arriendo</option>
				      				<option>Familiar</option>
				      			</select>
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Estrato de servicios publicos</label>
				      			<select name="comboEstrato" id="comboEstrato" class="form-control" >
				      				<option value="">Seleccione</option>
				      				<option>1</option>
				      				<option>2</option>
				      				<option>3</option>
				      				<option>4</option>
				      				<option>5</option>
				      				<option>6</option>
				      				<option>Finca</option>
				      				<option>No se</option>
				      			</select>
				      		</div>
				  		</div>
				  	</div>

				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Ultimo nivel de estudio</label>
				      			<select name="comboNivelEstudio" id="comboNivelEstudio" class="form-control" >
				      				<option value="">Seleccione</option>
				      				<option>Ninguno</option>
				      				<option>Primaria incompleta</option>
				      				<option>Primaria completa</option>
				      				<option>Bachillerato incompleto</option>
				      				<option>Bachillerato completo</option>
				      				<option>Tecnico / tecnologia incompleto</option>
				      				<option>Tecnico / tecnologia completo</option>
				      				<option>Profesional incompleto</option>
				      				<option>Profesional completo</option>
				      				<option>Carrera militar / policia</option>
				      				<option>Post-grado incompleto</option>
				      				<option>Post-grado completo</option>
				      			</select>
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Profesión</label>
				      			<input type="text" name="txtProfesion" id="txtProfesion" class="form-control" >
				      		</div>
				  		</div>
				  	</div>
				  </div>

				  <div class="tab-pane fade" id="info3" role="tabpanel" aria-labelledby="info3-tab">
				  	

				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Departamento trabajo</label>
				      			<input type="text" name="comboDepartamentoTrabajo" id="comboDepartamentoTrabajo" class="form-control" >
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Ciudad trabajo</label>
				      			<input type="text" name="comboCiudadTrabajo" id="comboCiudadTrabajo" class="form-control" >
				      		</div>
				  		</div>
				  	</div>

				  	<div class="row">

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Empresa</label>
				      			<select name="comboEmpresa" id="comboEmpresa" class="form-control" >
				      				<option value="">Seleccione</option>
				      				<?php
						      			echo $objEmpresa->mostrarOption();
						      		?>
				      			</select>
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Departamento de la empresa</label>
				      			<input type="text" name="txtDepartamentoLaboral" id="txtDepartamentoLaboral" class="form-control" >
				      		</div>
				  		</div>
				  	</div>
				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Cantidad de años con la empresa</label>
				      			<input type="number" name="txtYearsTrabajo" id="txtYearsTrabajo" class="form-control" >
				      		</div>
				  		</div>
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Tipo de cargo</label>
				      			<select name="comboTipoCargo" id="comboTipoCargo" class="form-control" >
				      				<option value="">Seleccione</option>
				      				<option>Jefatura</option>
				      				<option>Profesional</option>
				      				<option>Analista</option>
				      				<option>Tecnico especializado</option>
				      				<option>Asistente administrativo</option>
				      				<option>Auxiliar</option>
				      				<option>Asistente tecnico</option>
				      				<option>Operador</option>
				      				<option>Operario</option>
				      				<option>Ayudante</option>
				      				<option>Servicios generales</option>
				      			</select>
				      		</div>
				  		</div>
				  	</div>
				  </div>

				  <div class="tab-pane fade" id="info4" role="tabpanel" aria-labelledby="info4-tab">
				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Cargo</label>
				      			<input type="text" name="txtCargo" id="txtCargo" class="form-control" >
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Cantidad de años en el cargo</label>
				      			<input type="number" name="txtYearsCargo" id="txtYearsCargo" class="form-control" >
				      		</div>
				  		</div>
				  	</div>

				  	<div class="row">
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Cantidad de horas de trabajo diarias</label>
				      			<input type="number" name="txtHorasTrabajo" id="txtHorasTrabajo" class="form-control" >
				      		</div>
				  		</div>

				  		<div class="col">
				  			<div class="form-group">
				      			<label>Tipo de contrato</label>
				      			<select name="comboTipoContrato" id="comboTipoContrato" class="form-control" >
				      				<option value="">Seleccione</option>
				      				<option>Temporal menos de 1 año</option>
				      				<option>Temporal de 1 año o mas</option>
				      				<option>Termino indefinido</option>
				      				<option>Cooperativa</option>
				      				<option>Prestacion de servicios</option>
				      				<option>No se</option>
				      			</select>
				      		</div>
				  		</div>
				  	</div>

				  	<div class="row">
				  		
				  		<div class="col">
				  			<div class="form-group">
				      			<label>Tipo de salario</label>
				      			<select name="comboTipoSalario" id="comboTipoSalario" class="form-control" >
				      				<option value="">Seleccione</option>
				      				<option>Fijo</option>
				      				<option>Una parte fija y otra variable</option>
				      				<option>Variable</option>
				      			</select>
				      		</div>
				  		</div>

				  		<div class="col" id="colEstadoUsuario">
				  			<div class="form-group">
				      			<label>Estado</label>
				      			<select name="comboEstado" id="comboEstado" class="form-control" >
				      				<option >Activo</option>
				      				<option>Inactivo</option>
				      			</select>
				      		</div>
				  		</div>
				  	</div>

				  </div>
				</div>
	      	</form>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onclick="validarModalUsuario()">Aceptar</button>
      </div>
    </div>
  </div>
</div>
	
</div>