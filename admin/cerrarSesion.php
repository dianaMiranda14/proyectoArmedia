<?php
	if (isset($_SESSION['usuarioLogin'])) {
		unset($_SESSION['usuarioLogin']);
		header('Location:?cargar=login');
	}
?>