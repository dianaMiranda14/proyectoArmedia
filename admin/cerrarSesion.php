<?php
	print_r($_SESSION['usuarioLogin']);
	session_start();
	if (isset($_SESSION['usuarioLogin'])) {
		unset($_SESSION['usuarioLogin']);
		header('Location:?cargar=login');
	}
?>