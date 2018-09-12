<?php
	class enrutadorUsuario{

		public function cargarVista($vista) {
			//echo "la vista a cargar es $vista";
			// analizar la variable vista.
			include_once("vistas/".$vista.".php");	// concatena con un "."
		}

		// metodo para validar si la vista esta vacia o no.
		public function validarVista($variable){
			if (empty($variable)) { // si variable esta vacia me llevara a donde esta todos los usuarios.
				include_once("vistas/inicio.php");
			} else {
				return true;
			}
		}
	}
?>