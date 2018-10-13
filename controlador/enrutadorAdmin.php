<?php
	class enrutadorAdmin{

		public function cargarVista($vista) {
			include_once("../admin/".$vista.".php");	
		}

		public function validarVista($cargar){
			if (empty($cargar)) { 
				include_once("../admin/login.php");
			}else if(file_exists("../admin/".$cargar.".php")==false){
				include_once("../admin/index.php");
			} else {
				return true;
			}
		}
	}
?>