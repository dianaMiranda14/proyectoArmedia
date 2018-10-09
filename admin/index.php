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
<body style=" background-image: url('../image/psicologia.jpg');
  background-repeat: no-repeat;background-size: cover;" >
	<div class="container-fluid" style="
    padding-left: 0px;
    padding-right: 0px;
">
	<div class="col-md-4 border float-right p-5" style="background: #fff;min-height: 660px;">
		
		<h2 class="text-center mt-5 ">Login Admin</h2>
			<div class="dropdown-divider m-4" ></div>
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
			<div class="col-md-12 mx-auto" id="mensajes"></div>
			<button type="button" class="btn btn-primary col-md-12 mt-4 " onclick="validarLogin()">Entrar</button>
		</form>
		<div class="dropdown-divider mt-4 mb-4"></div>
		<a class="dropdown-item text-center" href="#">¿Olvido su contraseña?</a>
	</div>
</body>
</html>