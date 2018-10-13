<?php
	class enrutadorLocal{

		public function cargarVista($vista) {
			include_once("../local/".$vista.".php");	
		}

		public function validarVista($cargar){
			if (empty($cargar)) { 
				include_once("../local/login.php");
			}else if(file_exists("../local/".$cargar.".php")==false){
				include_once("../local/index.php");
			} else {
				return true;
			}
		}
	}
?>