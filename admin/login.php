<div class="col-md-5">
	<div  id="mensajes"></div>
	<form id="formularioLogin" method="post" action="?cargar=inicio" onsubmit="return validarLogin();">
		 <div class="form-group">
		    <label for="txtCorreo">Correo</label>
		    <input type="email" class="form-control" id="txtCorreo" name="txtCorreo" placeholder="email@ejemplo.com" required="true">
		</div>
		<div class="form-group">
		    <label for="txtPassword">Contraseña</label>
			<input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Contraseña" required="true">
		</div>
		<input type="hidden" name="accion" value="consultarLogin">
		<input type="hidden" id="validacion">
		<button type="button" class="btn btn-primary" onclick="validarLogin()">Entrar</button>
	</form>
	<div class="dropdown-divider"></div>
	<a class="dropdown-item" href="#">Olvido la contraseña?</a>
</div>