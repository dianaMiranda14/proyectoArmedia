<?php
	session_start();
	if (!isset($_SESSION['usuarioLogin'])) {
		header('Location:');
	}
?>
<input type="button" class="btn btn-primary" value="Registrar" onclick='modalEmpresa("registrar",null)'>
<div class="table-responsive">
	<table class="table table-hover">
	  <thead class="thead">
	    <tr>
	      <th scope="col" class="table-primary">
	      	<input class="form-control filtro" type="text" name="txtConsultaNit" id="txtConsultaNit" placeholder="Nit" onkeyup='filtrarEmpresa("consultarNit",this.value)' >
	      </th>
	      <th scope="col" class="table-primary">
	      	<input class="form-control filtro" type="text" name="txtConsultaNombre" id="txtConsultaNombre" placeholder="Nombre" onkeyup='filtrarEmpresa("consultarNombre",this.value)'>
	      </th>
	      <th scope="col" class="table-primary">
	      	<input class="form-control filtro" type="text" name="txtConsultaCiudad" id="txtConsultaCiudad" placeholder="Ciudad" onkeyup='filtrarEmpresa("consultarCiudad",this.value)'>
	      </th>
	      <th scope="col" class="table-primary">
	      	<input type="text" class="form-control readOnly" placeholder="Dirección" disabled="true" >
	      </th>
	      <th scope="col" class="table-primary">
	      	<input type="text" class="form-control readOnly" placeholder="Telefono" disabled="true" >
	      </th>
	      <th scope="col" class="table-primary">
	      	<input class="form-control filtro" type="text" name="txtConsultaContacto" id="txtConsultaContacto" placeholder="Contacto" onkeyup='filtrarEmpresa("consultarContacto",this.value)'>
	      </th>
	      <th scope="col" class="table-primary">
	      		<select class="form-control filtro" name="comboConsultaEstado" id="comboConsultaEstado" onchange='filtrarEmpresa("consultarEstado",this.value)'>
	      			<option>Estado</option>
	      			<option>Activo</option>
	      			<option>Inactivo</option>
	      		</select>
	      </th>
			<th scope="col" class="table-primary">
				<input type="text" class="form-control readOnly" placeholder="Habilitado" disabled="true" >
			</th>
	      <th scope="col" class="table-primary"></th>
	    </tr>
	  </thead>
	  <tbody id="cuerpoTablaEmpresa">
	    <?php
	    	include_once("../modelo/empresa.php");
	    	$objEmpresa=new Empresa();
	    	$resultado=$objEmpresa->listar();
	    	if (mysqli_num_rows($resultado)>0) {
	    		while ($obj=mysqli_fetch_assoc($resultado)) {
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
	    	}else{
	    		echo '
	    		<tr>
	    			<td colspan="9">No hay registros</td>
	    		</tr>';
	    	}
	    ?>
	  </tbody>
	</table>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalEmpresa" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModalEmpresa">
        	
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<div id="mensajesEmpresa"></div>
	      	<form id="formularioEmpresa">
	      		<input type="hidden" name="accion" id="accionEmpresa">
	      		<div class="row">
	      			<div class="col">
	      				<div class="form-group">
			      			<label>Nit</label>
			      			<input type="text" name="txtNit" id="txtNit" class="form-control" >
			      		</div>
	      			</div>

		      		<div class="col">
		      			<div class="form-group">
			      			<label>Nombre</label>
			      			<input type="text" name="txtNombre" id="txtNombre" class="form-control">
			      		</div>
		      		</div>
	      		</div>
	      		
	      		<div class="row">
	      			<div class="col">
	      				<div class="form-group">
			      			<label>Ciudad</label>
			      			<select id="comboCiudad" name="comboCiudad" class="form-control">
			      				<option value="">Seleccione</option>
			      				<option value="Tulua">Tulua</option>
			      			</select>
			      		</div>
	      			</div>

	      			<div class="col">
	      				<div class="form-group">
			      			<label>Dirección</label>
			      			<input type="text" name="txtDireccion" id="txtDireccion" class="form-control">
			      		</div>
	      			</div>
	      		</div>
	      		
	      		<div class="row">
	      			<div class="col">
	      				<div class="form-group">
			      			<label>Telefono</label>
			      			<input type="text" name="txtTelefono" id="txtTelefono" class="form-control">
			      		</div>
	      			</div>

	      			<div class="col">
	      				<div class="form-group">
			      			<label>Contacto</label>
			      			<input type="text" name="txtContacto" id="txtContacto" class="form-control" >
			      		</div>
	      			</div>
	      		</div>
	      		
	      		<div id="adicional">
	      			<div class="row">
		      			<div class="col">
		      				<div class="form-group">
				      			<label>Estado</label>
				      			<select name="comboEstado" id="comboEstado" class="form-control">
				      				<option value="Activo">Activo</option>
				      				<option value="Inactivo">Inactivo</option>
				      			</select>
				      		</div>
		      			</div>

		      			<div class="col">
		      				<div class="form-check">
							  <input class="form-check-input" type="checkbox" id="checkHabilitado" name="checkHabilitado" value="1">
							  <label class="form-check-label" for="checkHabilitado">
							    Habilitado
							  </label>
							</div>
		      			</div>
		      		</div>
	      		</div>
	      	</form>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="validarModalEmpresa()">Aceptar</button>
      </div>
    </div>
  </div>
</div>