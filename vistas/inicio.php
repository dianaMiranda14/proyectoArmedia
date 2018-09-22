<?php
include_once("modelo/empresa.php");
$objEmpresa=new Empresa();
?>
<div class="container mx-auto p-5 center-block mt-5" style="background: #fff;">
<div id="mensajesUsuario" ></div>
	<legend class="text-center font-weight-bold "><h1 style="color: #000;" >Formulario de Usuario</h1></legend>

<form id="formularioUsuario"  class="mt-4">
	<input type="hidden" name="accion" id="accionUsuario" value="modificarUsuario">
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
	<div class="tab-content mt-4" id="myTabContent">
		<div class="tab-pane fade show active" id="infoPersonal" role="tabpanel" aria-labelledby="home-tab">
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Cedula</label>
						<input type="text" name="txtCedula" id="txtCedula" class="form-control" onblur="validarExistenciaUsuario(this.value)" >
						<input type="hidden" name="comboEmpresa" id="comboEmpresa">
					</div>
				</div>

				<div class="col">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text"  name="txtNombre" id="txtNombre" class="form-control" >
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
					<div class="form-group" style="margin-bottom: 52px;">
						<label>Fecha de nacimiento</label>
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
					<div class="form-group" style="margin-bottom: 54px;">
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
						<label>Departamento de la empresa</label>
						<input type="text" name="txtDepartamentoLaboral" id="txtDepartamentoLaboral" class="form-control" >
					</div>
				</div>

				<div class="col">
					<div class="form-group">
						<label>Cantidad de años con la empresa</label>
						<input type="number" name="txtYearsTrabajo" id="txtYearsTrabajo" class="form-control" >
					</div>
				</div>
			</div>
			<div class="row" style="margin-bottom: 38px;">
				
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

				<div class="col">
					<div class="form-group">
						<label>Cargo</label>
						<input type="text" name="txtCargo" id="txtCargo" class="form-control" >
					</div>
				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="info4" role="tabpanel" aria-labelledby="info4-tab">
			<div class="row">
				
				<div class="col">
					<div class="form-group">
						<label>Cantidad de años en el cargo</label>
						<input type="number" name="txtYearsCargo" id="txtYearsCargo" class="form-control" >
					</div>
				</div>

				<div class="col">
					<div class="form-group">
						<label>Cantidad de horas de trabajo diarias</label>
						<input type="number" name="txtHorasTrabajo" id="txtHorasTrabajo" class="form-control" >
					</div>
				</div>
			</div>

			<div class="row">

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
			</div>

			<input type="button" class="btn btn-primary" value="Siguiente" onclick="modificarUsuario()">
		</div>

	</div>
</form>

</div>